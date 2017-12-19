<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Factory;
use Carbon\Carbon;

class FactoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subheader = 'Factory';
        $factories = Factory::where('user_id',Auth::id())->get();
        return view('factory.index',compact('subheader','factories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $subheader = 'Factory';
        return view('factory.add',compact('subheader'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $f = new Factory;
        $f->user_id = Auth::id();
        $f->name = $request->factoryName;
        $f->description = $request->description;
        $f->save();
        return redirect('/factory');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $r)
    {
        if(!$r->viewWeek){
            $dt = Carbon::now();
        } else {
            //dd($r);
            $dt = Carbon::createFromFormat('Y-m-d',$r->viewWeek);
            $dt->startOfWeek();
        }
        
        $factory = Factory::findOrFail($id);
        return view('factory.week')->with('factory',$factory)->with('dt',$dt);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $factory = Factory::find($id);
        $factory->name = $request->name;
        $factory->description = $request->description;
        $factory->save();
        return redirect('/factory');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Factory::destroy($id);
        return redirect('/factory');
    }
    public function edit($id)
    {
        $subheader = 'Factory';
        $factory = Factory::findOrFail($id);
        return view('factory.edit',compact('subheader','factory'));
    }
}
