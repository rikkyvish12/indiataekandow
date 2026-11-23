<ul id="menu-main-navigation-1" class="sf-menu">
    <li class="menu-item menu-item-has-children"><a href="{{ url('/') }}">TFI Home</a></li>
    <li class="menu-item bigslam-normal-menu {{ ($page_name == 'home') ? 'current-menu-item' : '' }}"  ><a href="{{ url('state/'.$assoc_id.'/'.$assoc_name) }}"> Home</a></li>
    <li class="menu-item menu-item-has-children bigslam-normal-menu {{ ($page_name == 'about') ? 'current-menu-item' : '' }}">
        <a href="#" class="sf-with-ul-pre">About</a>
        <ul class="sub-menu">
            <li class="menu-item" data-size="60"><a href="{{ url('/taekwondo') }}">Taekwondo</a></li>

            <li class="menu-item menu-item-has-children" data-size="60"><a href="{{ url('state/'.$assoc_id.'/'.$assoc_name.'/president_message') }}" class="sf-with-ul-pre">Organisation</a>
                <ul class="sub-menu">
                    {{-- <li class="menu-item"><a href="{{ url('state/'.$assoc_id.'/'.$assoc_name.'/president_message') }}">President Message</a></li> --}}
                    <li class="menu-item"><a href="{{ url('state/'.$assoc_id.'/'.$assoc_name.'/secretary_message') }}">Secretary Message</a></li>
                    <li class="menu-item"><a href="{{ url('state/'.$assoc_id.'/'.$assoc_name.'/governance') }}">Governance</a></li>
                    <li class="menu-item"><a href="{{ url('state/'.$assoc_id.'/'.$assoc_name.'/patronsandadviser') }}">Patrons And Adviser</a></li>
                </ul>
            </li>
            <li class="menu-item menu-item-has-children " data-size="60" ><a  class="sf-with-ul-pre">Member</a>
                <ul class="sub-menu">
                    <li class="menu-item"><a href="{{url('state/'.$assoc_id.'/'.$assoc_name.'/district_association')}}">District Association</a></li>
                    <li class="menu-item"><a href="{{url('state/'.$assoc_id.'/'.$assoc_name.'/other_member')}}">Other Members</a></li>
                </ul>
            </li>
            <li class="menu-item menu-item-has-children" data-size="60"><a  class="sf-with-ul-pre">Committees</a>
                <ul class="sub-menu">
                    @foreach ($committee as $item)
                    <li class="menu-item"><a href="{{ url('state/'.$assoc_id.'/'.$assoc_name.'/committees/'.$item->id) }}">{{ $item->name }}</a></li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </li>

    <li class="menu-item  bigslam-normal-menu {{ ($page_name == 'docs') ? 'current-menu-item' : '' }}"><a href="{{ url('state/'.$assoc_id.'/'.$assoc_name.'/documents') }}"> Documents</a></li>
    <li class="bigslam-center-nav-menu-item">
        <div class="bigslam-logo  bigslam-item-pdlr">
            <div class="bigslam-logo-inner">
                <a href="{{ url('state/'.$assoc_id.'/'.$assoc_name) }}"><img src="{{ $default->logo}}" alt="" width="200" height="191" title="logo"></a>
            </div>
        </div>
    </li>
    <li class="menu-item menu-item-has-children bigslam-normal-menu {{ ($page_name == 'events') ? 'current-menu-item' : '' }}"><a class="sf-with-ul-pre">Events</a>
        <ul class="sub-menu">
            <li class="menu-item" data-size="60"><a href="{{ url('state/'.$assoc_id.'/'.$assoc_name.'/assoc_events') }}">Events</a></li>
            <li class="menu-item" data-size="60"><a href="{{url('/events/national_event')}}">National Events</a></li>
            <li class="menu-item" data-size="60"><a href="{{url('/events/international_event')}}">International Events</a></li>
            <li class="menu-item" data-size="60"><a href="{{url('/events/other_event')}}">Other Events</a></li>
        </ul>
    </li>
    <li class="menu-item menu-item-has-children bigslam-normal-menu"><a href="#" class="sf-with-ul-pre">TFI</a>
        <ul class="sub-menu">
            <li class="menu-item" data-size="60"><a href="{{ url('/rulesandregulations') }}">Rules And Regulations</a></li>
            {{-- <li class="menu-item" data-size="60"><a href="player-list-gallery.html">TFI Tent</a></li> --}}
        </ul>
    </li>
    <li class="menu-item menu-item-has-children bigslam-normal-menu {{ ($page_name == 'media') ? 'current-menu-item' : '' }}"><a  class="sf-with-ul-pre">Media</a>
        <ul class="sub-menu" id="media">
            <li class="menu-item" data-size="60"><a href="{{ url('state/'.$assoc_id.'/'.$assoc_name.'/news') }}">News</a></li>
            <li class="menu-item" data-size="60"><a href="{{ url('state/'.$assoc_id.'/'.$assoc_name.'/image_albums') }}">Photo Gallery</a></li>
            <li class="menu-item" data-size="60"><a href="{{ url('state/'.$assoc_id.'/'.$assoc_name.'/video_albums') }}">Video Gallery</a></li>
        </ul>
    </li>
    <li class="menu-item menu-item-type-post_type menu-item-object-sp_team bigslam-normal-menu {{ ($page_name == 'contact') ? 'current-menu-item' : '' }}"><a href="{{ url('state/'.$assoc_id.'/'.$assoc_name.'/contactus') }}">Contact Us</a></li>
   
</ul>