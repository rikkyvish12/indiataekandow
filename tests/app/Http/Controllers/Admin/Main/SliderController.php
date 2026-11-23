<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\Input;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('pages.admin.main.slider.index')->with('slider',Slider::get()->sortBy("position"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.main.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all())  ;
        // $description= null;
        // $url= null;
        // $linkButtonText=null;
        // $playerImage=null;

        $validator = \Validator::make($request->all(), [
            'position' => 'required|unique:sliders,position',
            'url' => 'nullable|url',
            'backgroundImage' =>'required|dimensions:min_width=1915,min_height=745,max_width=1925,max_height=755',
            'playerImage'=>'nullable|dimensions:min_width=520,min_height=745,max_width=530,max_height=755'

        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }

        $slider=new Slider;
        $slider->position = $request->input('position');

        if($request->has('description')){
            $slider->description=$request->input('description');
        }

        // $protocol=$request->input('protocol');

        // if($request->input('url')){
        //     if(Str::contains($request->input('url'), ['https', 'http'])){
        //     $slider->url=$request->input('url');
        //     }else{
        //     $slider->url=$protocol.'://'.$request->input('url');
        //     }
        // }
        if($request->has('url')){
        $slider->url=$request->input('url');

        }
        if($request->has('linkButtonText')){
            $slider->linkButtonText=$request->input('linkButtonText');
        }


        if($request->hasFile('backgroundImage'))
        {
            $slider_backgroundImage ='slider_'.$request->input('position').'.'.request()->backgroundImage->getClientOriginalExtension();
            request()->backgroundImage->move('storage/main/sliders/', $slider_backgroundImage);
            $slider->backgroundImage='/storage/main/sliders/'.$slider_backgroundImage;
        }
        if($request->hasFile('playerImage'))
        {
            $slider_playerImage = 'player_'.$request->input('position').'.'.request()->playerImage->getClientOriginalExtension();
            request()->playerImage->move('storage/main/sliders/slider_playerImage/', $slider_playerImage);
            $slider->playerImage='/storage/main/sliders/slider_playerImage/'.$slider_playerImage;
        }

            $slider->save();
            return redirect(route('admin.slider.index'))->with('success','Slider Added Successfully');


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
        $slider =  Slider::find($id);
        $url = $slider['url'];

        $parseUrlHost = parse_url( $url,PHP_URL_HOST);
        $parseUrlScheme = parse_url( $url,PHP_URL_SCHEME);
// dd($parseUrlHost);

        $slider->parseUrlHost = $parseUrlHost;

        $slider->parseUrlScheme = $parseUrlScheme;
        // $url =;
        // dd($parseUrl);
        // var_dump(parse_url($url));
        // var_dump(parse_url($url, PHP_URL_SCHEME));
        // var_dump(parse_url($url, PHP_URL_USER));
        // var_dump(parse_url($url, PHP_URL_PASS));
        // var_dump(parse_url($url, PHP_URL_HOST));
        // var_dump(parse_url($url, PHP_URL_PORT));
        // var_dump(parse_url($url, PHP_URL_PATH));
        // var_dump(parse_url($url, PHP_URL_QUERY));
        // var_dump(parse_url($url, PHP_URL_FRAGMENT));
        // dd($url);

        return view('pages.admin.main.slider.edit')->with('slider',$slider);
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
            'position' => 'required|unique:sliders,position,'.$id.',id',
            'url' => 'nullable|url',
            'backgroundImage' =>'dimensions:min_width=1915,min_height=745,max_width=1925,max_height=755',
            'playerImage'=>'nullable|dimensions:min_width=520,min_height=745,max_width=530,max_height=755'


        ]);
        if ($validator->fails()) {
            // dd("in if");
            return  redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('autofocus', true);
        }



        $description= null;
        $url= null;
        $linkButtonText=null;
       // $playerImage=null;

        $slider= Slider::find($id);
// dd($request->input('position'));
        $slider->position = $request->input('position');


        // $slider->title=$request->input('title');
        if($request->has('description')){
             $slider->description=$request->input('description');
        }else{
            $slider->description=NULL;

        }
            //  $slider->description= $description;

        // $protocol = $request->input('protocol');

        // if($request->input('url')){
        //     if(Str::contains($request->input('url'), ['https', 'http'])){
        //     $slider->url=$request->input('url');
        //  } else{
        //     $slider->url=$protocol.'://'.$request->input('url');
        //  }
        // }else{
        //     $slider->url=$url;
        // }

        if($request->has('url')){
            $slider->url=$request->input('url');

            }else{
                $slider->url= NULL;

            }
        if($request->has('linkButtonText')){
            $slider->linkButtonText=$request->input('linkButtonText');
        }else{
            $slider->linkButtonText= NULL;
        }



        if($request->hasFile('backgroundImage'))
        {
            $slider_backgroundImage ='slider_'.$request->input('position').'.'.request()->backgroundImage->getClientOriginalExtension();
            request()->backgroundImage->move('storage/main/sliders/', $slider_backgroundImage);
            $slider->backgroundImage='/storage/main/sliders/'.$slider_backgroundImage;
        }
        if($request->hasFile('playerImage'))
        {
            $slider_playerImage = 'player_'.$request->input('position').'.'.request()->playerImage->getClientOriginalExtension();
            request()->playerImage->move('storage/main/sliders/slider_playerImage/', $slider_playerImage);
            $slider->playerImage='/storage/main/sliders/slider_playerImage/'.$slider_playerImage;
        }
        else{
            //$slider->playerImage= NULL;
        }
    //    $exist =  Slider::where('position', $request->input('position'))->exists();
    // //    dd($exist);
    //     if($exist){
    //         return redirect(route('admin.slider.index'))->with('error','Slider with specified position already exist');
    //     }else{
    //         $slider->position=$request->input('position');
    //         $slider->save();
    //         return redirect(route('admin.slider.index'))->with('success','Slider Added Successfully');
    //     }

            $slider->save();

        return redirect(route('admin.slider.index'))->with('success','Slider Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $slider=Slider::find($id);
       $path_bG = ltrim($slider->backgroundImage, '/');
       $path_pImg = ltrim($slider->playerImage, '/');
        //  dd($path);
        if(\File::exists($path_bG))
        {
            // echo" if";
            // dd($path);
            \File::delete($path_bG);
        }
        if(\File::exists($path_pImg))
        {
            // echo" if";
            // dd($path);
            \File::delete($path_pImg);
        }
       $slider->delete();
       return redirect(route('admin.slider.index'))->with('success','Slider Deleted Successfully');

    }
}
