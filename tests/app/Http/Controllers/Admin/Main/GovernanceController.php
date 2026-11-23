<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\Governance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GovernanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.main.governance.index')->with('governance',Governance::get()->sortBy("position"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.main.governance.create');
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
            'position' => 'required|unique:governances,position',
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
        
        
        $governance=new Governance;
         $governance->name=$request->input('name');
         $governance->designation=$request->input('designation');
         $governance->position=$request->input('position');
        // $exist =  Governance::where('position', $request->input('position'))->exists();
        // if($exist){
        //     return redirect()->back()->with('error','Governance with specified position already exist')->withInput();

        // }else{
        //     $governance->position=$request->input('position');
        // }
         $governance->save();

         $governance = Governance::find($governance->id);
         if($request->hasFile('profileImage'))
        {
            $governance_image = $governance->id.'.'.request()->profileImage->getClientOriginalExtension();
            request()->profileImage->move('storage/main/governance/', $governance_image);
            $governance->image='/storage/main/governance/'.$governance_image;
        }

        $governance->save();

        return redirect(route('admin.governance.index'))->with('success','Governance Member Added Successfully');
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
        return view('pages.admin.main.governance.edit')->with('member',Governance::find($id));
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
            'position' => 'required|unique:governances,position,'.$id.',id', 
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

        $governance= Governance::find($id);

        $governance->name=$request->input('name');
        $governance->designation=$request->input('designation');

        $governance->position=$request->input('position');
        // if( $governance->position == $request->input('position')){
        //     $governance->position=$request->input('position');

        // }else{
        //     // dd("in else");
        //     $positions =  Governance::where('position', '!=' , $governance->position )->pluck('position')->toArray();
        //     // dd($positions);
        //     $temp_pos= $request->input('position');
        //     // dd($temp_pos);
        //     if(in_array($temp_pos , $positions)){
        //         return redirect()->back()->with('error','Governance with specified position already exist')->withInput();
    
        //     }else{
        //         $governance->position=$request->input('position');
        //     }
        // }
        if($request->hasFile('profileImage'))
       {
        $governance_image = $id.'.'.request()->profileImage->getClientOriginalExtension();
        request()->profileImage->move('storage/main/governance/', $governance_image);
        $governance->image='/storage/main/governance/'.$governance_image;
    }

       $governance->save();

       return redirect(route('admin.governance.index'))->with('success','Governance Member Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $governance= Governance::find($id);
       $governance->delete();
       return redirect(route('admin.governance.index'))->with('success','Governance Member Deleted Successfully');
    }
}
