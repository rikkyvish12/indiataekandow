@extends('layouts.main.main')
@section('title')
Home

@endsection

@section('content')
<!--Main Slider Start-->
<div class="main-slider">
    <div class="home2-slider rev_slider_wrapper">
        <!-- START REVOLUTION SLIDER -->

        <div class="rev_slider_wrapper fullwidthbanner-container">
            <div id="rev-slider2" class="rev_slider fullwidthabanner">

                <ul>
                    @foreach ($sliders as $item)
                    <li data-transition="fade"> <img src="{{ $item->backgroundImage }}" alt="no-background-image-found"
                            width="1920" height="750" data-bgposition="top center" data-bgfit="cover"
                            data-bgrepeat="no-repeat" data-bgparallax="1">
                        @if($item->playerImage)
                            <div class="tp-caption  tp-resizeme" data-x="right" data-hoffset="250" data-y="top"
                                data-voffset="20" data-transform_idle="o:1;"
                                data-transform_in="x:[-75%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;"
                                data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                                data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" data-splitin="none" data-splitout="none"
                                data-start="700">
                                <div class="slide-content-box"> <img src="{{ $item->playerImage }}" alt="" > </div>
                            </div>
                        @endif

                        @if($item->description)
                            <div class="tp-caption  tp-resizeme" data-x="left" data-hoffset="150" data-y="top"
                                data-voffset="160" data-transform_idle="o:1;"
                                data-transform_in="x:[-75%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;"
                                data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                                data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" data-splitin="none" data-splitout="none"
                                data-start="700">
                                <div class="slide-content-box" id="desc_lines">
                                    <h1 style="	font-size:50px; line-height: 1.5;">
                                        {{-- {{ wordwrap()}} --}}
                                        <?php echo wordwrap($item->description,30,"<br>\n"); ?>
                                    </h1>
                                </div>
                            </div>
                        @endif

                        @if($item->url != null && $item->linkButtonText != null)

                        @switch($item->description)
                        @case(strlen($item->description) > 90)
                        <div class="tp-caption  tp-resizeme" data-x="left" data-hoffset="155" data-y="top"
                        data-voffset="460" data-transform_idle="o:1;"
                        data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;"
                        data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                        data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" data-splitin="none" data-splitout="none"
                        data-start="700">
                                    <div class="slide-content-box"> <a href="{{$item->url}}" target="_blank"
                                    rel="noopener noreferrer">{{$item->linkButtonText}}</a> </div>

                        </div>
                        @break
                        @case(strlen($item->description) > 80)
                        <div class="tp-caption  tp-resizeme" data-x="left" data-hoffset="155" data-y="top"
                        data-voffset="460" data-transform_idle="o:1;"
                        data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;"
                        data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                        data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" data-splitin="none" data-splitout="none"
                        data-start="700">
                                    <div class="slide-content-box"> <a href="{{$item->url}}" target="_blank"
                                    rel="noopener noreferrer">{{$item->linkButtonText}}</a> </div>

                        </div>
                        @break
                        @case(strlen($item->description) > 70)
                        <div class="tp-caption  tp-resizeme" data-x="left" data-hoffset="155" data-y="top"
                        data-voffset="460" data-transform_idle="o:1;"
                        data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;"
                        data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                        data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" data-splitin="none" data-splitout="none"
                        data-start="700">
                                    <div class="slide-content-box"> <a href="{{$item->url}}" target="_blank"
                                    rel="noopener noreferrer">{{$item->linkButtonText}}</a> </div>

                        </div>
                        @break
                        @case(strlen($item->description) > 60)
                        <div class="tp-caption  tp-resizeme" data-x="left" data-hoffset="155" data-y="top"
                        data-voffset="380" data-transform_idle="o:1;"
                        data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;"
                        data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                        data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" data-splitin="none" data-splitout="none"
                        data-start="700">
                                    <div class="slide-content-box"> <a href="{{$item->url}}" target="_blank"
                                    rel="noopener noreferrer">{{$item->linkButtonText}}</a> </div>

                        </div>
                        @break
                        @case(strlen($item->description) > 50)
                        <div class="tp-caption  tp-resizeme" data-x="left" data-hoffset="155" data-y="top"
                        data-voffset="360" data-transform_idle="o:1;"
                        data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;"
                        data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                        data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" data-splitin="none" data-splitout="none"
                        data-start="700">
                                    <div class="slide-content-box"> <a href="{{$item->url}}" target="_blank"
                                    rel="noopener noreferrer">{{$item->linkButtonText}}</a> </div>

                        </div>
                        @break
                        @case(strlen($item->description) > 40)
                        <div class="tp-caption  tp-resizeme" data-x="left" data-hoffset="155" data-y="top"
                        data-voffset="330" data-transform_idle="o:1;"
                        data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;"
                        data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                        data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" data-splitin="none" data-splitout="none"
                        data-start="700">
                                    <div class="slide-content-box"> <a href="{{$item->url}}" target="_blank"
                                    rel="noopener noreferrer">{{$item->linkButtonText}}</a> </div>

                        </div>
                        @break
                        @case(strlen($item->description) > 30)
                        <div class="tp-caption  tp-resizeme" data-x="left" data-hoffset="155" data-y="top"
                        data-voffset="310" data-transform_idle="o:1;"
                        data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;"
                        data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                        data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" data-splitin="none" data-splitout="none"
                        data-start="700">
                                    <div class="slide-content-box"> <a href="{{$item->url}}" target="_blank"
                                    rel="noopener noreferrer">{{$item->linkButtonText}}</a> </div>

                        </div>
                        @break
                         @default
                            <div class="tp-caption  tp-resizeme" data-x="left" data-hoffset="155" data-y="top"
                            data-voffset="250" data-transform_idle="o:1;"
                            data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;"
                            data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                            data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" data-splitin="none" data-splitout="none"
                            data-start="700">
                                        <div class="slide-content-box"> <a href="{{$item->url}}" target="_blank"
                                        rel="noopener noreferrer">{{$item->linkButtonText}}</a> </div>
                        </div>
                       @endswitch
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- END REVOLUTION SLIDER -->
    </div>
