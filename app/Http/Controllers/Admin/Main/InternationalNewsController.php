<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InternationalNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('pages.admin.main.internationalnews.index')->with('news',News::orderBy('created_at','desc')->where('type','=','international_news')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.main.internationalnews.create');
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

        $news=new News;

        $news->title=$request->input('title');
        $news->Date=$request->input('date');
        $news->link=$request->input('link');
        $news->type='international_news';
        $news->save();

        $news = News::find($news->id);
        if($request->hasFile('coverImage'))
        {
            $coverImage = $news->id.'.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move('storage/main/news_coverImage/', $coverImage);
            $news->coverImage='/storage/main/news_coverImage/'.$coverImage;
        }

        $news->save();

        return redirect(route('admin.international_news.index'))->with('success','News Added Successfully');

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
        return view('pages.admin.main.internationalnews.edit')->with('news',News::find($id));

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

        $news= News::find($id);

        $news->title=$request->input('title');
        $news->Date=$request->input('date');
        $news->link=$request->input('link');
        $news->type='international_news';

        if($request->hasFile('coverImage'))
        {
            $coverImage = $id.'.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move('storage/main/news_coverImage/', $coverImage);
            $news->coverImage='/storage/main/news_coverImage/'.$coverImage;
        }

        $news->save();

        return redirect(route('admin.international_news.index'))->with('success','News Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news= News::find($id);

        $path = ltrim($news->coverImage, '/');
        //  dd($path);
        if(\File::exists($path))
        {
            \File::delete($path);  
        }

        $news->delete();

        return redirect(route('admin.international_news.index'))->with('success','News Deleted Successfully');


    }
}
