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

       $measure->temperature= intval($request->temperature);
       $measure->humidity = intval($request->humidity);
       $measure->pressure = intval($request->pressure);

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

        $measure->temperature = intval($request->input('temperature'));
        $measure->humidity = intval($request->input('humidity'));
        $measure->pressure = intval($request->input('pressure'));
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
