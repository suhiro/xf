<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event_log;
use App\Machine;
use Illuminate\Support\Facades\Auth;

class JamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jam.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $machine = Machine::find($id); 
        $errors = $machine->mod->error->pluck('err_code')->toArray();
        return $errors;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
    public function summary(Request $r){
        $machines = Machine::where('user_id',Auth::id())->get();

        foreach($machines as $m){
            $errors = $m->mod->error->pluck('err_code')->toArray();
            //dd($errors);
            $events = Event_log::where('serial',$m->serial)->whereBetween('MCGS_Time',[$r->start,$r->end])->get();
            $m->summary = Event_log::jamSummary($events,$errors);
        }

        return view('jam/summary',compact('machines'));
    }

}
