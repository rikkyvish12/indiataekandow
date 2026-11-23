<?php

namespace App\Http\Controllers\Admin\Events;

use Illuminate\Http\Request;
use App\Models\ImportantPDFEvents;
use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\AssociationType;
use Illuminate\Support\Facades\Auth;

class EventImportantPdfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($event_id)
    {
        return view('pages.admin.event.importantpdf.index')->with('event_id',$event_id)->with('pdf',ImportantPDFEvents::where('event_id','=',$event_id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($event_id)
    {
        return view('pages.admin.event.importantpdf.create')->with('event_id',$event_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$event_id)
    {
        // dd($request);
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'pdf' => 'required|mimes:pdf',           
            

       ]);
       if ($validator->fails()) {
        // dd("in if");
        return  redirect()->back()
                    ->withErrors($validator)
                    ->withInput($request->except('password'))
                    ->with('autofocus', true);
    }
        $get_event = Events::where('id',$event_id)->first();
        $imppdf=new ImportantPDFEvents;
        $imppdf->event_name = $get_event->title;
        $imppdf->event_id=$event_id;
        $imppdf->pdf_name=$request->input('name');
       

        $destination_path =NULL;

           if($get_event->assoc_id != NULL){
               $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
               

               $final_assoc_type=str_replace('_association', '', $assoc_type);
               $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/imp_pdfs/';           
           }else{
               $destination_path = 'storage/events/main/'.$event_id.'/imp_pdfs/';

           }
        if($request->hasFile('pdf'))
        {
            $pdf = request()->pdf->getClientOriginalName();
            request()->pdf->move($destination_path, $pdf);
            $imppdf->pdf='/'.$destination_path.$pdf;
        }
        $imppdf->save();

        return redirect(route('event_admin.important_pdf_index',$event_id))->with('success','PDF Added Successfully');
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
    public function edit($event_id,$pdf_id)
    {
        return view('pages.admin.event.importantpdf.edit')->with('event_id',$event_id)->with('pdf',ImportantPDFEvents::find($pdf_id));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$event_id, $pdf_id)
    {

        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'pdf' => 'mimes:pdf',           
            

       ]);
       if ($validator->fails()) {
        // dd("in if");
        return  redirect()->back()
                    ->withErrors($validator)
                    ->withInput($request->except('password'))
                    ->with('autofocus', true);
    }

        $get_event = Events::where('id',$event_id)->first();
        $imppdf= ImportantPDFEvents::find($pdf_id);
        $imppdf->event_name =$get_event->title;
        $imppdf->pdf_name=$request->input('name');
        $destination_path =NULL;

           if($get_event->assoc_id != NULL){
               $assoc_type = AssociationType::where('id','=',$get_event->assoc_id )->value('name');
               

               $final_assoc_type=str_replace('_association', '', $assoc_type);
               $destination_path = 'storage/events/association/'. $final_assoc_type.'/'.$get_event->assoc_id.'/'.$event_id.'/imp_pdfs/';           
           }else{
               $destination_path = 'storage/events/main/'.$event_id.'/imp_pdfs/';

           }
        if($request->hasFile('pdf'))
        {
            $pdf = request()->pdf->getClientOriginalName();
            request()->pdf->move($destination_path, $pdf);
            $imppdf->pdf='/'.$destination_path.$pdf;
        }
        $imppdf->save();

        return redirect(route('event_admin.important_pdf_index',$event_id))->with('event_id',$event_id)->with('success','PDF Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id,$pdf_id)
    {
        $imppdf= ImportantPDFEvents::find($pdf_id);
         
        $path = ltrim($imppdf->pdf, '/');
        //  dd($path);
        if(\File::exists($path))
        {
            \File::delete($path);  
        }


        $imppdf->delete();

        return redirect(route('event_admin.important_pdf_index',$event_id))->with('event_id',$event_id)->with('success','PDF Deleted Successfully');

    }
}
