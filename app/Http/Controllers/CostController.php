<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use App\Models\TrackLog;
use Illuminate\Http\Request;

class CostController extends Controller
{
    public function index(){
        $cost = Cost::query()->first();
        return view('admin.costs', compact('cost'));
    }

    public function import(Request $request){
        return $request->file('file');
    }

    public function logs(){
        $logs = TrackLog::with('user')
            ->orderBy('created_at', 'DESC')
            ->get();

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
