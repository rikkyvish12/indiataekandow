<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\Awards;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.main.awards.index')->with('award',Awards::orderBy('created_at','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.main.awards.create');
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
            'description' => 'required',
            'title' => 'required',
            'date' => 'required',
            'intro' => 'required',
            'coverImage' =>'required|dimensions:min_width=345,min_height=245,max_width=355,max_height=255',
            'coverImage1' =>'dimensions:min_width=345,min_height=245,max_width=355,max_height=255',
            'coverImage2' =>'dimensions:min_width=345,min_height=245,max_width=355,max_height=255',
            'coverImage3' =>'dimensions:min_width=345,min_height=245,max_width=355,max_height=255'

            

        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }
        
        $awards=new Awards;
        $awards->name=$request->input('name');
        $awards->title=$request->input('title');
        $awards->date=$request->input('date');
        $awards->description=$request->input('description');

        // $description = str_replace(' ', '', $request->input('description'));


        // if($description == ""){
        //     return redirect()->back()->with('error','Description cannot be empty')->withInput($request->except('password'));

        // }else{
        //     $awards->description=$request->input('description');
        // }
        $awards->intro=$request->input('intro');
        $awards->save();
        $awards = Awards::find($awards->id);
        if($request->hasFile('coverImage'))
        {
            $awards_coverImage ='cover_img.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move('storage/main/awards_honorured/'.$awards->id, $awards_coverImage);
            $awards->coverImage='/storage/main/awards_honorured/'.$awards->id.'/'.$awards_coverImage;
        }
        if($request->hasFile('coverImage1'))
        {
            $awards_coverImage1 ='cover_img_1.'.request()->coverImage1->getClientOriginalExtension();
            request()->coverImage1->move('storage/main/awards_honorured/'.$awards->id, $awards_coverImage1);
            $awards->coverImage1='/storage/main/awards_honorured/'.$awards->id.'/'.$awards_coverImage1;
        }
        if($request->hasFile('coverImage2'))
        {
            $awards_coverImage2 = 'cover_img_2.'.request()->coverImage2->getClientOriginalExtension();
            request()->coverImage2->move('storage/main/awards_honorured/'.$awards->id, $awards_coverImage2);
            $awards->coverImage2='/storage/main/awards_honorured/'.$awards->id.'/'.$awards_coverImage2;
        }
        if($request->hasFile('coverImage3'))
        {
            $awards_coverImage3 = 'cover_img_3.'.request()->coverImage3->getClientOriginalExtension();
            request()->coverImage3->move('storage/main/awards_honorured/'.$awards->id, $awards_coverImage3);
            $awards->coverImage3='/storage/main/awards_honorured/'.$awards->id.'/'.$awards_coverImage3;
        }


        $awards->save();

        return redirect(route('admin.award.index'))->with('success','Award Added Successfully');

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
        return view('pages.admin.main.awards.edit')->with('award',Awards::find($id));

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
            'name' => 'required',
            'description' => 'required',
            'title' => 'required',
            'date' => 'required',
            'intro' => 'required',
            'coverImage' =>'dimensions:min_width=345,min_height=245,max_width=355,max_height=255',
            'coverImage1' =>'dimensions:min_width=345,min_height=245,max_width=355,max_height=255',
            'coverImage2' =>'dimensions:min_width=345,min_height=245,max_width=355,max_height=255',
            'coverImage3' =>'dimensions:min_width=345,min_height=245,max_width=355,max_height=255'

            

        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }

        $awards= Awards::find($id);
        $awards->name=$request->input('name');
        $awards->title=$request->input('title');
        $awards->date=$request->input('date');
        $awards->description=$request->input('description');

        // $description = str_replace(' ', '', $request->input('description'));


        // if($description == ""){
        //     return redirect()->back()->with('error','Description cannot be empty')->withInput($request->except('password'));

        // }else{
        //     $awards->description=$request->input('description');
        // }        
        $awards->intro=$request->input('intro');

        if($request->hasFile('coverImage'))
        {
            $awards_coverImage ='cover_img.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move('storage/main/awards_honorured/'.$id, $awards_coverImage);
            $awards->coverImage='/storage/main/awards_honorured/'.$id.'/'.$awards_coverImage;
        }
        if($request->hasFile('coverImage1'))
        {
            $awards_coverImage1 ='cover_img_1.'.request()->coverImage1->getClientOriginalExtension();
            request()->coverImage1->move('storage/main/awards_honorured/'.$id, $awards_coverImage1);
            $awards->coverImage1='/storage/main/awards_honorured/'.$id.'/'.$awards_coverImage1;
        }
        if($request->hasFile('coverImage2'))
        {
            $awards_coverImage2 = 'cover_img_2.'.request()->coverImage2->getClientOriginalExtension();
            request()->coverImage2->move('storage/main/awards_honorured/'.$id, $awards_coverImage2);
            $awards->coverImage2='/storage/main/awards_honorured/'.$id.'/'.$awards_coverImage2;
        }
        if($request->hasFile('coverImage3'))
        {
            $awards_coverImage3 = 'cover_img_3.'.request()->coverImage3->getClientOriginalExtension();
            request()->coverImage3->move('storage/main/awards_honorured/'.$id, $awards_coverImage3);
            $awards->coverImage3='/storage/main/awards_honorured/'.$id.'/'.$awards_coverImage3;
        }

        $awards->save();

        return redirect(route('admin.award.index'))->with('success','Award Added Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $awards= Awards::find($id);
        $awards->delete();

        return redirect(route('admin.award.index'))->with('success','Award Deleted Successfully');

    }
}
