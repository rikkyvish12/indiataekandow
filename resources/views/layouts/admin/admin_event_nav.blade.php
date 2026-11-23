<nav id="topbar">
    <ul class="navbar-nav theme-brand flex-row  text-center">
        <li class="nav-item theme-logo">
            <a href="index.html">
                <img src="{{ url('assets/img/logo.svg') }}" class="navbar-logo" alt="logo">
            </a>
        </li>
    </ul>

    <ul class="list-unstyled menu-categories" id="topAccordion">

        <li class="menu single-menu">
            <a href="starter_kit_blank_page.html#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                <div class="">
                    <span>Home</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>
            <ul class="collapse submenu list-unstyled" id="menu1" data-parent="#topAccordion">
                <li>
                    <a href="{{ route('event_admin.slider_index',$event_id) }}">Slider</a>
                </li>
                <li>
                    <a href="{{ route('event_admin.profile_index',$event_id) }}">Profile</a>
                </li>
                <li>
                    <a href="{{ route('event_admin.default_background_index',$event_id) }}">Default Background</a>
                </li>
            </ul>
        </li>
        <li class="menu single-menu"><a href="{{ route('event_admin.news_index',$event_id) }}"> News </a></li>
        <li class="menu single-menu"><a href="{{ route('event_admin.important_pdf_index',$event_id) }}"> Important PDF </a></li>
        <li class="menu single-menu">
            <a href="starter_kit_blank_page.html#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                <div class="">
                    <span>Media</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>
            <ul class="collapse submenu list-unstyled" id="menu1" data-parent="#topAccordion">
                <li>
                    <a href="{{ route('event_admin.album_image',$event_id) }}">Image album</a>
                </li>

                <li>
                    <a href="{{ route('event_admin.album_video',$event_id) }}">Video Album</a>
                </li>
              
            </ul>
        </li>
        <li class="menu single-menu"><a href="{{ route('event_admin.results_index',$event_id) }}"> Results</a></li>
        <li class="menu single-menu" >
             <a href="/event_admin/event_list" class="btn btn-primary"> List Events </a>
        </li>
    </ul>
</nav>