<?php

namespace App\Http\Controllers\Admin\Association;

use App\Models\AssociationPatrons;
use App\Models\AssociationType;
use App\Models\Association;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PetronController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($assoc_id)
    {
        return view('pages.admin.association.petrons.index')->with('assoc_id',$assoc_id)->with('petrons',AssociationPatrons::where('assoc_id','=',$assoc_id)->get()->sortBy('position'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($assoc_id)
    {
        return view('pages.admin.association.petrons.create')->with('assoc_id',$assoc_id);
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
                Rule::unique('assoc_patrons')->where(function ($query) use ($assoc_id) {
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

        $petrons=new AssociationPatrons;
         $petrons->name=$request->input('name');
         $petrons->assoc_id=$assoc_id;
         $petrons->designation=$request->input('designation');
         $petrons->position=$request->input('position');

         
        // $exist =  AssociationPatrons::where('position', $request->input('position'))->exists();
        // if($exist){
        //     return redirect()->back()->with('error','Patrons with specified position already exist')->withInput();

        // }else{
        // }

         $petrons->save();
         $destination_path =NULL;
      
         $assoc = Association::where('id','=',$assoc_id)->first();
         $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
         $final_assoc_type=str_replace('_association', '', $assoc_type);
         $destination_path = 'storage/association/'. $final_assoc_type.'/'.$assoc_id.'/patrons/';  

         $petrons = AssociationPatrons::find($petrons->id);
         if($request->hasFile('image'))
        {
            $petrons_image = $petrons->id.'.'.request()->image->getClientOriginalExtension();
            request()->image->move( $destination_path, $petrons_image);
            $petrons->image='/'. $destination_path.$petrons_image;
        }

        $petrons->save();

        return redirect(route('assoc_admin.petrons_index',$assoc_id))->with('success','Patrons Member Added Successfully');
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
    public function edit($assoc_id,$id)
    {
        return view('pages.admin.association.petrons.edit')->with('assoc_id',$assoc_id)->with('member',AssociationPatrons::find($id));
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
            'position'=>  [
                Rule::unique('assoc_patrons')->where(function ($query) use ($assoc_id,$id) {
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

        $petrons= AssociationPatrons::find($id);
        $petrons->name=$request->input('name');
        $petrons->designation=$request->input('designation');
        $petrons->position=$request->input('position');

        // if( $petrons->position == $request->input('position')){
        //     $petrons->position=$request->input('position');

        // }else{
        //     // dd("in else");
        //     $positions =  AssociationPatrons::where('position', '!=' , $petrons->position )->pluck('position')->toArray();
        //     // dd($positions);
        //     $temp_pos= $request->input('position');
        //     // dd($temp_pos);
        //     if(in_array($temp_pos , $positions)){
        //         return redirect()->back()->with('error','Patrons with specified position already exist')->withInput();
    
        //     }else{
        //     }
        // }
        $destination_path = NULL;
        $assoc = Association::where('id','=',$assoc_id)->first();
        $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
        $final_assoc_type=str_replace('_association', '', $assoc_type);
        $destination_path = 'storage/association/'. $final_assoc_type.'/'.$assoc_id.'/patrons/';  
        if($request->hasFile('image'))
       {
        $petrons_image = $petrons->id.'.'.request()->image->getClientOriginalExtension();
        request()->image->move($destination_path, $petrons_image);
        $petrons->image='/'.$destination_path.$petrons_image;
       }

       $petrons->save();

       return redirect(route('assoc_admin.petrons_index',$assoc_id))->with('success','Patrons Member Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $petrons= AssociationPatrons::find($id);
        $path = ltrim($petrons->image, '/');
       //  dd($path);
       if(\File::exists($path))
       {
           \File::delete($path);  
       }
        $petrons->delete();
        return redirect()->back()->with('success','Petrons Member Deleted Successfully');

    }
}
