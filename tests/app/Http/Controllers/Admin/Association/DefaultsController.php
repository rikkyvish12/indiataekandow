<?php

namespace App\Http\Controllers\Admin\Association;

use App\Models\DefaultAssociation;
use App\Models\AssociationType;
use App\Models\Association;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DefaultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($assoc_id)
    {
        // dd($assoc_id);
        return view('pages.admin.association.defaults.index')->with('assoc_id',$assoc_id)->with('defaults',DefaultAssociation::where('assoc_id','=',$assoc_id)->first());
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
            'banner' => 'dimensions:min_width=1915,min_height=295,max_width=1925,max_height=305',
            'background' => 'dimensions:min_width=1915,min_height=1150,max_width=1925,max_height=1162',
            'logo' => 'dimensions:min_width=345,min_height=245,max_width=355,max_height=255',     
            // 'footerBackground' => 'dimensions:min_width=1820,min_height=1057,max_width=2020,max_height=1257'

          
        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $defaults= DefaultAssociation::find($assoc_id);
        // $defaults->save();
        // $defaults = DefaultAssociation::find($defaults->id);

        $destination_path =NULL;
       


        $assoc = Association::where('id','=',$assoc_id)->first();
        $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
        $final_assoc_type=str_replace('_association', '', $assoc_type);
        $destination_path= 'storage/association/'. $final_assoc_type.'/'.$assoc_id.'/defaults/';   
       
        
        if($request->hasFile('logo'))
        {
            $logo = 'default_logo.'.request()->logo->getClientOriginalExtension();
            request()->logo->move($destination_path, $logo);
            $defaults->logo='/'.$destination_path.$logo;
        }

        if($request->hasFile('background'))
        {
        $background = 'default_bg.'.request()->background->getClientOriginalExtension();
        request()->background->move( $destination_path, $background);
        $defaults->background='/'. $destination_path.$background;
        }
        if($request->hasFile('banner'))
        {
        $banner = 'default_banner.'.request()->banner->getClientOriginalExtension();
        request()->banner->move($destination_path, $banner);
        $defaults->banner='/'.$destination_path.$banner;
        }

       

        $defaults->save();

        // if($request->hasFile('background'))
        // {
        // $background = 'default_bg.'.request()->background->getClientOriginalExtension();
        // request()->background->move('storage/association/state/'.$assoc_id.'/default_bg/', $background);
        // $defaults->background='/storage/association/state/'.$assoc_id.'/default_bg/'.$background;
        // }
        // if($request->hasFile('banner'))
        // {
        // $banner = 'default_banner.'.request()->banner->getClientOriginalExtension();
        // request()->banner->move('storage/association/state/'.$assoc_id.'/default_banner/', $banner);
        // $defaults->banner='/storage/association/state/'.$assoc_id.'/default_banner/'.$banner;
        // }

        // $defaults->save();

        return redirect()->back()->with('success','Defaults have been added');
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
    public function update(Request $request,$assoc_id, $default_bg_id)
    {
        $validator = \Validator::make($request->all(), [
            'banner' => 'dimensions:min_width=1915,min_height=295,max_width=1925,max_height=305',
            'background' => 'dimensions:min_width=1915,min_height=1150,max_width=1925,max_height=1162',
            'logo' => 'dimensions:min_width=345,min_height=245,max_width=355,max_height=255',          

            // 'footerBackground' => 'dimensions:min_width=1820,min_height=1057,max_width=2020,max_height=1257'

          
        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }


        $defaults= DefaultAssociation::find($default_bg_id);
        
        $destination_path =NULL;
       


        $assoc = Association::where('id','=',$assoc_id)->first();
        $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
        $final_assoc_type=str_replace('_association', '', $assoc_type);
        $destination_path= 'storage/association/'. $final_assoc_type.'/'.$assoc_id.'/defaults/';   
  
        
        if($request->hasFile('logo'))
        {
            $logo = 'default_logo.'.request()->logo->getClientOriginalExtension();
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

        $defaults->save();

        return redirect()->back()->with('success','Defaults have been added');

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
