<?php

namespace App\Http\Controllers\Admin\Association;

use Illuminate\Http\Request;
use App\Models\AssociationGovernance;
use App\Models\Association;
use App\Models\AssociationType;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class GovernanceController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($assoc_id)
    {
        return view('pages.admin.association.governance.index')->with('assoc_id',$assoc_id)->with('governance',AssociationGovernance::where('assoc_id','=',$assoc_id)->get()->sortBy('position'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($assoc_id)
    {
        return view('pages.admin.association.governance.create')->with('assoc_id',$assoc_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$assoc_id)
    {
        $validator = \Validator::make($request->all(), [
            'position' => 
            [
                Rule::unique('assoc_governances')->where(function ($query) use ($assoc_id) {
                    return $query->where('assoc_id', $assoc_id);
                })
            ],  
            'designation' => 'required',
            'name' => 'required',
            'image' =>'required|dimensions:min_width=345,min_height=245,max_width=355,max_height=255'
          
        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }

        $state_id = Association::where('id',$assoc_id)->value('state_id');
         $governance=new AssociationGovernance;
         $governance->name=$request->input('name');
         $governance->assoc_id=$assoc_id;
         $governance->designation=$request->input('designation');
         $governance->position=$request->input('position');


        //  $exist =  AssociationGovernance::where('position', $request->input('position'))->exists();
        // if($exist){
        //     return redirect()->back()->with('error','Governance with specified position already exist')->withInput();

        // }else{
        //     $governance->position=$request->input('position');
        // }

         $governance->save();
         $destination_path = NULL;

         $assoc = Association::where('id','=',$assoc_id)->first();
         $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
         $final_assoc_type=str_replace('_association', '', $assoc_type);
         $destination_path= 'storage/association/'. $final_assoc_type.'/'.$assoc_id.'/governance/';   

         $governance = AssociationGovernance::find($governance->id);
         if($request->hasFile('image'))
        {
            $governance_image = $governance->id.'.'.request()->image->getClientOriginalExtension();
            request()->image->move($destination_path, $governance_image);
            $governance->image='/'.$destination_path.$governance_image;
        }

        $governance->save();

        return redirect(route('assoc_admin.governance_index',$assoc_id))->with('success','Governance Member Added Successfully');
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
    public function edit($assoc_id,$govern_id)
    {
        return view('pages.admin.association.governance.edit')->with('assoc_id',$assoc_id)->with('member',AssociationGovernance::find($govern_id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$assoc_id, $id)
    {

        $validator = \Validator::make($request->all(), [
            'position' =>  [
                Rule::unique('assoc_governances')->where(function ($query) use ($assoc_id,$id) {
                    return $query->where('assoc_id', $assoc_id);
                })->ignore($id)
            ],  
            'designation' => 'required',
            'name' => 'required',
            'image' =>'dimensions:min_width=345,min_height=245,max_width=355,max_height=255'
          
        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }



        $governance= AssociationGovernance::find($id);
        $governance->name=$request->input('name');
        $governance->designation=$request->input('designation');
        $governance->position=$request->input('position');

        // if( $governance->position == $request->input('position')){
        //     $governance->position=$request->input('position');

        // }else{
        //     // dd("in else");
        //     $positions =  AssociationGovernance::where('position', '!=' , $governance->position )->pluck('position')->toArray();
        //     // dd($positions);
        //     $temp_pos= $request->input('position');
        //     // dd($temp_pos);
        //     if(in_array($temp_pos , $positions)){
        //         return redirect()->back()->with('error','Governance with specified position already exist')->withInput();

        //     }else{
        //         $governance->position=$request->input('position');
        //     }
        // }
        $destination_path = NULL;

        $assoc = Association::where('id','=',$assoc_id)->first();
         $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
         $final_assoc_type=str_replace('_association', '', $assoc_type);
         $destination_path= 'storage/association/'. $final_assoc_type.'/'.$assoc_id.'/governance/';   
        
        if($request->hasFile('image'))
       {
            $governance_image = $governance->id.'.'.request()->image->getClientOriginalExtension();
            request()->image->move( $destination_path, $governance_image);
            $governance->image='/'. $destination_path.$governance_image;
       }

       $governance->save();

       return redirect(route('assoc_admin.governance_index',$assoc_id))->with('success','Governance Member Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $governance= AssociationGovernance::find($id);
       $path = ltrim($governance->image, '/');
       //  dd($path);
       if(\File::exists($path))
       {
           \File::delete($path);  
       }
       $governance->delete();
       return redirect()->back()->with('success','Governance Member Deleted Successfully');

    }
}
