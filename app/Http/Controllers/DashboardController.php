<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $label = [];
        $tracks = [];

        $data = Tracking::query()->select(DB::raw("COUNT(*) as count"),DB::raw("date(created_at) as day_name"), DB::raw("DAY(created_at) as day"))
            ->where('created_at', '>', Carbon::today()->subDay(14))
            ->groupBy('day_name','day')
            ->orderBy('day')
            ->get();


        foreach($data as $row) {
            $label[] = $row->day_name;
            $xy['x'] = $row->day_name;
            $xy['y'] = (int) $row->count;
            $tracks[] = $xy;
        }


        $label = array_unique($label);
        sort($label);
        $label = json_encode(array_values($label));
        $tracks = json_encode($tracks);
//        dd($tracks);
        return view('admin.dashboard', compact('label', 'tracks'));
    }


}
