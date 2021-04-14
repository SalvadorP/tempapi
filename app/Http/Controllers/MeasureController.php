<?php

namespace App\Http\Controllers;

use App\Measure;
use GuzzleHttp\Client;
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

      $measure->temperature = $request->temperature;
      $measure->humidity = $request->humidity;
      $measure->pressure = $request->pressure;
      $measure->device = $request->device;

      $measure->save();

      // Send data to Thingspeak
      $this->sendData($measure);

      return response()->json($measure);
   }

   public function show($id)
   {
      $measure = Measure::find($id);

      return response()->json($measure);
   }

   public function update(Request $request, $id)
   {
      $measure = Measure::find($id);

      $measure->temperature = $request->input('temperature');
      $measure->humidity = $request->input('humidity');
      $measure->pressure = $request->input('pressure');
      $measure->device = $request->input('device');
      $measure->save();

      // Send data to Thingspeak
      $this->sendData($measure);

      return response()->json($measure);
   }

   public function destroy($id)
   {
      $measure = Measure::find($id);
      $measure->delete();

      return response()->json('Measure removed successfully');
   }

   public function read()
   {
      $url = 'https://api.thingspeak.com/channels/1355687/feeds.json?api_key=' . env('THINGSPEAK_CH1_READ_KEY') . '&results=20';
      $client = new Client();
      $response = $client->request('GET', $url);
      if ($response->getStatusCode() == 200) {
         $data = $response->getBody()->getContents();
         dd(json_decode(($data)));
      }
      // TODO: Throw exception and log it.
   }

   public function write()
   {
      $measures = Measure::orderBy('id', 'desc')->take(10)->get();
      foreach ($measures as $measure) {
         $this->sendData($measure);
      }
   }

   /**
    * Sends data to the thingspeak channel.
    * @param Measure $measure
    */
   protected function sendData(Measure $measure)
   {
      $client = new Client();
      $params = 'field1=' . urlencode($measure->temperature) . '&field2=' . urlencode($measure->humidity) . '&field3=' . urlencode($measure->pressure);
      // TODO: Avoid calling here the Thingspeak, do it on the device.
      $key = $measure->device == 'jardin' ? env('THINGSPEAK_CH2_WRITE_KEY') : env('THINGSPEAK_CH1_WRITE_KEY');
      $url = 'https://api.thingspeak.com/update?api_key=' . $key . '&' . $params;
      $response = $client->request('GET', $url);
      if ($response->getStatusCode() == 200) {
         $data = $response->getBody()->getContents();
      }
      // TODO: Throw exception and log it.
   }
}
