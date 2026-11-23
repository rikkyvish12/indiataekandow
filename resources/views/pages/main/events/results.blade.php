@extends('layouts.main.main')

@section('title')
Results |
@endsection

@section('content')
  <div class="inner-banner-header wf100 default-banner"  >
    <h1 >Results</h1>
    <div class="gt-breadcrumbs">
      <ul>
        <li> <a href="{{ url('/') }}"> <i class="fas fa-home"></i> Home </a> </li>
        <li> <a href="{{ url('/results') }}"  class="active"> Results </a> </li>
      </ul>
    </div>
  </div>

  <div class="main-content innerpagebg wf100 p80 default-bg">
    <div class="news-large">
  <div class="container">
    <div class="row">
   <!--Match Results Start-->
   <div class="col-md-12">

    <div class="match-results-table container">
       <h4>Match Results</h4>
       <table  class="table table-sm">
          <thead>
             <tr>
                <td style="text-align: center"><i class="fa fa-list" aria-hidden="true"></i></td>
                <td style="text-align: center">Competition-Name</td>
                <td style="text-align: center">Date</td>
                <!-- <td style="text-align: center">Event</td> -->
                <td style="text-align: center">Group</td>
                <td style="text-align: center">Round</td>
                <td style="text-align: center">Download <small>.pdf</small></td>
             </tr>
          </thead>
          <tbody>
         @if(count($results)> 0)
          @forelse ($results as $result)
          <tr>
            <td class="text-danger" style="text-align: center"><i class="fas fa-angle-double-right"></i></td>
            <td style="text-align: center">{{$result->event_name}}</td>
            <td style="text-align: center">{{date('F j, Y', strtotime($result->date.' '.$result->time))}} </td>
            <!-- <td style="text-align: center">{{$result->event}}</td> -->
            <td style="text-align: center">{{$result->group}}</td>
            <td style="text-align: center">{{$result->round}}</td>
            <td style="text-align: center"><a href="{{ $result->result_pdf }}"  class="animated pulse forever" target='_blank' rel="noopener noreferrer">  <i class="fas fa-download fa-fw fa-2x"></i></a></td>
         </tr>
          @empty

          @endforelse
          @else
              <tr>
                <td colspan="7" style="text-align:center"><strong>No result to display</strong></td>
              </tr>
          @endif
         <tbody>
       </table>
    </div>

 </div>
    </div>
  </div>
    </div>
  </div>
 <!--Match Results End-->

@endsection
