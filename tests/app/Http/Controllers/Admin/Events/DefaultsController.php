<?php

namespace App\Http\Controllers\Admin\Events;

use Illuminate\Http\Request;
use App\Models\DefaultEvents;
use App\Models\Events;
use App\Models\Association;
use App\Models\AssociationType;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DefaultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($event_id)
    {
        return view('pages.admin.event.defaults.index')->with('event_id',$event_id)->with('defaults',DefaultEvents::where('event_id','=',$event_id)->first());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'logo' => 'dimensions:min_width=345,min_height=245,max_width=355,max_height=255',
            'banner' => 'dimensions:min_width=1915,min_height=295,max_width=1925,max_height=305',
            'background' => 'dimensions:min_width=1915,min_height=1150,max_width=1925,max_height=1162',
                     
            // 'footerBackground' => 'dimensions:min_width=1820,min_height=1057,max_width=2020,max_height=1257'

          
        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $defaults=new DefaultEvents;
        // $defaults->event_name=Auth::user()->name;
        
        $get_event = Events::where('id',$event_id)->first();

        $destination_path =NULL;

           if($get_event->assoc_id != NULL){
               
               $assoc = Association::where('id','=',$get_event->assoc_id )->first();
               $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
               

               $final_assoc_type=str_replace('_association', '', $assoc_type);
               $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/defaults/';           
           }else{
               $destination_path = 'storage/events/main/'.$event_id.'/defaults/';

           }

        if($request->hasFile('logo'))
        {
            $logo ='logo.'.request()->logo->getClientOriginalExtension();
            request()->logo->move($destination_path, $logo);
            $defaults->logo='/'.$destination_path.$logo;
        }

        if($request->hasFile('background'))
        {
        $background ='default_bg.'.request()->background->getClientOriginalExtension();
        

        request()->background->move($destination_path, $background);
        $defaults->background='/'.$destination_path.$background;
        }
        if($request->hasFile('banner'))
        {
        $banner = 'default_banner.'.request()->banner->getClientOriginalExtension();
        request()->banner->move($destination_path, $banner);
        $defaults->banner='/'.$destination_path.$banner;
        }
        if($request->hasFile('news_background'))
        {
        $news_background = 'default_news_background.'.request()->news_background->getClientOriginalExtension();
        request()->news_background->move($destination_path, $news_background);
        $defaults->news_background='/'.$destination_path.$news_background;
        }
        $defaults->save();

        return redirect()->back()->with('success','Defaults have been added');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $event_id)
    {
        // dd($request->all());
        $validator = \Validator::make($request->all(), [
            'logo' => 'dimensions:min_width=345,min_height=245,max_width=355,max_height=255',
            'banner' => 'dimensions:min_width=1915,min_height=295,max_width=1925,max_height=305',
            'background' => 'dimensions:min_width=1915,min_height=1150,max_width=1925,max_height=1162',
                     
            // 'footerBackground' => 'dimensions:min_width=1820,min_height=1057,max_width=2020,max_height=1257'

          
        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        
        $defaults= DefaultEvents::where('event_id',$event_id)->first();
// dd($defaults);
        $destination_path =NULL;
        $get_event = Events::where('id',$event_id)->first();
        $destination_path =NULL;
       

        if($get_event->assoc_id != NULL){
            $assoc = Association::where('id','=',$get_event->assoc_id)->first();
            $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
            $final_assoc_type=str_replace('_association', '', $assoc_type);
            $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/defaults/';           
        }else{
            $destination_path = 'storage/events/main/'.$event_id.'/defaults/';

        }

        if($request->hasFile('logo'))
        {
            $logo ='default_logo.'.request()->logo->getClientOriginalExtension();
            request()->logo->move($destination_path, $logo);
            $defaults->logo='/'.$destination_path.$logo;
        }

        if($request->hasFile('background'))
        {
        $background ='default_bg.'.request()->background->getClientOriginalExtension();
        request()->background->move($destination_path, $background);
        $defaults->background='/'.$destination_path.$background;
        }
        if($request->hasFile('banner'))
        {
        $banner = 'default_banner.'.request()->banner->getClientOriginalExtension();
        request()->banner->move($destination_path, $banner);
        $defaults->banner='/'.$destination_path.$banner;
        }
        if($request->hasFile('news_background'))
        {
        $news_background = 'default_news_background.'.request()->news_background->getClientOriginalExtension();
        request()->news_background->move($destination_path, $news_background);
        $defaults->news_background='/'.$destination_path.$news_background;
        }
        $defaults->save();

        return redirect()->back()->with('success','Defaults have been added');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
