<nav class="main-nav">
    <ul>
      <li class="nav-item drop-down"> <a href="{{ url('/') }}">Home</a></li>
      <li class="nav-item drop-down"> <a href="#">About</a>
        <ul>
           <li><a href="{{ url('taekwondo') }}">Taekwondo</a></li>
          <li class="drop-down"> <a href="#">Organisation</a>
            <ul>
              {{-- <li><a href="{{ url('founding_president_message') }}">President Message</a></li> --}}
              <li><a href="{{ url('governance') }}">Governance</a></li>
              <li><a href="{{ url('secretariat') }}">Secretariat</a></li>
              <li><a href="{{ url('management') }}">Management</a></li>
              <li><a href="{{ url('department') }}">Department</a></li>
              <li><a href="{{ url('petrons_and_advisor') }}">Patrons And Adviser</a></li>
            </ul>
          </li>
          <li class="drop-down"> <a href="#">Members</a>
            <ul>
              {{-- <li><a href="{{ url('associations/state_association') }}">State Association</a></li> --}}

              <li><a href="{{ url('members/full_member') }}">Full Member</a></li>
              <li><a href="{{ url('members/district_member') }}">District Member</a></li>
              <li><a href="{{ url('members/associate_member') }}">Associate Member</a></li>
              <li><a href="{{ url('members/other_member') }}">Other Member</a></li>
{{-- 
              <li><a href="{{ url('members/other_association') }}">Other Association</a></li>
              <li><a href="{{ url('members/other_association') }}">Other Association</a></li> --}}

            </ul>
          </li>
          <li><a href="{{ url('committee_commission') }}">Committees / Commissions</a></li>
          <li><a href="{{ url('documentsanddownloads') }}">Documents & Downloads</a></li>
        </ul>
      </li>
      <li class="nav-item drop-down"> <a href="#">Rules & Regulations</a>
        <ul>
          @foreach ($rules->sortBy('name') as $item)
          <li><a href="{{ url('rulesandregulations/'.$item->name) }}">{{ $item->name }}</a></li>
          @endforeach
        </ul>
      </li>

      <li class="nav-item drop-down"> <a href="#">Events</a>
        <ul>
          <li><a href="{{ url('/events/international_event') }}">International Events</a></li>
          <li><a href="{{ url('/events/national_event') }}">National Events</a></li>
          <li><a href="{{ url('/events/find_event_near_me') }}">Find event near me</a></li>

          {{-- <li><a href="{{ url('/events/other_event') }}">Other Events</a></li>
          <li><a href="{{ url('/results') }}">Results</a></li> --}}
        </ul>
      </li>
      <li class="nav-item drop-down"> <a href="#">Media</a>
        <ul>
          <li class="drop-down"> <a href="#">News</a>
            <ul>
              <li><a href="{{ url('international_news') }}">International News</a></li>
              <li><a href="{{ url('national_news') }}">National News</a></li>
            </ul>
          </li>
          <li><a href="{{ url('image_gallery') }}">Photo Gallery</a></li>
          <li><a href="{{ url('video_gallery') }}">Video Gallery</a></li>
          <!-- <li><a href="{{ url('news_letter') }}">Get Newsletters</a></li> -->
        </ul>
      </li>
      
      <li class="nav-item drop-down"> <a href="{{url('/individual')}}">JOIN TFI</a>
        <ul>
           <li><a href="{{url('/individual')}}">As an Individual</a></li>
           <li><a href="{{url('/sponsor')}}">As a Sponsor/Partner</a></li>
           <li><a href="{{url('/acadmey')}}">As a Club Acadmey</a></li>
           <li><a href="{{url('/district_tfi')}}">As a District Taekwondo Asso.</a></li>
           <li><a href="{{url('/as_a_state_assoc')}}">Guidelines</a></li>
           {{-- <li><a href="{{url('/volunteer')}}">Be a Volunteer</a></li> --}}


         {{-- <li><a href="news-details.html">As an Athlete</a></li>
         <li><a href="news-details.html">As an Official</a></li>
         <li><a href="news-details.html">As a Volunteer With India TFI</a></li> --}}

         <!-- <li><a href="news-details.html">State TFI Association</a></li> -->
       </ul>
     </li>



      <li class="nav-item drop-down"> <a href="#">TAEKWONDO TENT</a>
        <ul>
          <!-- <li><a href="{{ url('athlete_ranking') }}">Athlete Ranking</a></li> -->
          <!-- <li class="drop-down"> <a href="#">Profile</a>
            <ul>
              <li><a href="{{ url('memberprofile/athlete') }}">Athlete Profile</a></li>
              <li><a href="{{ url('memberprofile/coaches') }}">Coaches Profile</a></li>
              <li><a href="{{ url('memberprofile/judges') }}">Judges Profile</a></li>
            </ul>
          </li> -->

          <li><a href="{{ url('awards_and_honorured') }}">Be a volunteer with India Taekwondo</a></li>
          <li><a href="{{ url('halloffame') }}">Get Newsletters</a></li>
          <li><a href="{{ url('/antidoping') }}">Event near me?</a></li>
          <li><a href="{{ url('/education') }}">Club/Academy near me?</a></li>

          <!-- <li class=""> <a href="education/">Education</a>
            {{-- <ul>
              @foreach ($education as $item)
                  <li><a href="{{ url('education/'.$item->title) }}">{{ $item->title }}</a></li>
              @endforeach
            </ul> --}}
          </li> -->
        </ul>
      </li>

      <li class="nav-item"> <a href="{{ url('contact') }}">Contact Us</a></li>
      {{-- <li class="nav-item buy-ticket"> <a href="index-two.html#">Buy Tickets</a> </li> --}}
    </ul>
  </nav>
