@extends('layouts.main.main')

@section('title')
    Committee / Commission |
@endsection


@section('content')
<!--Main Slider Start-->
<div class="inner-banner-header wf100 default-banner" >
  <h1 >Committee / Commission</h1>
  <div class="gt-breadcrumbs">
    <ul>
      <li> <a href="{{ url('/') }}"> <i class="fas fa-home"></i> Home </a> </li>
      <li> <a href="{{ url('/committee_commission') }}"  class="active"> Committee / Commission </a> </li>
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
        <!--News Start-->
        <div class="col-lg-12">
          <div class="news-details-wrap">
            <div class="news-large-post">
              <div class="post-txt">
                <div class="point-table-widget">
                    <table>
                       <thead>
                          <tr>
                             <th>Name</th>
                          </tr>
                       </thead>
                       <tbody>
                        @if(count($committees)>0)
                        @foreach ($committees->sortBy('name') as $item)
                        <tr>
                          <td><a href="{{ url('committee_commission/'.$item->id.'/'.$item->name) }}">{{ $item->name }}</a></td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                          <td style="text-align: center">No any Committee / Commission Added</td>
                        </tr>
                        @endif
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
