@extends('layouts.main.main')

@section('title')
    Taekwondo |
@endsection

@section('content')
<!--Main Slider Start-->
  <div class="inner-banner-header wf100 default-banner">
    <h1 >Taekwondo</h1>
    <div class="gt-breadcrumbs">
      <ul>
        <li> <a href="{{ url('/') }}"> <i class="fas fa-home"></i> Home </a> </li>
        <li> <a href="{{ url('/taekwondo') }}"  class="active"> Taekwondo </a> </li>
      </ul>
    </div>
  </div>
  <!--Main Slider Start-->
  <!--Main Content Start-->
<div class="main-content innerpagebg wf100 p80 default-bg">
  <!--News Large Page Start-->
  <!--Start-->
  <div class="news-details">
    <div class="container">
      <div class="row">
        @if($taekwondo)

        <!--News Start-->
        <div class="col-md-12">
          <div class="section-title">
            <h2>What Is Taekwondo</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="news-details-wrap">
            <div class="news-large-post">
            <div class="post-txt">
              @if( !empty($taekwondo->taekwondo))
                {!! $taekwondo->taekwondo !!}
                @else
                <p style="text-align: center">No Taekwondo info Added
                </p>
                @endif

            </div>
            </div>
          </div>
        </div>
        <!--News End-->            
        <!--News Start-->
        <div class="col-md-12">
          <div class="section-title">
            <h2>India Taekwondo</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="news-details-wrap">
            <div class="news-large-post">
            <div class="post-txt">
             @if( !empty($taekwondo->india_taekwondo))
              {!! $taekwondo->india_taekwondo !!}
              @else
              <p style="text-align: center">No India Taekwondo info Added
              </p>
              @endif
           </div>
            </div>
          </div>
        </div>
        <!--News End-->
        <!--News Start-->
        <div class="col-md-12">
          <div class="section-title">
            <h2>World Taekwondo</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="news-details-wrap">
            <div class="news-large-post">
            <div class="post-txt">
              @if( !empty($taekwondo->world_taekwondo))
              {!! $taekwondo->world_taekwondo !!}
              @else
              <p style="text-align: center">No World Taekwondo info Added
              </p>
              @endif
            </div>
            </div>
          </div>
        </div>
        <!--News End-->
        <!--News Start-->
        <div class="col-md-12">
          <div class="section-title">
            <h2>Asian Taekwondo Union</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="news-details-wrap">
            <div class="news-large-post">
            <div class="post-txt">
              @if( !empty($taekwondo->asian_taekwondo_union))
              {!! $taekwondo->asian_taekwondo_union !!}
              @else
              <p style="text-align: center">No asian taekwondo union info Added
              </p>
              @endif
            </div>
            </div>
          </div>
        </div>
        <!--News End-->
        <!--News Start-->
        <div class="col-md-12">
          <div class="section-title">
            <h2>Taekwondo Sport</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="news-details-wrap">
            <div class="news-large-post">
            <div class="post-txt">
              @if( !empty($taekwondo->taekwondo_sport))
              {!! $taekwondo->taekwondo_sport !!}
              @else
              <p style="text-align: center">No taekwondo sport info Added
              </p>
              @endif
            </div>
            </div>
          </div>
        </div>
        <!--News End-->
        <!--News Start-->
        <div class="col-md-12">
          <div class="section-title">
            <h2>Kyorogi</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="news-details-wrap">
            <div class="news-large-post">
            <div class="post-txt">
              @if( !empty($taekwondo->kyorogi))
              {!! $taekwondo->kyorogi !!}
              @else
              <p style="text-align: center">No kyorogi info Added
              </p>
              @endif
            </div>
            </div>
          </div>
        </div>
        <!--News End-->

          <!--News Start-->
          <div class="col-md-12">
            <div class="section-title">
              <h2>Poomsae</h2>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="news-details-wrap">
              <div class="news-large-post">
              <div class="post-txt">
                @if( !empty($taekwondo->poomsae))
                {!! $taekwondo->poomsae !!}
                @else
                <p style="text-align: center">No poomsae info Added
                </p>
                @endif
              </div>
              </div>
            </div>
          </div>
          <!--News End-->

            <!--News Start-->
        <div class="col-md-12">
          <div class="section-title">
            <h2>Para Taekwondo</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="news-details-wrap">
            <div class="news-large-post">
            <div class="post-txt">
              @if( !empty($taekwondo->para_taekwondo))
              {!! $taekwondo->para_taekwondo !!}
              @else
              <p style="text-align: center">No para taekwondo info Added
              </p>
              @endif
            </div>
            </div>
          </div>
        </div>
        <!--News End-->
        @else
        <div class="col-lg-12">
          <div class="news-details-wrap">
            <div class="news-large-post">
            <div class="post-txt" style="text-align: center;">
                  <h5><strong>No info Added...</strong></h5>
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
  <!--End-->
</div>
<!--Main Content End-->
@endsection
