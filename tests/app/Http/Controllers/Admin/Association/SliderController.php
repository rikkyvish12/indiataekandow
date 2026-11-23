<?php

namespace App\Http\Controllers\Admin\Association;

use App\Models\AssociationSlider;
use App\Models\Association;
use App\Models\AssociationType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class SliderController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($assoc_id)
    {
       return view('pages.admin.association.slider.index')->with('assoc_id',$assoc_id )->with('slider',AssociationSlider::where('assoc_id','=',$assoc_id)->get()->sortBy('position'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($assoc_id)
    {
        return view('pages.admin.association.slider.create')->with('assoc_id',$assoc_id);
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
                Rule::unique('assoc_sliders')->where(function ($query) use ($assoc_id) {
                    return $query->where('assoc_id', $assoc_id);
                })
            ],        
            'image' =>'required|dimensions:min_width=1915,min_height=745,max_width=1925,max_height=755'
        ]);
            
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }

        $state_id = Association::where('id', $assoc_id)->value('state_id');
        $slider= new AssociationSlider;
        $slider->position=$request->input('position');


            // $exist =  AssociationSlider::where('assoc_id',$assoc_id)->where('position', $request->input('position'))->exists();
            // if($exist){
            //     return redirect()->back()->with('error','Slider with specified position already exist')->withInput();

            // }else{
            //     $slider->position=$request->input('position');
            // }

        $slider->assoc_id=$assoc_id;
        $slider->save();
        $slider = AssociationSlider::find($slider->id);

                  $destination_path =NULL;
      
                  $assoc = Association::where('id','=',$assoc_id)->first();
                  $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
                //   dd($assoc_type);
                  $final_assoc_type=str_replace('_association', '', $assoc_type);
                                    // dd($final_assoc_type);

                  $destination_path = 'storage/association/'. $final_assoc_type.'/'.$assoc_id.'/slider/';  
                //  dd($destination_path);         
                 
        if($request->hasFile('image'))
        {
            $image = $request->input('position').'.'.request()->image->getClientOriginalExtension();
            request()->image->move($destination_path, $image);
            $slider->image='/'.$destination_path.$image;
        }
        $slider->save();
        return redirect(route('assoc_admin.assoc_slider_index',$assoc_id))->with('success','Slider Added Successfully');
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
    public function edit($assoc_id,$slider_id)
    {
        return view('pages.admin.association.slider.edit')->with('assoc_id',$assoc_id )->with('slider',AssociationSlider::find($slider_id));
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
            'position' =>  
             [
                Rule::unique('assoc_sliders')->where(function ($query) use ($assoc_id,$id) {
                    return $query->where('assoc_id', $assoc_id);
                })->ignore($id)
            ],        
            'image' =>'dimensions:min_width=1915,min_height=745,max_width=1925,max_height=755',
        ]);
            
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }

        $slider=  AssociationSlider::find($id);
        $slider->position=$request->input('position');

        $destination_path =NULL;
      
        $assoc = Association::where('id','=',$assoc_id)->first();
        $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
        $final_assoc_type=str_replace('_association', '', $assoc_type);
        $destination_path = 'storage/association/'. $final_assoc_type.'/'.$assoc_id.'/slider/';    

       // $slider->state_name=Auth::user()->name;
        if($request->hasFile('image'))
        {
            $image = $request->input('position').'.'.request()->image->getClientOriginalExtension();
            request()->image->move($destination_path, $image);
            $slider->image='/'.$destination_path.$image;
        }
        $slider->save();
        return redirect(route('assoc_admin.assoc_slider_index',$assoc_id))->with('success','Slider Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($assoc_id,$slider_id)
    {
        $slider=  AssociationSlider::find($slider_id);
        $path = ltrim($slider->image, '/');
        //  dd($path);
        if(\File::exists($path))
        {
            // echo" if";
            // dd($path);
            \File::delete($path);  
        }

        $slider->delete();
        return redirect(route('assoc_admin.assoc_slider_index',$assoc_id))->with('success','Slider Deleted Successfully');
    }
}
