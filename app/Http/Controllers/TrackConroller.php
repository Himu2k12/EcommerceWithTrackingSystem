<?php

namespace App\Http\Controllers;

use App\LocationHistory;
use Illuminate\Http\Request;

class TrackConroller extends Controller
{
    public function saveLocation(Request $request){

        $location=new LocationHistory();
        $location->latitude=$request->lati;
        $location->longtitude=$request->long;
        $location->delivery_man_id=$request->id;
        $location->save();
        return response()->json([
            'message' => 'Successfully inserted value!'
        ], 201);
    }
}
