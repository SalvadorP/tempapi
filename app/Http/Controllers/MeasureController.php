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

     $measures = Measure::all();

     return response()->json($measures);

    }

     public function create(Request $request)
     {
        $measure = new Measure;

      //  $measure->temperature= filter_var($request->temperature, FILTER_SANITIZE_NUMBER_FLOAT);
      //  $measure->humidity = filter_var($request->humidity, FILTER_SANITIZE_NUMBER_FLOAT);
      //  $measure->pressure = filter_var($request->pressure, FILTER_SANITIZE_NUMBER_FLOAT);
      $measure->temperature= $request->temperature;
       $measure->humidity = $request->humidity;
       $measure->pressure = $request->pressure;

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

        $measure->temperature = filter_var($request->input('temperature'), FILTER_SANITIZE_NUMBER_FLOAT);
        $measure->humidity = filter_var($request->input('humidity'), FILTER_SANITIZE_NUMBER_FLOAT);
        $measure->pressure = filter_var($request->input('pressure'), FILTER_SANITIZE_NUMBER_FLOAT);
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
