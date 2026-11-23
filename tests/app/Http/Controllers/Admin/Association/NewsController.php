<?php

namespace App\Http\Controllers\Admin\Association;

use App\Models\AssociationNews;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Models\AssociationType;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($assoc_id)
    {
        return view('pages.admin.association.news.index')->with('assoc_id',$assoc_id)->with('news',AssociationNews::where('assoc_id','=',$assoc_id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($assoc_id)
    {
        return view('pages.admin.association.news.create')->with('assoc_id',$assoc_id);
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

        $news=new AssociationNews;
        $news->assoc_id=$assoc_id;
        $news->title=$request->input('title');
        $news->date=$request->input('date');
        $news->link=$request->input('link');
        // $protocol=$request->input('protocol');

        // if($request->input('url')){
        //     if(Str::contains($request->input('url'), ['https', 'http'])){
        //     $slider->url=$request->input('url');
        //     }else{
        //     $slider->url=$protocol.'://'.$request->input('url');
        //     }
        // }
        $news->save();

        $news = AssociationNews::find($news->id);
        
        $destination_path = NULL;
        $assoc = Association::where('id','=',$assoc_id)->first();
        $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
        $final_assoc_type=str_replace('_association', '', $assoc_type);
        $destination_path = 'storage/association/'. $final_assoc_type.'/'.$assoc_id.'/news/';   

        if($request->hasFile('coverImage'))
        {
            $coverImage = $news->id.'.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move($destination_path, $coverImage);
            $news->coverImage= '/'. $destination_path.$coverImage;
        }
        $news->save();

        return redirect(route('assoc_admin.state_news_index',$assoc_id))->with('success','News Added Successfully');

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
    public function edit($assoc_id,$id)
    {
        return view('pages.admin.association.news.edit')->with('assoc_id',$assoc_id)->with('news',AssociationNews::find($id));

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
        $news= AssociationNews::find($id);
        // $news->state_name="";
        $news->title=$request->input('title');
        $news->date=$request->input('date');
        $news->link=$request->input('link');

        $destination_path = NULL;
        $assoc = Association::where('id','=',$assoc_id)->first();
        $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
        $final_assoc_type=str_replace('_association', '', $assoc_type);
        $destination_path = 'storage/association/'. $final_assoc_type.'/'.$assoc_id.'/news/';   

        if($request->hasFile('coverImage'))
        {
            $coverImage = $news->id.'.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move($destination_path, $coverImage);
            $news->coverImage= '/'.$destination_path.$coverImage;

        }
        $news->save();

        return redirect(route('assoc_admin.state_news_index',$assoc_id))->with('success','News Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($assoc_id,$id)
    {
        $news= AssociationNews::find($id);

        $path = ltrim($news->coverImage, '/');
       //  dd($path);
       if(\File::exists($path))
       {
           \File::delete($path);  
       }
        $news->delete();
        return redirect()->back()->with('success','News Deleted Successfully');

    }
}
