<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\MainProfile;
use App\Models\Defaults;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.main.profile.index')->with('profile',MainProfile::orderBy('created_at','desc')->first());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = \Validator::make($request->all(), [
            'title' =>'required',
            'description' =>'required',
            'smallDescription' =>'required',
            'address' =>'required',
            'mirache' =>'required',
            'map' =>'required',
            'number' =>'required',
            'email' =>'required',          
            'send_to_email' =>'required',          
            
          
        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }

        

        $profile=new MainProfile;
        // if($request->hasFile('logo'))
        // {
        //     $path = 'storage/main/logo';

        //     if(\File::exists($path))
        //         {
        //             \File::deleteDirectory($path);
        //         }
        //     $logo ='logo.'.request()->logo->getClientOriginalExtension();
        //     request()->logo->move('storage/main/logo/', $logo);
        //     $profile->logo='/storage/main/logo/'.$logo;
        // }
        $profile->title=$request->input('title');
        $profile->description=$request->input('description');
        $profile->smallDescription=$request->input('smallDescription');
        $profile->address=$request->input('address');
        $profile->mirache=$request->input('mirache');
        $profile->map=$request->input('map');
        $profile->number=$request->input('number');
        $profile->email=$request->input('email');
        $profile->send_to_email=$request->input('send_to_email');
        $profile->send_to_email_2=$request->input('send_to_email_2');


        $profile->save();

        return redirect(route('admin.profile.index'))->with('success','Profile Added Successfully');
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
       

        // dd($request->all());
        $validator = \Validator::make($request->all(), [
            'logo' => 'dimensions:min_width=290,min_height=370,max_width=372,max_height=430',
            'title' =>'required',
            'description' =>'required',
            'smallDescription' =>'required',
            'address' =>'required',
            'mirache' =>'required',
            'map' =>'required',
            'number' =>'required',
            'email' =>'required', 
            'send_to_email' =>'required',          
            
        ]);

        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }
        $profile= MainProfile::find($id);
        // if($request->hasFile('logo'))
        // {
        //     $path = 'storage/main/logo';

        //     if(\File::exists($path))
        //         {
        //             \File::deleteDirectory($path);
        //         }
        //     $logo ='logo.'.request()->logo->getClientOriginalExtension();
        //     request()->logo->move('storage/main/logo/', $logo);
        //     $profile->logo='/storage/main/logo/'.$logo;
        // }
        $profile->title=$request->input('title');
        $profile->description=$request->input('description');
        $profile->smallDescription=$request->input('smallDescription');
        $profile->address=$request->input('address');
        $profile->mirache=$request->input('mirache');
        $profile->map=$request->input('map');
        $profile->number=$request->input('number');
        $profile->email=$request->input('email');
        $profile->send_to_email=$request->input('send_to_email');
        $profile->send_to_email_2=$request->input('send_to_email_2');

        $profile->save();
// dd("update");
        return redirect(route('admin.profile.index'))->with('success','Profile Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
