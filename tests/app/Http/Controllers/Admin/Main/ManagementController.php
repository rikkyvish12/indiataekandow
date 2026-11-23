<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\Management;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.main.management.index')->with('management',Management::get()->sortBy("position"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.main.management.create');
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
            'position' => 'required|unique:management,position',
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
        
        $management=new Management;
         $management->name=$request->input('name');
         $management->designation=$request->input('designation');
         $management->position=$request->input('position');

        // $exist =  Management::where('position', $request->input('position'))->exists();
        // if($exist){
        //     return redirect()->back()->with('error','Management with specified position already exist')->withInput();

        // }else{
        //     $management->position=$request->input('position');
        // }
        
         $management->save();
         $management = Management::find($management->id);
         if($request->hasFile('profileImage'))
        {
            $management_image = $management->id.'.'.request()->profileImage->getClientOriginalExtension();
            request()->profileImage->move('storage/main/management/', $management_image);
            $management->image='/storage/main/management/'.$management_image;
        }

        $management->save();

        return redirect(route('admin.management.index'))->with('success','Management Member Added Successfully');
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
        return view('pages.admin.main.management.edit')->with('member',Management::find($id));
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
            'position' => 'required|unique:management,position,'.$id.',id', 
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

        $management= Management::find($id);
        $management->name=$request->input('name');
        $management->designation=$request->input('designation');
        $management->position=$request->input('position');
        // if( $management->position == $request->input('position')){
        //     $management->position=$request->input('position');

        // }else{
        //     // dd("in else");
        //     $positions =  Management::where('position', '!=' , $management->position )->pluck('position')->toArray();
        //     // dd($positions);
        //     $temp_pos= $request->input('position');
        //     // dd($temp_pos);
        //     if(in_array($temp_pos , $positions)){
        //         return redirect()->back()->with('error','Management with specified position already exist')->withInput();
        //     }else{
        //         $management->position=$request->input('position');
        //     }
        // }  
        if($request->hasFile('profileImage'))
       {
            $management_image = $id.'.'.request()->profileImage->getClientOriginalExtension();
            request()->profileImage->move('storage/main/management/', $management_image);
            $management->image='/storage/main/management/'.$management_image;
       }

       $management->save();

       return redirect(route('admin.management.index'))->with('success','Management Member Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $management= Management::find($id);
       $management->delete();
       return redirect(route('admin.management.index'))->with('success','Management Member Deleted Successfully');
    }
}
