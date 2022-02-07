<?php

namespace App\Http\Controllers;

use App\Http\Resources\UpcomingTaskResource;
use App\Models\Upcoming;
use Illuminate\Http\Request;

class UpcomingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $upcoming = Upcoming::all();

        return response( UpcomingTaskResource::collection( $upcoming ), 200 );
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
    public function store( Request $request )
    {
        return response( Upcoming::create( [
            'title'   => $request->title,
            'taskId'  => $request->taskId,
            'waiting' => $request->waiting,
        ] ), 201 );
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        $task = Upcoming::where( 'taskId', $id )->get()->first();
        if ( empty( $task ) || $task === '' ) {
            return response( ['error' => true, 'message' => 'Task with the task id' . $id . ' not found'], 404 );
        }
        return response( $task, 200 );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
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
    public function update( Request $request, $id )
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        $task = Upcoming::where( 'taskId', $id )->get( "id" )->first();
        return Upcoming::destroy( $task->id );
    }
}