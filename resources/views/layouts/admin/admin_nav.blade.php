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
                    <a href="{{ route('admin.slider.index') }}">Slider</a>
                </li>
                <li>
                    <a href="{{ route('admin.profile.index') }}">Profile</a>
                </li>
                <li>
                    <a href="{{ route('admin.default_background.index') }}">Defaults</a>
                </li>
            </ul>
        </li>
        <li class="menu single-menu">
            <a href="starter_kit_blank_page.html#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                <div class="">
                    <span>About</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>
            <ul class="collapse submenu list-unstyled" id="menu2" data-parent="#topAccordion">
                <li>
                    <a href="{{ route('admin.taekwondo.index') }}"> Taekwondo </a>
                </li>
               
                <li class="sub-sub-submenu-list">
                    <a href="starter_kit_blank_page.html #sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Organisation <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                    <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                        {{-- <li><a href="{{ route('admin.president_message.index') }}">President Message</a></li> --}}
                        <li><a href="{{ route('admin.governance.index') }}">Governance</a></li>
                        <li><a href="{{ route('admin.secretariat.index') }}">Secretariat</a></li>
                        <li><a href="{{ route('admin.management.index') }}">Management</a></li>
                        <li><a href="{{ route('admin.department.index') }}">Department</a></li>
                        <li><a href="{{ route('admin.patrons.index') }}">Patrons & Adviser</a></li>
                    </ul>
                </li>
                  
                <li class="sub-sub-submenu-list">
                    <a href="starter_kit_blank_page.html#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Members <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                    <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                        {{-- <li><a href="{{ route('admin.state_association.index') }}">State Associations</a></li>
                        <li><a href="{{ route('admin.district_association.index') }}">District Associations</a></li>
                        <li><a href="{{ route('admin.other_association.index') }}">Other Members</a></li> --}}

                        <li><a href="{{ route('admin.full_member.index') }}">Full Member</a></li>
                        <li><a href="{{ route('admin.district_member.index') }}">District Member</a></li>
                        <li><a href="{{ route('admin.associate_member.index') }}">Associate Member</a></li>
                        <li><a href="{{ route('admin.other_member.index') }}">Other Member</a></li>
                    </ul>
                </li>
                <li class="sub-sub-submenu-list">
                    <a href="starter_kit_blank_page.html#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Committees / Commissions <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                    <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                        <li><a href="{{ route('admin.committee.index') }}">Committees</a></li>
                        <li><a href="{{ route('admin.commission.index') }}">Commissions</a></li>

                        <!-- <li><a href="{{ route('admin.committee_member.index') }}">Members</a></li> -->
                    </ul>
                </li>
                <li><a href="{{ route('admin.documents.index') }}"> Documents & Downloads </a></li>
            </ul>
        </li>
        <li class="menu single-menu">
            <a href="{{ route('admin.rulesandregulations.index') }}">
                <span>Rules & Regulations</span>
            </a>
        </li>
       
        <li class="menu single-menu">
            <a href="starter_kit_blank_page.html#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                <div class="">
                    <span>Events</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>
            <ul class="collapse submenu list-unstyled" id="menu1" data-parent="#topAccordion">
                <li>
                    <a href="{{ route('admin.international_event.index') }}">International Events</a>
                </li>
                <li>
                    <a href="{{ route('admin.national_event.index') }}">National Events</a>
                </li>
                <li>
                    <a href="{{ route('admin.find_event_near_me.index') }}">Find Event Near Me</a>
                </li>
                {{-- <li><a href="{{ route('admin.other_event.index') }}">Other Events</a></li>
                <li><a href="{{ route('admin.results.index') }}">Results</a></li> --}}
            </ul>
        </li>
        <li class="menu single-menu">
            <a href="starter_kit_blank_page.html#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                <div class="">
                    <span>Media</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>
            <ul class="collapse submenu list-unstyled" id="menu1" data-parent="#topAccordion">
                <li>
                    <a href="{{ route('admin.international_news.index') }}">International News</a>
                </li>
                <li>
                    <a href="{{ route('admin.national_news.index') }}">National News</a>
                </li>
                
                <li class="sub-sub-submenu-list">
                    <a href="{{ route('admin.education.index') }}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Photo Gallery <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                    <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                        <li>
                            <a href="{{ route('admin.album.index') }}">Photo Album</a>
                        </li>
                        <li>
                            <!-- <a href="{{ route('admin.image_gallery.index') }}">Album Images</a> -->
                        </li>
                    </ul>
                </li>
                <li class="sub-sub-submenu-list">
                    <a href="{{ route('admin.education.index') }}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Video Gallery <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                    <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                        <li>
                            <a href="{{ route('admin.video_album.index') }}">Video Album</a>
                        </li>
                        <li>
                            <!-- <a href="{{ route('admin.video_gallery.index') }}">Album Videos</a> -->
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="menu single-menu">
            <a href="starter_kit_blank_page.html#menu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle autodroprown">
                <div class="">
                    <span>TFI Tent</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </a>
            <ul class="collapse submenu list-unstyled" id="menu2" data-parent="#topAccordion">
               
               
                <!-- <li class="sub-sub-submenu-list">
                    <a href="starter_kit_blank_page.html#sub-sub-category" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Profile <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                    <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                        <li>
                            <a href="{{ route('admin.profile_athlete.index') }}">Athlete Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.profile_coaches.index') }}">Coaches Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.profile_judges.index') }}">Judges Profile</a>
                        </li>
                    </ul>
                </li> -->
                <li><a href="{{ route('admin.award.index') }}"> Awards & Honorured </a></li>
                <li><a href="{{ route('admin.halloffame.index') }}"> TFI Hall of Fame </a></li>
                <li><a href="{{ route('admin.antidoping.index') }}"> Anti-Doping </a></li>

                {{-- <li><a href="{{ url('awards_and_honorured') }}">Be a volunteer with India Taekwondo</a></li>
                <li><a href="{{ url('halloffame') }}">Get Newsletters</a></li>
                <li><a href="{{ url('/antidoping') }}">Event near me?</a></li>
                <li><a href="{{ url('/antidoping') }}">Club/Academy near me?</a></li> --}}
      
                <!-- <li class="sub-sub-submenu-list">
                    <a href="{{ route('admin.education.index') }}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Education <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                    <ul class="collapse list-unstyled sub-submenu" id="sub-sub-category" data-parent="#menu"> 
                        @foreach ($education as $item)
                        <li><a href="{{ route('admin.education.edit',$item->id) }}">{{ $item->title }}</a></li>
                        @endforeach
                         <li><a href="{{ route('admin.education.create') }}">Add New</a></li>
                    </ul>
                </li> -->
            </ul>
        </li>
      
    </ul>
</nav>