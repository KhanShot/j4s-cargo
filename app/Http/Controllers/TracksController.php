<?php

namespace App\Http\Controllers;

use App\Http\Traits\TJsonResponse;
use App\Models\Cost;
use App\Models\Tracking;
use App\Models\TrackLog;
use Stevebauman\Location\Facades\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class TracksController extends Controller
{
    use TJsonResponse;
    public function index(){
        $trackings = Tracking::query()->where('user_id', auth()->user()->id)->get();
        $price = Cost::query()->first()->price ?? 4.0;

        $response = Http::get('https://nationalbank.kz/rss/rates_all.xml');

        $xml = simplexml_load_string($response->getBody(),'SimpleXMLElement',LIBXML_NOCDATA);
        $json = json_decode(json_encode($xml));
        $currencies = $json->channel->item;
        $dollar = 450;
        foreach ($currencies as $currency){
            if ($currency->title === "USD")
                $dollar = $currency->description;
        }
        return view('pages.tracks', compact('trackings', 'price', 'dollar'));
    }


    public function create(Request $request){
        Tracking::query()->create([
            'number' => $request->get('number'),
            'description' => $request->get('description'),
            'weight' => $request->get('weight'),
            'user_id' => auth()->user()->id,
            'state' => auth()->user()->state,
            'city' => auth()->user()->city,
        ]);
        return redirect()->route('tracks')->with('success', 'Трекинг добавлен!');
    }
    public function edit(Request $request){
        $tracking = Tracking::query()->find($request->get('tracking_id'));
        if (!$tracking)
            return redirect()->route('admin.tracks')->with('error', 'Трекинг не найден!');

        $tracking->status = $request->get('status');
        $tracking->save();
        return redirect()->route('admin.tracks')->with('success', 'Статус трекинга изменен!');

    }
    public function getTracks(){
        $trackings = Tracking::query()->with('user')->get();
        return view('admin.tracks', compact('trackings'));
    }
    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }
    public function scan(Request $request){
        $track = Tracking::query()->where('number', $request->get('scanned_code'))->first();
        $data = array();
        $data['user_id'] = auth()->user()->id;
        $data['city'] = Location::get($request->ip());
        $data['ip'] = $request->getClientIp();
        return $data;
        $data['scanned_code'] = $request->get('scanned_code');
        if (!$track){
            $data['status'] = 'fail';
            $data['text'] = 'сканированный код не найден!';
            $this->createLog($data);
            return $this->failedResponse('Код не найден!', 404, $track);
        }

        $manager_location = auth()->user()->manager_location;

        $data['track_id'] = $track->id;
        if ($manager_location == 'china'){
            if ($track->status != 'created'){
                $data['status'] = 'fail';
                $data['text'] = 'Статус трекинга уже изменен!';
                $this->createLog($data);
                return $this->failedResponse('Статус трекинга уже изменен!', 400);
            }
            $track->status = 'china_stock';
            $track->scanned_user_id = auth()->user()->id;
            $track->scanned_time = now();
            $track->status_changed_time = now();
            //$track->scanned_city = '';
            $track->save();
            $data['status'] = 'success';
            $data['text'] = 'Статус изменен успешно!';
            $this->createLog($data);
            return $this->successResponse('Статус изменен!', $request->get('scanned_code'));
        }
        if ($manager_location == 'kaz'){
            if ($track->status == 'kaz_stock'){
                $data['status'] = 'fail';
                $data['text'] = 'Статус трекинга уже изменен!';
                $this->createLog($data);
                return $this->failedResponse('Статус трекинга уже изменен!', 400);
            }
            $message = 'Статус изменен!';
            $data['status'] = 'success';
            $data['text'] = 'Статус изменен успешно!';
            if ($track->status == 'created'){
                $data['status'] = 'success';
                $data['text'] = 'Статус изменен! (но не был пробит в складе Китая)';
                $message = '<b>!! Статус изменен! (но не был пробит в складе Китая) !!</b>';
            }
            $track->status = 'kaz_stock';
            $track->scanned_user_id = auth()->user()->id;
            $track->scanned_time = now();
            $track->status_changed_time = now();
            //$track->scanned_city = '';
            $track->save();
            $this->createLog($data);
            return $this->successResponse($message, $request->get('scanned_code'));
        }


    }

    private function createLog($data){
        TrackLog::query()->create([
            'user_id' => $data['user_id'] ?? null,
            'city' => $data['city'] ?? null,
            'track_id' => $data['track_id'] ?? null,
            'text' => $data['text'] ?? null,
            'status' => $data['status'] ?? null,
            'track_status' => $data['track_status'] ?? null,
            'scanned_code' => $data['scanned_code'] ?? null,
        ]);
    }
}
