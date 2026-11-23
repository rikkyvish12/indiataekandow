<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.main.department.index')->with('department',Department::get()->sortBy("position"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.main.department.create');
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
            'position' => 'required|unique:departments,position',
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
        

        $department=new Department;
         $department->name=$request->input('name');
         $department->designation=$request->input('designation');
         $department->position=$request->input('position');

         
        //  $exist =  Department::where('position', $request->input('position'))->exists();
        //  if($exist){
        //      return redirect()->back()->with('error','Department with specified position already exist')->withInput();
 
        //  }else{
            //  $department->position=$request->input('position');
        //  }
         $department->save();

         $department = Department::find($department->id);
         if($request->hasFile('profileImage'))
        {
            $department_image = $department->id.'.'.request()->profileImage->getClientOriginalExtension();
            request()->profileImage->move('storage/main/department/', $department_image);
            $department->image='/storage/main/department/'.$department_image;
        }

        $department->save();

        return redirect(route('admin.department.index'))->with('success','Department Member Added Successfully');
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
        return view('pages.admin.main.department.edit')->with('member',Department::find($id));
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
        
        $department= Department::find($id);
        $department->name=$request->input('name');
        $department->designation=$request->input('designation');
        $department->position=$request->input('position');

        
        // if( $department->position == $request->input('position')){
        //     $department->position=$request->input('position');

        // }else{
        //     // dd("in else");
        //     $positions =  Department::where('position', '!=' , $department->position )->pluck('position')->toArray();
        //     // dd($positions);
        //     $temp_pos= $request->input('position');
        //     // dd($temp_pos);
        //     if(in_array($temp_pos , $positions)){
        //         return redirect()->back()->with('error','Department with specified position already exist')->withInput();
        //     }else{
        //         $department->position=$request->input('position');
        //     }
        // } 

        if($request->hasFile('profileImage'))
       {
        $department_image = $id.'.'.request()->profileImage->getClientOriginalExtension();
        request()->profileImage->move('storage/main/department/', $department_image);
        $department->image='/storage/main/department/'.$department_image;
       }

       $department->save();

       return redirect(route('admin.department.index'))->with('success','Department Member Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department= Department::find($id);
       $department->delete();
       return redirect(route('admin.department.index'))->with('success','Department Member Deleted Successfully');
    }
}
