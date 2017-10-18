<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Machine;
use App\Factory;
use App\Mod;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $machines = Machine::where('user_id',Auth::id())->get();

        return view('machine.index',compact('machines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $factories = Factory::where('user_id',Auth::id())->get();
        $models = Mod::get();
        return view('machine.create',compact('factories','models'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $machine = new Machine;
        $machine->user_id = Auth::id();
        $machine->serial = $request->serial;
        $machine->user_serial = $request->user_serial;
        $machine->mod_id = $request->model;
        $machine->factory_id = $request->factory;
        $machine->save();
        return redirect('/machine');
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
        $machine = Machine::find($id);
        $factories = Factory::where('user_id',Auth::id())->select('id','name')->get();
        $models = Mod::get();
        return view('machine.edit')->withMachine($machine)->withFactories($factories)->withModels($models);
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
        $machine = Machine::find($id);
        $machine->user_serial = $request->user_serial;
        $machine->mod_id = $request->mod;
        $machine->factory_id = $request->factory;
        $machine->save();
        return redirect('/machine');
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
}
