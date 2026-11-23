<?php

namespace App\Http\Controllers\Admin\Main;

use Illuminate\Http\Request;
use App\Models\MemberProfile;
use App\Http\Controllers\Controller;

class ProfileAthleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.main.profile_athlete.index')->with('members',MemberProfile::orderBy('created_at','desc')->where('type','=','athlete')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.main.profile_athlete.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $m=new MemberProfile;
        $m->name=$request->input('name');
        $m->type='athlete';
        $m->title=$request->input('title');
        $m->state=$request->input('state');
        $m->points=$request->input('points');

        if($request->hasFile('image'))
        {
        $image = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move('athlete_image/', $image);
        $m->image='/athlete_image/'.$image;
        }
        $m->save();

        return redirect(route('admin.profile_athlete.index'))->with('success','Athlete Added Successfully');


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
        return view('pages.admin.main.profile_athlete.edit')->with('member',MemberProfile::find($id));

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
        $m= MemberProfile::find($id);
        $m->name=$request->input('name');
        $m->type='athlete';
        $m->title=$request->input('title');
        $m->points=$request->input('points');

        if($request->hasFile('image'))
        {
        $image = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move('athlete_image/', $image);
        $m->image='/athlete_image/'.$image;
        }
        $m->save();

        return redirect(route('admin.profile_athlete.index'))->with('success','Athlete Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $m= MemberProfile::find($id);
       
        $m->delete();

        return redirect(route('admin.profile_athlete.index'))->with('success','Athlete Deleted Successfully');

    }
}
