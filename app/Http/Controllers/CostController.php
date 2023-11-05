<?php

namespace App\Http\Controllers;

use App\Http\Traits\TJsonResponse;
use App\Imports\LogsImport;
use App\Models\Cost;
use App\Models\TrackLog;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CostController extends Controller
{
    use TJsonResponse;
    public function index(){
        $cost = Cost::query()->first();
        return view('admin.costs', compact('cost'));
    }

    public function import(Request $request){
        $import_location = $request->get('import_location');
        Excel::import(new LogsImport($import_location), $request->file('file'));
        return $this->successResponse('uploaded');
    }

    public function logs(){
        $logs = [];

        return view('admin.logs', compact('logs'));
    }
    public function getLogs(){
        $logs = TrackLog::with('user')
            ->orderBy('created_at', 'DESC')
            ->paginate(15);
        $data = $logs->transform(function ($item){

            return [
                'id' => $item->id,
                'scanned_code' => $item->scanned_code,
                'user_name' => $item->user->name ?? '-',
                'city' => $item->city ?? '-',
                'status' =>$item->status == 'fail' ? '<i class="icon-ban text-danger"></i> Не прошел' : '<i class="icon-check text-success"></i> Прошел',
                'track_status' => match ($item->track_status){
                    "created" => 'Трекинг создан',
                    "china_stock" => 'Доставлен в склад(Китай)',
                    "kaz_stock" => 'Доставлен в Казахстан',
                    default => '-',
                },
                'text' => $item->text,
                'created_at' => $item->created_at->format('d-m-Y H:m:s'),
            ];
        });
        $pagination = [

            'total' => $logs->total(),
            'last_page' => $logs->lastPage(),
            'current_page' => $logs->currentPage(),

        ];
        return response()->json(['data'=>$data, 'pagination' => $pagination]);
    }
    public function create(Request $request){
        Cost::query()->delete();
        Cost::query()->create([
            'price' => $request->get('price')
        ]);
        return redirect()->route('admin.costs')->with('success', 'Цена за кг обновлен!');
    }

}
