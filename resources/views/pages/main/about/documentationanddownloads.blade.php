@extends('layouts.main.main')

@section('title')
   Documents And Downloads
@endsection

@section('content')
<!--Main Slider Start-->
<div class="inner-banner-header wf100 default-banner">
   <h1 >Documents And Downloads</h1>
   <div class="gt-breadcrumbs">
     <ul>
       <li> <a href="{{ url('/') }}"> <i class="fas fa-home"></i> Home </a> </li>
       <li> <a href="{{ url('/documentsanddownloads') }}"  class="active"> Documents And Downloads </a> </li>
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
   @if (count($documents)>0 || count($audit)>0 || count($forms)>0 )

            @if (count($documents)>0)
            <!--News Start-->
               <div class="col-lg-12">
                  <div class="news-details-wrap">
                     <div class="news-large-post">
                        <div class="post-txt">
                           <div class="point-table-widget">
                              <table>
                                 <thead>
                                    <tr>
                                       <th>Documents</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($documents as $item)
                                    <tr>
                                       <td><a target="_blank" href="{{ $item->file }}"> <i class="fas fa-download fa-fw" style="float-left"></i> {{ $item->name }}</a></td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            <!--News End-->
            @endif

            @if (count($audit)>0)
                <!--News Start-->
            <div class="col-lg-12">
               <div class="news-details-wrap">
                  <div class="news-large-post">
                     <div class="post-txt">
                        <div class="point-table-widget">
                           <table>
                              <thead>
                                 <tr>
                                    <th>Audit & Accounting</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach ($audit as $item)
                                 <tr>
                                    <td><a target='_blank' rel="noopener noreferrer" href="{{ url($item->file) }}"> <i class="fas fa-download fa-fw" style="float-left"></i> {{ $item->name }}</a></td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--News End-->
            @endif

            @if (count($forms)>0)
                 <!--News Start-->
            <div class="col-lg-12">
               <div class="news-details-wrap">
                  <div class="news-large-post">
                     <div class="post-txt">
                        <div class="point-table-widget">
                           <table>
                              <thead>
                                 <tr>
                                    <th>Forms & Circulars </th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach ($forms as $item)
                                 <tr>
                                    <td><a target='_blank' rel="noopener noreferrer" href="{{ url($item->file) }}"> <i class="fas fa-download fa-fw" style="float-left"></i> {{ $item->name }}</a></td>
                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!--News End-->
            @endif

           @else
            <div class="col-lg-12">
               <div class="news-details-wrap">
                  <div class="news-large-post">
                     <div class="post-txt" style="text-align:center">
                     <p>No Documents And Downloads Added
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
