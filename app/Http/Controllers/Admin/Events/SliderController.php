<?php

namespace App\Http\Controllers\Admin\Events;

use App\Models\EventSlider;
use App\Models\Events;
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
    public function index($event_id)
    {
        $sliders = EventSlider::where('event_id',$event_id)->get()->sortBy("position");
       return view('pages.admin.event.slider.index')->with('event_id',$event_id)->with('slider',$sliders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($event_id)
    {
        return view('pages.admin.event.slider.create')->with('event_id',$event_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$event_id)
    {
        $validator = \Validator::make($request->all(), [
            'position' => 
            [
                Rule::unique('event_sliders')->where(function ($query) use ($event_id) {
                    return $query->where('event_id', $event_id);
                })
            ],
            'image' =>'required|dimensions:min_width=1915,min_height=745,max_width=1925,max_height=755',            

        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }
        $get_event = Events::where('id',$event_id)->first();

        // $event_name = Events::where('id',$event_id)->value('title');
        $slider= new EventSlider;
        $slider->position=$request->input('position');
       

        $slider->event_name=$get_event->title;
        $slider->event_id=$event_id;

        $destination_path =NULL;

           if($get_event->assoc_id != NULL){
               $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
               

               $final_assoc_type=str_replace('_association', '', $assoc_type);


               $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/slider/';           
           }else{
               $destination_path = 'storage/events/main/'.$event_id.'/slider/';

           }


        if($request->hasFile('image'))
        {
            $image = $request->input('position').'.'.request()->image->getClientOriginalExtension();
            request()->image->move($destination_path, $image);
            $slider->image='/'.$destination_path.$image;
        }
        $slider->save();
        return redirect(route('event_admin.slider_index',$event_id))->with('success','Slider Added Successfully');
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
    public function edit($event_id,$slider_id)
    {
        return view('pages.admin.event.slider.edit')->with('event_id',$event_id)->with('slider',EventSlider::find($slider_id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$event_id, $slider_id)
    {
        $validator = \Validator::make($request->all(), [
            'position' =>  
             [
                Rule::unique('event_sliders')->where(function ($query) use ($event_id,$slider_id) {
                    return $query->where('event_id', $event_id);
                })->ignore($slider_id)
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

        $event_id = $request->input('event_id');

        $slider=  EventSlider::find($slider_id);
        $slider->position=$request->input('position');
        
        //$slider->event_name=Auth::user()->name;
        $get_event = Events::where('id',$slider->event_id)->first();

        

        $destination_path =NULL;

           if($get_event->assoc_id != NULL){
               $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
               

               $final_assoc_type=str_replace('_association', '', $assoc_type);
               $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/slider/';           
           }else{
               $destination_path = 'storage/events/main/'.$event_id.'/slider/';

           }

        if($request->hasFile('image'))
        {
            // $path = $slider->image;
            // $path = ltrim($path, '/');
            // //  dd($path);
            // if(\File::exists($path))
            // {
            //     \File::delete($path);  
            // }

            $image = $request->input('position').'.'.request()->image->getClientOriginalExtension();
            request()->image->move($destination_path, $image);
            $slider->image='/'.$destination_path.$image;
        }
        $slider->save();
        return redirect(route('event_admin.slider_index',$event_id))->with('success','Slider Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id,$slider_id)
    {
       
        $slider=  EventSlider::find($slider_id);
        
        $path = ltrim($slider->image, '/');
        //  dd($path);
        if(\File::exists($path))
        {
            // echo" if";
            // dd($path);
            \File::delete($path);  
        }
        $slider->delete();



        return redirect(route('event_admin.slider_index',$event_id))->with('success','Slider Deleted Successfully');
    }
}
