<?php

namespace App\Http\Controllers;

use App\Measure;
use Illuminate\Http\Request;


class MeasureController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
	    // $measures = Measure::all();
	    // Get last day and a half of measures.
	    $measures = Measure::latest()->take(36)->get();
     return response()->json($measures);

    }
   
    public function create(Request $request)
     {
        $measure = new Measure;

       $measure->temperature= $request->temperature;
       $measure->humidity = $request->humidity;
       $measure->pressure = $request->pressure;
       $measure->device = $request->device;

       $measure->save();

       return response()->json($measure);
     }

     public function show($id)
     {
        $measure = Measure::find($id);

        return response()->json($measure);
     }

     public function update(Request $request, $id)
     {
        $measure= Measure::find($id);

        $measure->temperature = $request->input('temperature');
        $measure->humidity = $request->input('humidity');
        $measure->pressure = $request->input('pressure');
        $measure->device = $request->input('device');
        $measure->save();
        return response()->json($measure);
     }

     public function destroy($id)
     {
        $measure = Measure::find($id);
        $measure->delete();

         return response()->json('Measure removed successfully');
     }


}
