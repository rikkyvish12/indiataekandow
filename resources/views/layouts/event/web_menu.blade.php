<ul id="menu-main-navigation-1" class="sf-menu">
    <li class="menu-item menu-item-home  bigslam-normal-menu "><a href="{{ url('/') }}">TFI Home</a></li>

    <li class="menu-item menu-item-home bigslam-normal-menu {{( $page_name == 'home') ? 'current-menu-item':'' }}"><a href="{{ url('events/'.$event->id.'/'.$event_name) }}">Home</a></li>
    <li class="menu-item menu-item-has-children bigslam-normal-menu {{( $page_name == 'media') ? 'current-menu-item':'' }}"><a href="#" class="sf-with-ul-pre">Media</a>
        <ul class="sub-menu">
            <li class="menu-item" data-size="60"><a href="{{ url('events/'.$event->id.'/'.$event_name.'/image_albums') }}">Image Gallery</a></li>
            <li class="menu-item" data-size="60"><a href="{{ url('events/'.$event->id.'/'.$event_name.'/video_albums') }}">Video Gallery</a></li>
        </ul>
    </li>
    <li class="menu-item menu-item-home bigslam-normal-menu {{( $page_name == 'news') ? 'current-menu-item':'' }}"><a href="{{ url('events/'.$event->id.'/'.$event_name.'/news') }}">News</a></li>
    <!-- <li class="menu-item menu-item-home {{( $page_name == 'pdfs') ? 'current-menu-item':'' }}"><a href="{{ url('events/'.$event->id.'/'.$event_name.'/schedule_and_results') }}" aria-current="page">Important PDFs</a></li> -->
    <li class="menu-item menu-item-home {{( $page_name == 'results') ? 'current-menu-item':'' }}"><a href="{{ url('events/'.$event->id.'/'.$event_name.'/schedule_and_results') }}" aria-current="page">Schedule And Result</a></li>
</ul>