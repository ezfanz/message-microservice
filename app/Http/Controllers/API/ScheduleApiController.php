<?php

namespace App\Http\Controllers\API;


use App\Models\Schedules;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\BaseApiController;


class ScheduleApiController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // echo 'hi';
       
      
        // dd($realm_api_key);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            //Add data to schedule table 
            $schedule = new Schedules();
            $schedule->name = $request->name;
            $schedule->phone_no = $request->phone_no;
            $schedule->message = $request->message;
            $schedule->schedule_at = $request->schedule_at;
            $schedule->device_key = $request->device_key;


            if($schedule->save())
            {
                return new PostResource($schedule);
            }


            
            } catch (\Illuminate\Database\QueryException $e) {
                throw new \Exception('Error Please Contact Administrator');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function testingApi(Request $request)
    {   


        $realm_api_key  = env('REALM_API_KEY');

        foreach (Schedules::all() as $schedule) {
            // echo $schedule->phone_no;
            $response = Http::post('https://client.realm.chat/api/v1', [
                'key' => $realm_api_key,
                'device' => 'F0irhF4DLQ',
                'action' => 'send-message',
                'number' => $schedule->phone_no,
                'message' => 'Salam Tuan?puan Maaf Mengganggu Mesej Ini generate di dalam sistem sila abaikan Moga Tuan/puan Sihat Selalu',
                'type' => 'text'
            ]);

            sleep(3);
        }

        // die();

        return $response;


        // print_r($realm_api_key);

    }
}
