<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\Patrons;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatronsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.main.patrons.index')->with('patrons',Patrons::get()->sortBy("position"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.main.patrons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'position' => 'required|unique:patrons,position',
            'designation' => 'required',
            'name' => 'required',
            'profileImage' =>'required|dimensions:min_width=345,min_height=245,max_width=355,max_height=255'
          
        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }

        $patrons=new Patrons;
         $patrons->name=$request->input('name');
         $patrons->designation=$request->input('designation');
         $patrons->position=$request->input('position');


        //  $exist =  Patrons::where('position', $request->input('position'))->exists();
        //  if($exist){
        //      return redirect()->back()->with('error','Patrons with specified position already exist')->withInput();
 
        //  }else{
        //      $patrons->position=$request->input('position');
        //  }

         $patrons->save();
         $patrons = Patrons::find($patrons->id);
         if($request->hasFile('profileImage'))
        {
            $patrons_image = $patrons->id.'.'.request()->profileImage->getClientOriginalExtension();
            request()->profileImage->move('storage/main/patrons/', $patrons_image);
            $patrons->image='/storage/main/patrons/'.$patrons_image;
        }

        $patrons->save();

        return redirect(route('admin.patrons.index'))->with('success','Patrons Member Added Successfully');
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
        return view('pages.admin.main.patrons.edit')->with('member',Patrons::find($id));
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
        $validator = \Validator::make($request->all(), [
            'position' => 'required|unique:patrons,position,'.$id.',id', 
            'designation' => 'required',
            'name' => 'required',
            'profileImage' =>'dimensions:min_width=345,min_height=245,max_width=355,max_height=255'
          
        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }
        $patrons= Patrons::find($id);
        $patrons->name=$request->input('name');
        $patrons->designation=$request->input('designation');
        $patrons->position=$request->input('position');

        // if( $patrons->position == $request->input('position')){
        //     $patrons->position=$request->input('position');

        // }else{
        //     // dd("in else");
        //     $positions =  Patrons::where('position', '!=' , $patrons->position )->pluck('position')->toArray();
        //     // dd($positions);
        //     $temp_pos= $request->input('position');
        //     // dd($temp_pos);
        //     if(in_array($temp_pos , $positions)){
        //         return redirect()->back()->with('error','Patrons with specified position already exist')->withInput();
        //     }else{
        //         $patrons->position=$request->input('position');
        //     }
        // } 

        if($request->hasFile('profileImage'))
       {
        $patrons_image = $id.'.'.request()->profileImage->getClientOriginalExtension();
        request()->profileImage->move('storage/main/patrons/', $patrons_image);
        $patrons->image='/storage/main/patrons/'.$patrons_image;
       }

       $patrons->save();

       return redirect(route('admin.patrons.index'))->with('success','Patrons Member Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $patrons= Patrons::find($id);
       $patrons->delete();
       return redirect(route('admin.patrons.index'))->with('success','Patrons Member Deleted Successfully');
    }
}
