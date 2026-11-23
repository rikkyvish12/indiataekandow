<?php

namespace App\Http\Controllers\Admin\Association;

use Illuminate\Http\Request;
use App\Models\AssociationDocuments;
use App\Models\Association;
use App\Models\AssociationType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($assoc_id)
    {
        return view('pages.admin.association.documents.index')->with('assoc_id',$assoc_id)->with('documents',AssociationDocuments::orderBy('created_at','desc')->where('assoc_id','=',$assoc_id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($assoc_id)
    {
        return view('pages.admin.association.documents.create')->with('assoc_id',$assoc_id);
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
            'name' => 'required',
            'file' => 'required|mimes:pdf',           
            

       ]);

       if ($validator->fails()) {
           // dd("in if");
           return  redirect()->back()
                       ->withErrors($validator)
                       ->withInput($request->except('password'))
                       ->with('autofocus', true);
       }

        $doc_type = $request->input('type');
        $document=new AssociationDocuments;
        $document->type=$request->input('type');
        $document->assoc_id=$assoc_id;
        $document->name=$request->input('name');
        
        $destination_path = NULL;
        $assoc = Association::where('id','=',$assoc_id)->first();
        $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
        $final_assoc_type=str_replace('_association', '', $assoc_type);
        $destination_path = 'storage/association/'. $final_assoc_type.'/'.$assoc_id.'/document_files/'.$doc_type.'/';   

        if($request->hasFile('file'))
        {
            $document_file = request()->file->getClientOriginalName();
            request()->file->move($destination_path, $document_file);
            $document->file='/'.$destination_path.$document_file;
        }

        $document->save();
        return redirect(route('assoc_admin.documents_index',$assoc_id))->with('success','Document Added Successfully');

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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($assoc_id,$id)
    {
        $document= AssociationDocuments::find($id);
        $path = ltrim($document->file, '/');
        //  dd($path);
        if(\File::exists($path))
        {
            \File::delete($path);  
        }

        $document->delete();
        return redirect()->back()->with('success','Document Deleted Successfully');

    }
}
