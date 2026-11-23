<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    @if ($profile)
    <title>{{ $profile->title }}</title>
    @else
    <title></title>
    @endif
    @include('layouts.admin.style')

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body class="sidebar-noneoverflow">

    <!--  BEGIN NAVBAR  -->
    <div class="header-container">
        <header class="header navbar navbar-expand-sm">

            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <div class="nav-logo align-self-center">
            @if ($access == true)
                       @if ($defaults)
                       <a class="navbar-brand" href="{{ url('/admin/profile') }}"><img alt="logo" src="{{ $defaults->logo }}" style="width: 100px; height:60px"></a>
                       @else
                       <a class="navbar-brand" href="{{ url('/admin/profile') }}"><img alt="logo" src="no-logo"></a>
                        @endif
            @endif
            </div>
            @if ($access == true)
            @if(!(\Request::is('event_admin/event_list')) && \Auth::user()->role=='association')
                   <div style="width:100%;text-align:center">

                   <div class="media">
                                                                <div class="media-body">
                                                                    <h6>{{$assoc_name}}</h6>
                                                                    @if($assoc_type == 'state_association')
                                                                    <p class="">{{$state_name}}</p>
                                                                    @elseif($assoc_type == 'district_association')
                                                                    <p class="">{{$district_name}},{{$state_name}}</p>
                                                                    @elseif($assoc_type == 'other_association')
                                                                    <p class="">Other Association</p>
                                                                    @else
                                                                    <p class="">All Assigned Association</p>
                                                                    @endif
                                                                </div>
                                                            </div></div>
             @elseif(!(\Request::is('event_admin/event_list')) && \Auth::user()->role=='event')
                   <div style="width:100%;text-align:center">
                   <div class="media">
                                                                <div class="media-body">
                                                                    <h6>{{$event->title}}({{$event->location}})</h6>
                                                                    <p class="">{{$event_type}}</p>
                                                                </div>
                                                            </div></div>
             @endif
             @endif
               
            <ul class="navbar-item flex-row nav-dropdowns ml-auto">
                <li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="user-profile-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div class="media-body align-self-center">
                                <h6>{{ \Auth::user()->name }}</h6>
                                <p>{{ \Auth::user()->role }}</p>
                            </div>
                            {{-- <img src="{{ url('assets/img/profile-7.jpeg') }}" class="img-fluid" alt="admin-profile"> --}}
                            {{-- <span class="badge badge-success"></span> --}}
                        </div>
                    </a>

                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">

                        <div class="dropdown-item">
                            <a href="auth_lockscreen.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> <span>Change Password</span>
                            </a>
                        </div>
                        <div class="dropdown-item">
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> <span>Log Out</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN TOPBAR  -->
        <div class="topbar-nav header navbar" role="banner">
            @if (\Auth::user()->role=='admin')

                @include('layouts.admin.admin_nav')
            @elseif (\Auth::user()->role=='event')
              @if (\Request::is('event_admin/event_list') || $access == false)

              @else
                 @include('layouts.admin.admin_event_nav')
              @endif

            @elseif (\Auth::user()->role=='association')
             
              @if (\Request::is('assoc_admin/association_list') || $access == false)

              @else
                 @include('layouts.admin.admin_assoc_nav')
              @endif
            @endif
        </div>
        <!--  END TOPBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <!-- CONTENT AREA -->
                @if ($access == true)
              
                   @yield('content')
                @else
                <center>
                <h3 class="text-danger">Access Denied!</h3>
                @if(\Auth::user()->role=='association')
                <h5 class="text-danger">Sorry!! You have no access to manage this association</h5>
                <a href="/assoc_admin/association_list" class="btn btn-primary"> Go to Association List</a>

                @elseif(\Auth::user()->role=='event')
                <h5 class="text-danger">Sorry!! You have no access to manage this Event</h5>
                <a href="/event_admin/event_list" class="btn btn-primary"> Go to EVENT LIST </a>

                @endif
                   
                </center>
                @endif

                <!-- CONTENT AREA -->

            </div>
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2021 <a target="_blank" href="../../../index.html">DesignReset</a>, All rights reserved.</p>
                </div>
                {{-- <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                </div> --}}
            </div>
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->
    @include('layouts.admin.script')

</body>
</html>
