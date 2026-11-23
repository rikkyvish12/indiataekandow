<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\HallOfFame;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HallOfFameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.main.halloffame.index')->with('halloffame',HallOfFame::orderBy('created_at','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.main.halloffame.create');
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
        $halloffame=new HallOfFame;
        $halloffame->name=$request->input('name');
        $halloffame->title=$request->input('title');
        $halloffame->date=$request->input('date');

        $description = str_replace(' ', '', $request->input('description'));

        if($description == ""){
            return redirect()->back()->with('error','Description cannot be empty')->withInput($request->except('password'));

        }else{
            $halloffame->description=$request->input('description');
        } 

        $halloffame->intro=$request->input('intro');
        $halloffame->save();
        $halloffame = HallOfFame::find($halloffame->id);
        if($request->hasFile('coverImage'))
        {
            $halloffame_coverImage = 'cover_img.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move('storage/main/hall_Of_fame/'.$halloffame->id, $halloffame_coverImage);
            $halloffame->coverImage='/storage/main/hall_Of_fame/'.$halloffame->id.'/'.$halloffame_coverImage;
        }
        if($request->hasFile('coverImage1'))
        {
            $halloffame_coverImage1 = 'cover_img_1.'.request()->coverImage1->getClientOriginalExtension();
            request()->coverImage1->move('storage/main/hall_Of_fame/'.$halloffame->id, $halloffame_coverImage1);
            $halloffame->coverImage1='/storage/main/hall_Of_fame/'.$halloffame->id.'/'.$halloffame_coverImage1;
        }
        if($request->hasFile('coverImage2'))
        {
            $halloffame_coverImage2 = 'cover_img_2.'.request()->coverImage2->getClientOriginalExtension();
            request()->coverImage2->move('storage/main/hall_Of_fame/'.$halloffame->id, $halloffame_coverImage2);
            $halloffame->coverImage2='/storage/main/hall_Of_fame/'.$halloffame->id.'/'.$halloffame_coverImage2;
        }
        if($request->hasFile('coverImage3'))
        {
            $halloffame_coverImage3 = 'cover_img_3.'.request()->coverImage3->getClientOriginalExtension();
            request()->coverImage3->move('storage/main/hall_Of_fame/'.$halloffame->id, $halloffame_coverImage3);
            $halloffame->coverImage3='/storage/main/hall_Of_fame/'.$halloffame->id.'/'.$halloffame_coverImage3;
        }

        $halloffame->save();

        return redirect(route('admin.halloffame.index'))->with('success','Hall of Fame Added Successfully');

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
        return view('pages.admin.main.halloffame.edit')->with('halloffame',HallOfFame::find($id));

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
        $halloffame= HallOfFame::find($id);
        $halloffame->name=$request->input('name');
        $halloffame->title=$request->input('title');
        $halloffame->date=$request->input('date');
        $description = str_replace(' ', '', $request->input('description'));

        if($description == ""){
            return redirect()->back()->with('error','Description cannot be empty')->withInput($request->except('password'));

        }else{
            $halloffame->description=$request->input('description');
        } 
        
        $halloffame->intro=$request->input('intro');

        if($request->hasFile('coverImage'))
        {
            $halloffame_coverImage = 'cover_img.'.request()->coverImage->getClientOriginalExtension();
            request()->coverImage->move('storage/main/hall_Of_fame/'.$id, $halloffame_coverImage);
            $halloffame->coverImage='/storage/main/hall_Of_fame/'.$id.'/'.$halloffame_coverImage;
        }
        if($request->hasFile('coverImage1'))
        {
            $halloffame_coverImage1 = 'cover_img_1.'.request()->coverImage1->getClientOriginalExtension();
            request()->coverImage1->move('storage/main/hall_Of_fame/'.$id, $halloffame_coverImage1);
            $halloffame->coverImage1='/storage/main/hall_Of_fame/'.$id.'/'.$halloffame_coverImage1;
        }
        if($request->hasFile('coverImage2'))
        {
            $halloffame_coverImage2 = 'cover_img_2.'.request()->coverImage2->getClientOriginalExtension();
            request()->coverImage2->move('storage/main/hall_Of_fame/'.$id, $halloffame_coverImage2);
            $halloffame->coverImage2='/storage/main/hall_Of_fame/'.$id.'/'.$halloffame_coverImage2;
        }
        if($request->hasFile('coverImage3'))
        {
            $halloffame_coverImage3 = 'cover_img_3.'.request()->coverImage3->getClientOriginalExtension();
            request()->coverImage3->move('storage/main/hall_Of_fame/'.$id, $halloffame_coverImage3);
            $halloffame->coverImage3='/storage/main/hall_Of_fame/'.$id.'/'.$halloffame_coverImage3;
        }

        $halloffame->save();

        return redirect(route('admin.halloffame.index'))->with('success','Hall of Fame Added Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $halloffame= HallOfFame::find($id);
        $halloffame->delete();

        return redirect(route('admin.halloffame.index'))->with('success','Hall Of Fame Deleted Successfully');

    }
}
