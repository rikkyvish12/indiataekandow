@extends('layouts.main.main')

@section('title')
Rules And Regulations
@endsection

@section('content')
<!--Main Slider Start-->
<div class="inner-banner-header wf100 default-banner">
  <h1 >Biathlae</h1>
  <div class="gt-breadcrumbs">
    <ul>
      <li> <a href="http://demo.taekwondoindia.com"> <i class="fas fa-home"></i> Home </a> </li>
      <li> <a href="http://demo.taekwondoindia.com/rulesandregulations">Rules & Regulations</a> </li>
      <li> <a href="http://demo.taekwondoindia.com/rulesandregulations/Biathlae" class="active"> Biathlae </a> </li>
    </ul>
  </div>
</div>
<!--Main Slider Start-->
<!--Main Content Start-->
<div class="main-content innerpagebg wf100 p80 default-bg" >
  <!--News Large Page Start-->
  <!--Start-->
  <div class="news-details">
    <div class="container">
      <div class="row">
        <!--News Start-->
        <div class="col-lg-12">
          <div class="news-details-wrap">
            <div class="news-large-post">
              <div class="post-txt">
                <div class="point-table-widget">
                    <table>
                       <thead>
                          <tr>
                             <th>Rules And Regulations</th>
                          </tr>
                       </thead>
                      <tbody>
                        @if (count($rnr)>0)
                        @foreach ($rnr as $item)
                        <tr>
                          <td><a href="{{ url('rulesandregulations/'.$item->name) }}">{{ $item->name }}</a></td>
                      </tr>
                        @endforeach
                        @else
                            No Rules And Regulations Added Yet
                        @endif
                          {{-- <tr>
                              <td>Laser Run</td>
                          </tr>
                          <tr>
                              <td>Biathle/ Triathle</td>
                          </tr>
                          <tr>
                              <td>Tetrathlon</td>
                          </tr>
                          <tr>
                              <td>taekwondo</td>
                          </tr> --}}
                      </tbody>
                    </table>
                 </div>
              </div>
            </div>
          </div>
        </div>
        <!--News End-->
      </div>
    </div>
  </div>
  <!--End-->
</div>
<!--Main Content End-->
@endsection

