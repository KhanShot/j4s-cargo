<?php

namespace App\Imports;

use App\Models\Tracking;
use App\Models\TrackLog;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;

class LogsImport implements ToModel
{
    public $import_location;
    public function __construct($import_location)
    {
        $this->import_location = $import_location;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        DB::beginTransaction();

        $track = Tracking::query()->where('number', $row[0])->first();
        if ($track){
            $track->status = $this->import_location ?? 'created';
            $track->save();
        }

        DB::commit();

        return new TrackLog([
            'scanned_code' => $row[0],
            'text' => 'Импортирован',
            'track_status' => $this->import_location,
        ]);
    }
}
