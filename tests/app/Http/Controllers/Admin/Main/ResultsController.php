<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\Results;
use App\Models\Events;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Results::orderBy('created_at','desc')->get();

        foreach( $results as  $result){
            $get_event_title= Events::where('id','=',$result['event_id'])->pluck('title')[0];
            $result['event_title']= $get_event_title;

        }

        // $result
      return view('pages.admin.main.results.index')->with('results', $results );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_events =Events::where('assoc_id','=',NULL)->get();
        return view('pages.admin.main.results.create')->with('all_events', $all_events );
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
            'date' => 'required',
            'event' => 'required',
            // 'event_name' => 'required',
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


        $results=new Results;
        $results->date=$request->input('date');
        // $results->event_name=$request->input('event_name');
        $results->group=$request->input('group');
        
        if($request->has('time'))
             $results->time=$request->input('time');
        else
            $results->time=NULL;

        $results->round=$request->input('round');
        $results->event_id=$request->input('event');
        if($request->hasFile('result_pdf'))
        {
            $result_pdf = request()->result_pdf->getClientOriginalExtension();
            request()->result_pdf->move('storage/main/result_pdfs/', $result_pdf);
            $results->result_pdf= '/storage/main/result_pdfs/'.$result_pdf;
        }
        $results->save();

        return redirect(route('admin.results.index'))->with('success','Result Added Successfully');

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
        $all_events =Events::where('assoc_id','=',NULL)->get();

        return view('pages.admin.main.results.edit')->with(['result'=>Results::find($id),'all_events'=>$all_events]);

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
            'date' => 'required',
            'event' => 'required',
            // 'event_name' => 'required',
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

        $results= Results::find($id);
        $results->date=$request->input('date');
        $results->event_id=$request->input('event');
        $results->group=$request->input('group');

        if($request->has('time'))
             $results->time=$request->input('time');
        else
              $results->time=NULL;
              
        $results->round=$request->input('round');
        // $results->event=$request->input('event');
        if($request->hasFile('result_pdf'))
        {
            $result_pdf = request()->result_pdf->getClientOriginalExtension();
            request()->result_pdf->move('storage/main/result_pdfs/', $result_pdf);
            $results->result_pdf= '/storage/main/result_pdfs/'.$result_pdf;
        }
        $results->save();

        return redirect(route('admin.results.index'))->with('success','Result Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $results= Results::find($id);

        $results->delete();

        return redirect(route('admin.results.index'))->with('success','Result Deleted Successfully');

    }
}
