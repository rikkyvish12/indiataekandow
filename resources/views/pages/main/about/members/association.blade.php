@extends('layouts.main.main')

@section('title')
    {{ $title }}
 @endsection


@section('content')
@include('layouts.admin.title',['title'=>$title])

  <!--Main Content Start-->
<div class="main-content innerpagebg wf100 p80 default-bg">
    <!--News Large Page Start-->
    <!--Start-->
    <div class="news-details">
      <div class="container">
         <div class="row">
           @if (count($associations)>0)
           @foreach ($associations as $item)
           <div class="col-lg-3 col-md-6">
               <div class="team-squad-box">
                  <div class="ts-cap">
                     <h4><a href="{{ url('members/'.$type.'/'.$item->name) }}" style="color: white;">{{ $item->name }}</a></h4>
                     <p>&nbsp;&nbsp;&nbsp;</p>
                     <ul>
                     </ul>
                  </div>
                  <a href="{{ url('members/'.$type.'/'.$item->name) }}">
                  <img src="{{ $item->logo }}" alt=""></a>
               </div>
              </div>
               @endforeach
               @else
               <div class="col-lg-12">
                  <div class="news-details-wrap">
                    <div class="news-large-post">
                    <div class="post-txt">
                     <p style="text-align: center"> No {{ $title }} Added
                     </p>
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
