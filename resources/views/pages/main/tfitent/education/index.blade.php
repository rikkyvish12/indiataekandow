@extends('layouts.main.main')

@section('title')
Club/Academy near me?
 |
@endsection


@section('content')
<!--Main Slider Start-->
<div class="inner-banner-header wf100 default-banner">
  <h1 >Club/Academy near me?
</h1>
  <div class="gt-breadcrumbs">
    <ul>
      <li> <a href="http://127.0.0.1:8001"> <i class="fas fa-home"></i> Home </a> </li>
      <li> <a href="http://127.0.0.1:8001/taekwondo" class="active"> Club/Academy near me?
      </a> </li>
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

         <div class="player-bio">
            <h4><i class="fa fa-arrow-right" aria-hidden="true"></i> Comming Soon</h4>
          </div>
              <!--Player Biography Start-->
                {{-- <div class="player-bio">
                  <h4>{{ $title }}</h4>
                  <div class="txt" >
                     {!!  $tent->details !!}
                        </div>
                  </div> --}}
                </div>
                <!--Player Biography End-->
      </div>
    </div>
  </div>
  <!--End-->
</div>
<!--Main Content End-->
<!--Main Content Start-->
{{-- <div class="main-content innerpagebg  p80">
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
                                    <th>For more information please checkout the pdf below</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td><a href="https://www.uipmworld.org/sites/default/files/2018_uipm_anti-doping_procedures_clean.pdf" target="_blank">2018 UIPM Anti-Doping Procedures Clean</a></td>
                                 </tr>
                                 <tr>
                                    <td><a href="https://www.uipmworld.org/sites/default/files/ad_rules.pdf" target="_blank">Anti-Doping Rules</a></td>
                                 </tr>
                                 <tr>
                                    <td><a href="https://www.uipmworld.org/sites/default/files/uipm_anti-doping_rules_digital.pdf" target="_blank">UIPM Anti-Doping Rules Digital 2018 Edition</a></td>
                                 </tr>
                                 <tr>
                                    <td><a href="https://www.uipmworld.org/sites/default/files/uipm_medical_rules_digital.pdf" target="_blank">UIPM Anti-Doping Rules Digital 2015 Edition</a></td>
                                 </tr>
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
</div> --}}
<!--Main Content End-->
@endsection

