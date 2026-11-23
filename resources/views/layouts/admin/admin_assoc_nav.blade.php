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
                    <a href="{{ route('assoc_admin.assoc_slider_index',$assoc_id) }}">Slider</a>
                </li>
                <li>
                    <a href="{{ route('assoc_admin.assoc_profile_index',$assoc_id) }}">Profile</a>
                </li>
                <li>
                    <a href="{{ route('assoc_admin.state_default_background_index',$assoc_id) }}">Default Background</a>
                </li>
            </ul>
        </li>

        <li class="menu single-menu">
            <a href="starter_kit_blank_page.html#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                <div class="">
                    <span>Organisation</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>
            <ul class="collapse submenu list-unstyled" id="menu1" data-parent="#topAccordion">
                <li>
                    {{-- <a href="{{ route('assoc_admin.president_message_index',$assoc_id) }}">President Message</a> --}}
                </li>
                <li>
                    <a href="{{ route('assoc_admin.secretary_message_index',$assoc_id) }}">Secretary Message</a>
                </li>
                <li>
                    <a href="{{ route('assoc_admin.governance_index',$assoc_id) }}">Governance</a>
                </li>
                <li>
                    <a href="{{ route('assoc_admin.petrons_index',$assoc_id) }}">Patrons</a>
                </li>
            </ul>
        </li>
        @if($assoc_type != 'other_association')
        <li class="menu single-menu">
            <a href="starter_kit_blank_page.html#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                <div class="">
                    <span>Association</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>
            <ul class="collapse submenu list-unstyled" id="menu1" data-parent="#topAccordion">
            @if($assoc_type != 'district_association')
                <li>
                    <a href="{{ route('assoc_admin.district_association_index',$assoc_id) }}">District Association</a>
                </li>
            @endif
                <li>
                    <a href="{{ route('assoc_admin.other_association_index',$assoc_id) }}">Other Association</a>
                </li>

            </ul>
        </li>
        @endif
        <li class="menu single-menu">
            <a href="starter_kit_blank_page.html#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                <div class="">
                    <span>Committee</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>
            <ul class="collapse submenu list-unstyled" id="menu1" data-parent="#topAccordion">
                <li>
                    <a href="{{ route('assoc_admin.committees_index',$assoc_id) }}">Committees</a>
                </li>
                <!-- <li>
                    <a href="{{ route('assoc_admin.committee_member_index',$assoc_id) }}">Member</a>
                </li> -->

            </ul>
        </li>
        <li class="menu single-menu"><a href="{{ route('assoc_admin.documents_index',$assoc_id) }}"> Documents </a></li>
        <li class="menu single-menu">
            <a href="starter_kit_blank_page.html#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                <div class="">
                    <span>Media</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>
            <ul class="collapse submenu list-unstyled" id="menu1" data-parent="#topAccordion">
                <li>
                    <a href="{{ route('assoc_admin.state_news_index',$assoc_id,$assoc_id) }}">News</a>
                </li>
                <li>
                    <a href="{{ route('assoc_admin.album_image',$assoc_id) }}">Image Album</a>
                </li>
              

                <li>
                    <a href="{{ route('assoc_admin.album_video',$assoc_id) }}">Video Album</a>
                </li>
               

            </ul>
        </li>

        <li class="menu single-menu"><a href="{{ route('assoc_admin.event_index',$assoc_id) }}">
            
        Manage Events </a></li>
<li class="menu single-menu" >
    <a href="/assoc_admin/association_list" class="btn btn-primary"> List Association </a>

   
</li>


    </ul>

   
</nav>