</div>
<!--Main Slider Start-->
<div class="main-content wf100 default-bg">
    <!--News & Media Gallery Start-->
    <section class="wf100  sports-news" style="margin-top:50px">
        <div class="container">
            @if ($profile)
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>About Taekwondo Federation Of India</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!--News Box Start-->
                    <div class="news-list-post">
                        <div style="padding: 34px 50px 40px; width: 100%;">
                            <a href="/taekwondo" class="text-dark a-tfi fadeInLeft ">{{ $profile->description }} </a>
                            <a href="/taekwondo" class="rm" style="float: right">>>Read more</a>
                        </div>
                        <!--News Box End-->
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-lg-12">
                    <!--News Box Start-->
                    <div class="news-list-post">
                        <div style="padding: 34px 50px 40px; width: 100%; text-align:center">
                            <b>*Information not available*</b>
                        </div>
                        <!--News Box End-->
                    </div>
                </div>
            </div>
            @endif

    </section>
    <!--News & Media Gallery End-->
    <!--Main Content Start-->
    <!--News & Updates Start-->
    @if(count($news)>0)
    <section class="news-updates wf100 p90">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>News Updates</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="newsupdate-slider" class="owl-carousel owl-theme">
                        @foreach ($news as $item)
                        <!--Item Start-->
                        @if($item->type == 'international_news')
                        <div class="item" style="height:400px">
                            <div class="hnews-box">
                            <div class="thumb"><a href="{{ $item->link }}" target="_blank"><i class="fas fa-newspaper"></i></a>
                                <img src="{{ $item->coverImage }}" style="width: 350px;height:350px" alt="">
                                    </div>
                                <div class="hnews-txt" style="height: 180px">
                                      <ul class="news-meta">
                                        <li><i class="fas fa-calendar-alt"></i> {{ date('d-M-Y', strtotime($item->Date));}}</li>
                                      </ul>
                                    <h4> <a href="{{ $item->link }}" target="_blank">{{ \Illuminate\Support\Str::limit($item->title, 50, $end='...')  }}</a> </h4>
                                    <a class="rm" href="{{ $item->link }}" target="_blank">News Detail <i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                      @else
                      <div class="item" style="height:400px">
                        <div class="hnews-box">
                        <div class="thumb"><a href="{{ url('/'.$item->type.'/'.$item->id.'/'.$item->title) }}" target=""><i class="fas fa-newspaper"></i></a>
                            <img src="{{ $item->coverImage }}" style="width: 350px;height:350px" alt="">
                                </div>
                                <div class="hnews-txt" style="height: 180px">
                                  <ul class="news-meta">
                                    <li><i class="fas fa-calendar-alt"></i> {{ date('d-M-Y', strtotime($item->Date));}}</li>
                                  </ul>
                                <h4> <a href="{{ url('/'.$item->type.'/'.$item->id.'/'.$item->title) }}" target="">{{ \Illuminate\Support\Str::limit($item->title, 50, $end='...')  }}</a> </h4>
                                <a class="rm" href="{{ url('/'.$item->type.'/'.$item->id.'/'.$item->title) }}" target="">News Detail <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @endif
                        <!--Item End-->
                        @endforeach
                    </div>
        </div>

            </div>
        </div>
    </section>
    @endif
    <!--News & Updates End-->
    <!--News & Updates Start-->
    @if(count($images)>0)
    <section class="news-updates wf100 p90">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>Image Gallery</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="newsupdate-slider2" class="owl-carousel owl-theme">
                        @foreach ($images->sortByDesc('timestamp') as $item)
                        <!--Item Start-->
                        <div class="item">
                            <div class="hnews-box">
                                <div class="thumb"><span>{{ $item->album_name }}</span> <a
                                        href="{{ url('image_gallery/'.$item->id.'/'.$item->album_name) }}"><i
                                            class="fas fa-image"></i></a><img src="{{ $item->coverImage }}"
                                        style="width: 350px;height:250px" alt=""></div>
                            </div>
                        </div>
                        <!--Item End-->
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- <div style="text-align: center" class="mt-5 text-danger">
            <a href="#"  class="btn  btn-outline-danger btn-sm" >More <i class="fa fa-chevron-circle-right"></i></a>
          </div> --}}
        </div>
    </section>
    @endif
    <!--News & Updates End-->
    <!--News & Updates Start-->
    @if(count($videos)>0)
    <section class="news-updates wf100 p90">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2>Video Gallery</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div id="newsupdate-slider3" class="owl-carousel owl-theme">
                        @foreach ($videos->sortByDesc('timestamp') as $item)
                        <!--Item Start-->
                        <div class="item">
                            <div class="hnews-box">
                                <div class="thumb"><span>{{ $item->album_name }}</span><a
                                        href="{{ url('video_gallery/'.$item->id.'/'.$item->album_name) }}"><i
                                            class="fas fa-film"></i></a><img src="{{ $item->cover_image }}"
                                        style="width: 350px;height:250px" alt=""></div>
                            </div>
                        </div>
                        <!--Item End-->
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- <div style="text-align: center" class="mt-5 text-danger">
            <a href="#"  class="btn  btn-outline-danger btn-sm" >More <i class="fa fa-chevron-circle-right"></i></a>
          </div> --}}
        </div>
    </section>
    @endif
    <!--News & Updates End-->
    <!--Team Section Start-->
    <section class="wf100 h3-team" style="display: none">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-4">
                    <div class="section-title">
                        <h2>TFI Players</h2>
                    </div>
                </div>
            </div>
            <div class="tab-content wf100" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-defenders" role="tabpanel" aria-labelledby="nav-1-tab">
                    <div class="row">

                        @foreach ($athlete as $item)
                        <!--Player Start-->
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="lp-box">
                                <div class="lp-thumb"> <a class="vp" href="#">View Profile</a>
                                    <img src="{{ $item->image }}" style="width: 255px;height:349px" alt=""></div>
                                <div class="lp-name">
                                    <h4><a href="#">{{ $item->name }}</a></h4>
                                    <strong>{{ $item->title }}</strong>
                                </div>
                            </div>
                        </div>
                        <!--Player End-->
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--Team Section End-->
    <!--Ad Start-->
    <div class="banner-wrap text-center p-4 wf100" style="background: white"> <img src="images/placeyourbanner.png"
            alt="">
    </div>
    <!--Ad End-->
    <!--News & Media Gallery End-->

</div>
<!--Main Content End-->

@endsection


