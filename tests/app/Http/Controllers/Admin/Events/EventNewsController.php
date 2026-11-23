<?php

namespace App\Http\Controllers\Admin\Events;

use App\Models\NewsEvents;
use App\Models\Events;
use App\Models\AssociationType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($event_id)
    {
        return view('pages.admin.event.news.index')->with('event_id',$event_id)->with('news',NewsEvents::where('event_id','=',$event_id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($event_id)
    {
        return view('pages.admin.event.news.create')->with('event_id',$event_id);
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
            'title' => 'required',
            'date' => 'required',
            'link' => 'required|url',
            'coverImage' =>'required|dimensions:min_width=345,min_height=245,max_width=355,max_height=255'
            

        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }
        $get_event = Events::where('id',$event_id)->first();

        $news=new NewsEvents;
        $news->event_name= $get_event->title;        
        $news->event_id=$event_id;
        $news->title=$request->input('title');
        $news->date=$request->input('date');
        $news->link=$request->input('link');
        $news->save();
        $news= NewsEvents::find($news->id);


        $destination_path =NULL;

           if($get_event->assoc_id != NULL){
               $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
               

               $final_assoc_type=str_replace('_association', '', $assoc_type);
               $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/news/';           
           }else{
               $destination_path = 'storage/events/main/'.$event_id.'/news/';

           }
        if($request->hasFile('coverImage'))
        {
            $coverImage = $news->id.'.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move($destination_path, $coverImage);
            $news->coverImage='/'.$destination_path.$coverImage;
        }
        $news->save();

        return redirect(route('event_admin.news_index',$event_id))->with('success','News Added Successfully');

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
    public function edit($event_id,$news_id)
    {
        return view('pages.admin.event.news.edit')->with('event_id',$event_id)->with('news',NewsEvents::find($news_id));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$event_id, $news_id)
    {

        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'date' => 'required',
            'link' => 'required|url',
            'coverImage' =>'dimensions:min_width=345,min_height=245,max_width=355,max_height=255'
            

        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }

        $get_event = Events::where('id',$event_id)->first();


        $news= NewsEvents::find($news_id);
        $news->event_name=$get_event->title;
        $news->title=$request->input('title');
        $news->date=$request->input('date');
        $news->link=$request->input('link');

        $destination_path =NULL;

           if($get_event->assoc_id != NULL){
               $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
               

               $final_assoc_type=str_replace('_association', '', $assoc_type);
               $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/news/';           
           }else{
               $destination_path = 'storage/events/main/'.$event_id.'/news/';

           }

        if($request->hasFile('coverImage'))
        {
            $coverImage = $news->id.'.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move($destination_path, $coverImage);
            $news->coverImage='/'.$destination_path.$coverImage;
        }
        $news->save();

        return redirect(route('event_admin.news_index',$event_id))->with('success','News Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id,$id)
    {
        $news= NewsEvents::find($id);

        
        $path = ltrim($news->coverImage, '/');
        //  dd($path);
        if(\File::exists($path))
        {
            \File::delete($path);  
        }


        $news->delete();

        return redirect(route('event_admin.news_index',$event_id))->with('success','News Deleted Successfully');

    }
}
