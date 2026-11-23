@extends('layouts.main.main')

@section('title')
    Department
@endsection

@section('content')
<!--Main Slider Start-->
<div class="inner-banner-header wf100 default-banner" >
  <h1 >Department</h1>
  <div class="gt-breadcrumbs">
    <ul>
      <li> <a href="{{ url('/') }}"> <i class="fas fa-home"></i> Home </a> </li>
      <li> <a href="{{ url('/department') }}"	 class="active"> Department </a> </li>
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
                           <th>Sr. no.</th>
                           <th>Name</th>
                           <th>Designation</th>
                           <th>Image</th>
                        </tr>
                     </thead>
                     <tbody>
                      @if (count($department)>0)
                          @foreach ($department as $item)
                          <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->designation }}</td>
                            <td><img src="{{ url($item->image) }}" alt="image" style="width: 50px" /></td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                          <td colspan="4" style="text-align: center">No Members added yet</td>
                        </tr>
                      @endif
                        </tbody>
                      </table>
                    {{-- <table>
                       <thead>
                          <tr>
                             <th>Sr. no.</th>
                             <th>Name</th>
                             <th>Position</th>
                             <th>Image</th>
                          </tr>
                       </thead>
                       <tbody>

                        <tr>
                            <td>1</td>
                            <td>Sunil Raghunath Purnapatre</td>
                            <td>President</td>
                            <td><img src="http://demo.taekwondoindia.com/storage/governance/auser.jpg" alt="image" style="width: 50px" /></td>
                        </tr>
                                                      <tr>
                            <td>2</td>
                            <td>Balasaheb Landge</td>
                            <td>Vice President</td>
                            <td><img src="http://demo.taekwondoindia.com/storage/governance/auser.jpg" alt="image" style="width: 50px" /></td>
                        </tr>
                                                      <tr>
                            <td>3</td>
                            <td>Rajesh Mishra</td>
                            <td>Vice President</td>
                            <td><img src="http://demo.taekwondoindia.com/storage/governance/auser.jpg" alt="image" style="width: 50px" /></td>
                        </tr>
                                                      <tr>
                            <td>4</td>
                            <td>                        Balvinayakam                             </td>
                            <td>Vice President </td>
                            <td><img src="http://demo.taekwondoindia.com/storage/governance/auser.jpg" alt="image" style="width: 50px" /></td>
                        </tr>
                                                      <tr>
                            <td>5</td>
                            <td>                        Bipin Suryawanshi
                            </td>
                            <td>Vice President</td>
                            <td><img src="http://demo.taekwondoindia.com/storage/governance/auser.jpg" alt="image" style="width: 50px" /></td>
                        </tr>
                                                      <tr>
                            <td>6</td>
                            <td>Vitthal Sampat Shirgaonkar  </td>
                            <td>Gen. Secretary</td>
                            <td><img src="http://demo.taekwondoindia.com/storage/governance/auser.jpg" alt="image" style="width: 50px" /></td>
                        </tr>
                                                      <tr>
                            <td>7</td>
                            <td>Jitendra Khasina </td>
                            <td>Jt. Secretary</td>
                            <td><img src="http://demo.taekwondoindia.com/storage/governance/auser.jpg" alt="image" style="width: 50px" /></td>
                        </tr>
                                                      <tr>
                            <td>8</td>
                            <td>Krishnaiah K.</td>
                            <td>Jt. Secretary</td>
                            <td><img src="http://demo.taekwondoindia.com/storage/governance/auser.jpg" alt="image" style="width: 50px" /></td>
                        </tr>
                                                      <tr>
                            <td>9</td>
                            <td>Vinay Marathe – </td>
                            <td>Jt. Secretary</td>
                            <td><img src="http://demo.taekwondoindia.com/storage/governance/auser.jpg" alt="image" style="width: 50px" /></td>
                        </tr>
                            <tr>
                            <td>10</td>
                            <td> Jitendra Sonyabapu Chabukswar </td>
                            <td>Jt. Secretary</td>
                            <td><img src="http://demo.taekwondoindia.com/storage/governance/auser.jpg" alt="image" style="width: 50px" /></td>
                        </tr>
                            <tr>
                            <td>11</td>
                            <td>  Satyavir Singh</td>
                            <td>Treasurer</td>
                            <td><img src="http://demo.taekwondoindia.com/storage/governance/auser.jpg" alt="image" style="width: 50px" /></td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td> Sunil Bharti</td>
                            <td>Member</td>
                            <td><img src="http://demo.taekwondoindia.com/storage/governance/auser.jpg" alt="image" style="width: 50px" /></td>
                        </tr>
                                                  </tbody>
                    </table> --}}
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
