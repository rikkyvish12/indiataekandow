<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class OtherEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.main.other_event.index')->with('events',Events::orderBy('created_at','desc')->where('eventType_id','=','3')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.main.other_event.create');
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
            'title' => 'required',
            'location' => 'required',
            'date' => 'required',
            'intro' => 'required',
            'other_event' => 'required',
            'coverImage' =>'required|dimensions:min_width=345,min_height=245,max_width=355,max_height=255'
            

        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }


        $event=new Events;
        $event->title=$request->input('title');
        $event->location=$request->input('location');
        $event->date=$request->input('date');
        $event->intro=$request->input('intro');
        $event->content=$request->input('other_event');

        // $other_event= str_replace(' ', '', $request->input('other_event'));


        // if($other_event == ""){
        //     return redirect()->back()->with('error','Description cannot be empty')->withInput($request->except('password'));

        // }else{
        //     $event->content=$request->input('other_event');
        // }


        $event->save();

        // $event->link=$request->input('link');
        // $contains = Str::contains($request->input('link'), ['https://','https://']);


        // if($contains){
        //  $event->link=$request->input('link');
        // } else{
        //  $urlScheme= $request->input('protocol');
        //  $event->link=$urlScheme.'://'.$request->input('link');
        // }

        $event = Events::find($event->id);

        if($request->hasFile('coverImage'))
        {
            $coverImage ='cover_img.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move('storage/events/main/'.$event->id.'/coverImage/', $coverImage);
            $event->coverImage='/storage/events/main/'.$event->id.'/coverImage/'.$coverImage;
        }
        $event->eventType_id='3';

        $event->save();

        return redirect(route('admin.other_event.index'))->with('success','Event Updated Successfully');

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
        $event = Events::find($id);
        // dd($event->link);
        // $link = $event->link;
        // // dd($link);
        // $parseLinkHost = parse_url($link,PHP_URL_HOST);
        // $parseLinkScheme = parse_url($link,PHP_URL_SCHEME);


        // $event->parseLinkHost = $parseLinkHost;
        // $event->parseLinkScheme = $parseLinkScheme;


        return view('pages.admin.main.other_event.edit')->with('event',$event);
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
            'title' => 'required',
            'location' => 'required',
            'date' => 'required',
            'intro' => 'required',
            'other_event' => 'required',
            'coverImage' =>'dimensions:min_width=345,min_height=245,max_width=355,max_height=255'
            

        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }


        $event= Events::find($id);
        $event->title=$request->input('title');
        $event->location=$request->input('location');
        $event->date=$request->input('date');
        $event->intro=$request->input('intro');
        $event->content=$request->input('other_event');

        // $event->link=$request->input('link');
        // $other_event= str_replace(' ', '', $request->input('other_event'));


        // if($other_event == ""){
        //     return redirect()->back()->with('error','Description cannot be empty')->withInput($request->except('password'));

        // }else{
        //     $event->content=$request->input('other_event');
        // }

        // $contains = Str::contains($request->input('link'), ['https://','https://']);


        // if($contains){
        //  $event->link=$request->input('link');
        // } else{
        //  $urlScheme= $request->input('protocol');
        //  $event->link=$urlScheme.'://'.$request->input('link');
        // }
        if($request->hasFile('coverImage'))
        {
            $coverImage ='cover_img.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move('storage/events/main/'.$id.'/coverImage/', $coverImage);
            $event->coverImage='/storage/events/main/'.$id.'/coverImage/'.$coverImage;
        }
        $event->eventType_id='3';

        $event->save();

        return redirect(route('admin.other_event.index'))->with('success','Event Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event= Events::find($id);

        $path = 'storage/events/main/'.$id;

        if(\File::exists($path))
        {
            \File::deleteDirectory($path);
        }
        $event->delete();


        return redirect(route('admin.other_event.index'))->with('success','Event Deleted Successfully');

    }
}
