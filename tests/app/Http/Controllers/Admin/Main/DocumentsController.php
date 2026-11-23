<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\Documents;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.main.documents.index')->with('documents',Documents::orderBy('created_at','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.main.documents.create');
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



        $document=new Documents;
        $document->type=$request->input('type');
        $document->name=$request->input('name');
        if($request->hasFile('file'))
        {
            $document_file = request()->file->getClientOriginalName();
            request()->file->move('storage/main/document_files/'.$request->input('type'), $document_file);
            $document->file='/storage/main/document_files/'.$request->input('type').'/'. $document_file;
        }

        $document->save();
        return redirect(route('admin.documents.index'))->with('success','Document Added Successfully');

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
    public function destroy($id)
    {
        // dd($id);
        $document= Documents::find($id);
        $path = ltrim($document->file, '/');
        //  dd($path);
        if(\File::exists($path))
        {
            \File::delete($path);  
        }

        $document->delete();
        return redirect(route('admin.documents.index'))->with('success','Document Deleted Successfully');

    }
}
