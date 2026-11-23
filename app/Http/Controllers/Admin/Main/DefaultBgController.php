<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\Defaults;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
class DefaultBgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $defaults = Defaults::orderBy('created_at','desc')->first();
            if($defaults)
                 return view('pages.admin.main.defaults.index')->with('defaults', $defaults);
            else
                return view('pages.admin.main.defaults.index');

        }catch(Exception $e){
            return $e;
        }
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
        $validator = \Validator::make($request->all(), [
            'logo' => 'dimensions:min_width=345,min_height=245,max_width=355,max_height=255',
            'banner' => 'dimensions:min_width=1910,min_height=290,max_width=1930,max_height=310',
            'background' => 'dimensions:min_width=1910,min_height=1147,max_width=1930,max_height=1167',
            'footerBackground' => 'dimensions:min_width=1910,min_height=1140,max_width=1930,max_height=1167'

          
        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $defaults=new Defaults;

        $destination_path='storage/main/defaults/';   
        
        if($request->hasFile('logo'))
        {
            $logo ='default_logo.'.request()->logo->getClientOriginalExtension();
            request()->logo->move($destination_path, $logo);
            $defaults->logo='/'.$destination_path.$logo;
        }
        if($request->hasFile('background'))
        {
        $background = 'default_bg.'.request()->background->getClientOriginalExtension();
        request()->background->move($destination_path, $background);
        $defaults->background='/'.$destination_path.$background;
        }
        if($request->hasFile('banner'))
        {
        $banner = 'default_banner.'.request()->banner->getClientOriginalExtension();
        request()->banner->move($destination_path, $banner);
        $defaults->banner='/'.$destination_path.$banner;
        }

        if($request->hasFile('footerBackground'))
        {
            $footerBackground = 'default_footer_bg.'.request()->footerBackground->getClientOriginalExtension();
            request()->footerBackground->move('storage/main/defaults/', $footerBackground);
            $defaults->footerBackground='/storage/main/defaults/'.$footerBackground;
        }

        $defaults->save();

        return redirect(route('admin.default_background.index'))->with('success','Defaults have been added');
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
        $validator = \Validator::make($request->all(), [
            'banner' => 'dimensions:min_width=1910,min_height=290,max_width=1930,max_height=310',
            'logo' => 'dimensions:min_width=345,min_height=245,max_width=355,max_height=255',
            'background' => 'dimensions:min_width=1910,min_height=1147,max_width=1930,max_height=1167',
            'footerBackground' => 'dimensions:min_width=1820,min_height=1057,max_width=2020,max_height=1257'


          
        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }


        $defaults= Defaults::find($id);
        $destination_path='storage/main/defaults/';   
        
        if($request->hasFile('logo'))
        {
            $logo ='default_logo.'.request()->logo->getClientOriginalExtension();
            request()->logo->move($destination_path, $logo);
            $defaults->logo='/'.$destination_path.$logo;
        }
        if($request->hasFile('background'))
        {
        $background = 'default_bg.'.request()->background->getClientOriginalExtension();
        request()->background->move($destination_path, $background);
        $defaults->background='/'.$destination_path.$background;
        }
        if($request->hasFile('banner'))
        {
        $banner = 'default_banner.'.request()->banner->getClientOriginalExtension();
        request()->banner->move($destination_path, $banner);
        $defaults->banner='/'.$destination_path.$banner;
        }
        if($request->hasFile('footerBackground'))
        {
            $footerBackground = 'default_footer_bg.'.request()->footerBackground->getClientOriginalExtension();
            request()->footerBackground->move($destination_path, $footerBackground);
            $defaults->footerBackground='/'.$destination_path.$footerBackground;
        }
        $defaults->save();

        return redirect(route('admin.default_background.index'))->with('success','Defaults have been updated');

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
