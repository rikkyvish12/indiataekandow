@extends('layouts.main.main')


@section('title')
    {{ $title }}
@endsection


@section('content')
<!--Main Slider Start-->
<div class="inner-banner-header wf100 default-banner">
  <h1>{{ $title }}</h1>
  <div class="gt-breadcrumbs">
    <ul>
      <li> <a href="{{ url('/') }}"> <i class="fas fa-home"></i> Home </a> </li>
      <li> <a href="/committee_commission/{{$title}}"  class="active"> {{ $title }} </a> </li>
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
                             <th>Sr. no.</th>
                             <th>Name</th>
                             <th>Designation</th>
                              <th>Image</th>
                          </tr>
                       </thead>
                       <tbody>
                      @if (count($members)>0)
                        @foreach ($members as $item)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $item->name }}</td>
                          <td>{{ $item->designation }}</td>
                           <td>
                             <img src="{{ $item->image }}" alt="image" style="width: 50px;height:50px" /></td>
                          </tr>
                        @endforeach
                        @else

                            <tr>
                              <td colspan="4" style="text-align: center">No members added yet</td>
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

