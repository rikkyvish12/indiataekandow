@extends('layouts.main.main')

@section('title')
    {{-- {{ $title }} | --}}
@endsection


@section('content')
<!--Main Slider Start-->
<div class="inner-banner-header wf100 default-banner">
  {{-- <h1 data-generated="{{ $title }}">{{ $title }}</h1> --}}
  <div class="gt-breadcrumbs">
    <ul>
      <li> <a href="{{ url('/') }}"> <i class="fas fa-home"></i> Home </a> </li>
      {{-- <li> <a href="{{ url('/atheleranking/'.$title) }}" class="active"> {{ $title }} </a> </li> --}}
    </ul>
  </div>
</div>
<!--Main Slider Start-->
<!--Main Content Start-->
<div class="main-content innerpagebg wf100 default-bg">
  <!--team Page Start-->
  <div class="team wf100 p80">
    <!--Start-->
    <div class="player-squad">
      <div class="container">
        <div class="row">
          <!--Squad Start-->
          <div class="col-lg-12">
            <!--Player Box Start-->
            <div class="player-card">
              <div class="pimg"><img src="{{ url('/images/team-dimg.jpg') }}" alt=""></div>
              <div class="player-details">
                <h2>Kevin Rob</h2>
                <strong class="desi">League Captain</strong> <span class="follow"><a href="team-details.html#">Follow</a></span>
                <ul>
                  <li>Height <strong>5’ 11”</strong></li>
                  <li> Weight <strong>67 kg</strong></li>
                  <li> Age <strong>24</strong></li>
                  <li> Nationality <strong>Naples, Italy</strong></li>
                  <li> Total Goals <strong>117</strong></li>
                  <li> Total Assists <strong>87</strong></li>
                  <li> Games Played <strong>92</strong></li>
                  <li> Yellow Cards <strong>24</strong></li>
                  <li> Red Cards <strong>03</strong></li>
                </ul>
              </div>
            </div>
            <!--Player Box End-->
            <!--Player Biography Start-->
            <div class="player-bio">
              <h4>Kevin’s Biography</h4>
              <div class="txt">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
                <blockquote> Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt labore at magnam </blockquote>
                <p> Sunt in culpa qui officia deserunt mollit anim id est laborum. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat. </p>
              </div>
            </div>
            <!--Player Biography End-->
            <!--Career Facts Start-->
            <div class="career-facts">
              <h4>Career Facts</h4>
              <table>
                <thead>
                  <tr>
                    <th>Season
                      </td>
                    <th colspan="2">Match</th>
                    <th colspan="2">Goals</th>
                    <th colspan="2">Discipline</th>
                    <th colspan="2">Passing</th>
                    <th colspan="2">Warning</th>
                    <th colspan="2">Total Goals</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>2013</td>
                    <td>10</td>
                    <td>80</td>
                    <td>60</td>
                    <td>20</td>
                    <td>02</td>
                    <td>05</td>
                    <td>12</td>
                    <td>01</td>
                    <td>20</td>
                    <td>00</td>
                    <td>12</td>
                    <td>0</td>
                  </tr>
                  <tr>
                    <td>2014</td>
                    <td>25</td>
                    <td>30</td>
                    <td>08</td>
                    <td>04</td>
                    <td>02</td>
                    <td>10</td>
                    <td>05</td>
                    <td>10</td>
                    <td>00</td>
                    <td>00</td>
                    <td>15</td>
                    <td>0</td>
                  </tr>
                  <tr>
                    <td>2015</td>
                    <td>50</td>
                    <td>10</td>
                    <td>33</td>
                    <td>30</td>
                    <td>06</td>
                    <td>04</td>
                    <td>12</td>
                    <td>14</td>
                    <td>12</td>
                    <td>00</td>
                    <td>25</td>
                    <td>0</td>
                  </tr>
                  <tr>
                    <td>2016</td>
                    <td>60</td>
                    <td>12</td>
                    <td>45</td>
                    <td>44</td>
                    <td>00</td>
                    <td>10</td>
                    <td>05</td>
                    <td>12</td>
                    <td>20</td>
                    <td>00</td>
                    <td>12</td>
                    <td>0</td>
                  </tr>
                  <tr>
                    <td>2017</td>
                    <td>25</td>
                    <td>30</td>
                    <td>08</td>
                    <td>04</td>
                    <td>02</td>
                    <td>10</td>
                    <td>05</td>
                    <td>10</td>
                    <td>00</td>
                    <td>00</td>
                    <td>15</td>
                    <td>0</td>
                  </tr>
                  <tr>
                    <td>2018</td>
                    <td>10</td>
                    <td>80</td>
                    <td>60</td>
                    <td>20</td>
                    <td>02</td>
                    <td>05</td>
                    <td>12</td>
                    <td>01</td>
                    <td>20</td>
                    <td>00</td>
                    <td>12</td>
                    <td>0</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!--Career Facts End-->
          </div>
          <!--Squad End-->
        </div>
      </div>
    </div>
    <!--End-->
  </div>
  <!--team Page End-->
</div>
<!--Main Content End-->
@endsection
