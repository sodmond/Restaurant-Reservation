<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Booking extends Model
{
    use HasFactory;

    public function getEventSpaceName($id)
    {
        $event_center = DB::table('event_centers')->where('id', $id)->first();
        return $event_center->title;
    }
}
