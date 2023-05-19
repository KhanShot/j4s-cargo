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

    public function logs(){
        $logs = TrackLog::query()->get();
        return view('admin.logs', compact('logs'));
    }

    public function create(Request $request){
        Cost::query()->delete();
        Cost::query()->create([
            'price' => $request->get('price')
        ]);
        return redirect()->route('admin.costs')->with('success', 'Цена за кг обновлен!');
    }

}
