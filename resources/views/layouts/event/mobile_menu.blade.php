<ul id="menu-main-navigation" class="m-menu">
    <li class="menu-item menu-item-home "><a href="{{ url('/') }}" aria-current="page">TFI HOME</a></li>
<li class="menu-item menu-item-home current-menu-item"><a href="{{ url('events/'.$event->id.'/'.$event_name) }}" aria-current="page">HOME</a></li>
    
    <li class="menu-item menu-item-has-children"><a href="{{ url('events/'.$event->id.'/'.$event_name.'/image_albums') }}">Media</a>
        <ul class="sub-menu">
            <li class="menu-item"><a href="{{ url('events/'.$event->id.'/'.$event_name.'/image_albums') }}">Image Gallery</a></li>
            <li class="menu-item"><a href="{{ url('events/'.$event->id.'/'.$event_name.'/video_albums') }}">Video Gallery</a></li>
        </ul>
    </li>
    <li class="menu-item menu-item-home current-menu-item"><a href="{{ url('events/'.$event->id.'/'.$event_name.'/news') }}" aria-current="page">News</a></li>
    <li class="menu-item menu-item-home current-menu-item"><a href="{{ url('events/'.$event->id.'/'.$event_name.'/schedule_and_results') }}" aria-current="page">Schedule And Result</a></li>
</ul>