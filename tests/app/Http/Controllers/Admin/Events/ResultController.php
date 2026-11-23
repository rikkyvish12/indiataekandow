<?php

namespace App\Http\Controllers\Admin\Events;

use App\Models\EventResults;
use App\Models\Events;
use App\Models\AssociationType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($event_id)
    {
        return view('pages.admin.event.results.index')->with('event_id',$event_id)->with('results',EventResults::orderBy('date','asc')->where('event_id','=',$event_id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($event_id)
    {
        return view('pages.admin.event.results.create')->with('event_id',$event_id);
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
            'date' => 'required',           
            'group' => 'required',
            'round' => 'required',
            'result_pdf' =>'required|mimes:pdf'
            

        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }
        $get_event = Events::where('id',$event_id)->first();

        $destination_path =NULL;

           if($get_event->assoc_id != NULL){
               $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
               

               $final_assoc_type=str_replace('_association', '', $assoc_type);
               $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/result_pdf/';           
           }else{
               $destination_path = 'storage/events/main/'.$event_id.'/result_pdf/';

           }


        $result=new EventResults;
        $result->date=$request->input('date');
        $result->event_name = $get_event->title;
        $result->event_id=$event_id;
        $result->group=$request->input('group');
        // $result->time=$request->input('time');
        if($request->has('time'))
             $result->time=$request->input('time');
        else
            $result->time=null;
        $result->round=$request->input('round');
        $result->event= null;

        if($request->hasFile('result_pdf'))
        {
            $result_pdf = request()->result_pdf->getClientOriginalName();
            request()->result_pdf->move($destination_path, $result_pdf);
            $result->result_pdf='/'.$destination_path.$result_pdf;
        }
        $result->save();

        return redirect(route('event_admin.results_index',$event_id))->with('success','Result Added Successfully');

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
    public function edit($event_id,$result_id)
    {
        return view('pages.admin.event.results.edit')->with('event_id',$event_id)->with('result',EventResults::find($result_id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$event_id, $result_id)
    {
        $validator = \Validator::make($request->all(), [
            'date' => 'required',         
            'group' => 'required',
            'round' => 'required',
            'result_pdf' =>'mimes:pdf'
            

        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }
        $get_event = Events::where('id',$event_id)->first();

        $destination_path =NULL;

           if($get_event->assoc_id != NULL){
               $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
               

               $final_assoc_type=str_replace('_association', '', $assoc_type);
               $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/result_pdf/';           
           }else{
               $destination_path = 'storage/events/main/'.$event_id.'/result_pdf/';

           }


        $result = EventResults::find($result_id);
        $result->date=$request->input('date');
        $result->event_name = $get_event->title;
        $result->group=$request->input('group');

        if($request->has('time'))
             $result->time=$request->input('time');
        else
             $result->time=NULL;

        $result->round=$request->input('round');
        $result->event=null;

        if($request->hasFile('result_pdf'))
        {
            $result_pdf = request()->result_pdf->getClientOriginalName();
            request()->result_pdf->move($destination_path, $result_pdf);
            $result->result_pdf='/'.$destination_path.$result_pdf;
        }
        $result->save();

        return redirect(route('event_admin.results_index',$event_id))->with('success','Result Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id,$result_id)
    {
        $result= EventResults::find($result_id);
         
        $path = ltrim($result->result_pdf, '/');
        //  dd($path);
        if(\File::exists($path))
        {
            \File::delete($path);  
        }



        $result->delete();

        return redirect(route('event_admin.results_index',$event_id))->with('success','Result Deleted Successfully');

    }
}
