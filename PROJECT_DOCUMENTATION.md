# India Taekwondo Web Platform & Multi-Tenant CMS
## Complete Technical Architecture & Functional Specification Manual

**Platform Name:** India Taekwondo Official Web Portal & Digital CMS  
**Live Production Host:** `live.indiataekwondo.com` / `portal.indiataekwondo.com`  
**Governing Body:** India Taekwondo (National Governing Body for Taekwondo in India)  
**Backend Framework:** Laravel 8.x / PHP 8.1 - 8.3  
**Database Subsystem:** MySQL 8.0 / MariaDB 10.4+  
**Frontend Architecture:** Blade Templating, Bootstrap 4, Cork Admin UI, CKEditor, jQuery  
**Transactional Mail Engine:** Brevo SMTP (Ports 2525 / 465)  
**Document Generation Date:** October 2026  

---

## 1. System Overview & Executive Summary

The **India Taekwondo Web Platform** is an enterprise-grade sports federation management portal and multi-tenant Content Management System (CMS). It was engineered to digitize all administrative, promotional, regulatory, and tournament operations of the national governing body for Taekwondo in India.

The ecosystem integrates four interconnected environments into a single codebase:
1. **National Public Web Portal**: Central federation website providing news, executive governance, athlete rankings, circulars, rules, anti-doping policies, and online membership applications.
2. **Multi-Tenant State & District Association Sub-Portals**: Regional federations (States and Districts) operate their own dedicated micro-websites with their own president messages, executive boards, news, circulars, and events under the national federation umbrella.
3. **Dedicated Tournament Microsites**: National and regional championships can be provisioned as independent portals with their own schedules, draw sheets, ring assignments, photo albums, video feeds, and official medal tallies.
4. **Super Admin Management Console**: Unified national administrative dashboard for centralized governance, federation communications, registry management, and tenant provisioning.

---

## 2. Technology Stack & Architectural Patterns

| Component | Technology | Description & Responsibility |
| :--- | :--- | :--- |
| **Backend Framework** | Laravel 8.x (PHP 8.1 - 8.3) | Application logic, Eloquent ORM, Service Providers, Middlewares, Blade view compiler. |
| **Relational Database** | MySQL 8.0 / MariaDB 10.4+ | Persistent storage for users, associations, events, media, and rankings. |
| **Administrative UI** | Cork Admin Theme (Bootstrap 4) | Responsive dashboard layout, data tables, modals, form controls, and statistics. |
| **WYSIWYG Rich Editor** | CKEditor 4 / 5 Integration | Integrated rich-text authoring with image and document upload support for news and articles. |
| **Transactional Email** | Brevo SMTP via Symfony Mailer | High-deliverability transactional engine on port 2525 (TLS) and 465 (SSL) for registrations and notifications. |
| **Reverse Proxy & SSL** | Nginx / Apache + cPanel AutoSSL | Trusted proxy handling (`TrustProxies`), HTTPS URL forcing, and wildcard subdomains. |
| **File Storage Subsystem** | Laravel Filesystem (`storage/app/public`) | Structured folder hierarchy linked via `public/storage` symlink for event posters, PDFs, and galleries. |

---

## 3. User Authentication, Authorization & 3-Tier Security Hierarchy

Access control is partitioned into three distinct administrative tiers, enforced by specialized middleware:

```
                  +-----------------------------------+
                  |        Authenticated User         |
                  +-----------------+-----------------+
                                    |
                    [RedirectIfAuthenticated Check]
                                    |
       +----------------------------+----------------------------+
       |                            |                            |
[role == 'admin']         [role == 'association']         [role == 'event']
       |                            |                            |
       v                            v                            v
/admin/slider               /assoc_admin/association_list   /event_admin/event_list
(Super Admin Console)       (Assoc Admin Console)           (Event Admin Console)
```

### 3.1 Administrative Role Definitions
1. **Super Admin (`role = 'admin'`)**:
   - Middleware: `auth`, `auth.admin` (`App\Http\Middleware\AccessAdmin`).
   - Route Prefix: `/admin/*`.
   - Authority: Complete global control over federation metadata, global news, national events, state/district association records, athlete rankings, and admin accounts.
2. **Association Admin (`role = 'association'`)**:
   - Middleware: `auth`, `auth.assoc` (`App\Http\Middleware\AccessAssociation`).
   - Route Prefix: `/assoc_admin/*`.
   - Authority: Restricted strictly to the specific State or District Associations where the user's UID is registered in the association's `user_access` list.
3. **Event Admin (`role = 'event'`)**:
   - Middleware: `auth`, `auth.event` (`App\Http\Middleware\AccessEvent`).
   - Route Prefix: `/event_admin/*`.
   - Authority: Restricted strictly to the specific Tournaments where the user's UID is registered in the event's `user_access` list.

### 3.2 Granular Multi-Tenant Access Gatekeeper
Tenancy isolation is enforced at the database and view level using comma-separated UIDs stored in `user_access`. For example:
```php
// Finding events authorized for the current user
$userId = Auth::user()->id;
$authorizedEvents = DB::table('events')
    ->whereRaw('FIND_IN_SET(?, user_access)', [$userId])
    ->get();
```
If an unauthorized administrator attempts to manipulate an entity outside their assigned list, the middleware and runtime gatekeeper aborts with HTTP 403 Forbidden.

---

## 4. Comprehensive Public Portal Functionality

The public front-end offers a rich, mobile-responsive portal for players, coaches, officials, media, and the general public.

### 4.1 Homepage (`/`)
- **Hero Banner Slider**: Dynamic promotional carousel displaying high-resolution tournament banners with custom headings, call-to-action buttons, and position ordering.
- **Breaking News Ticker & Feed**: Latest official releases from national and international circuits sorted chronologically.
- **Photo & Video Gallery Highlights**: Thumbnails of recent championships and training camps linked to full albums.
- **Athlete Marquee Carousel**: Highlight reel of top-ranked Indian Taekwondo athletes with photos, states, and points.
- **Federation Statistics & Quick Links**: Quick access to rulebooks, upcoming events calendar, membership registration, and contact information.

### 4.2 Federation Overview & Organization
- **What is Taekwondo (`/taekwondo`)**: History of Taekwondo, Olympic recognition, World Taekwondo (WT) and Asian Taekwondo Union (ATU) affiliation, philosophy, and rules of Kyorugi (sparring) and Poomsae (patterns).
- **Founding President's Message (`/founding_president_message`)**: Official address from the founding president with executive portrait, vision statement, and historical background.
- **Executive Governance (`/governance`)**: Grid of Executive Board members, designations (President, Secretary General, Treasurer, Vice Presidents, Executive Committee Members), biographical data, and photographs.
- **Secretariat Office (`/secretariat`)**: Administrative personnel directory responsible for day-to-day federation operations and regional liaison.
- **Management Council (`/management`)**: Key executive officers, operational directors, and committee heads.
- **Federation Departments (`/department`)**: Operational wings including Technical Department, Referee Department, Tournament Department, Medical & Anti-Doping Department, and Media Department.
- **Patrons & Advisors (`/petrons_and_advisor`)**: Honorary dignitaries, advisors, legal counsels, and sports luminaries supporting the federation.

### 4.3 Committees & Commissions (`/committee_commission`)
- **Committees Overview**: Directory of standing federation committees (e.g. Referee Committee, Athletes Committee, Technical Committee, Disciplinary Committee, Women's Committee).
- **Dynamic Detail View (`/committee_commission/{id}/{name}`)**: Detailed committee landing page displaying the chairperson, vice-chairperson, convener, appointed members, responsibilities, and official term.
- **Commissions Directory**: Specialized task forces and commissions with appointed subject-matter experts.

### 4.4 Publications, Compliance & Downloads
- **Documents & Downloads (`/documentsanddownloads`)**: Categorized document library with direct PDF preview and downloading:
  - `DOCUMENTS`: Federation constitution, annual reports, statutory filings.
  - `AUDIT & ACCOUNTING`: Audited financial statements, balance sheets, utilization certificates.
  - `FORMS & CIRCULARS`: National championship entry forms, athlete consent forms, accreditation forms.
- **Rules & Regulations (`/rulesandregulations`, `/rulesandregulations/{rulename}`)**: Full repository of competition rules (Kyorugi & Poomsae competition rules, weight division charts, scoring criteria, protest procedures, anti-harassment policies).

### 4.5 Championship & Events Calendar (`/events/{type}`, `/event/{id}/{title}`)
- **Event Categorization**: National Championships, International Championships, and State/Open Invitationals.
- **Event Presentation Modes**:
  1. *Internal Article Mode*: Full tournament prospectus, circular, venue directions, and entry fee schedule written in rich-text.
  2. *Dedicated Event Microsite Mode*: Direct transition into the championship's dedicated sub-portal.
  3. *External Registration Link Mode*: Direct redirect to international portals (e.g. World Taekwondo Simply Compete / GMS).

### 4.6 Media & Press Center
- **National News (`/national_news`, `/national_news/{id}/{title}`)**: Articles, press releases, team selection trials coverage, and championship reports with cover images and publication dates.
- **International News (`/international_news`)**: Updates regarding Indian athletes competing at World Championships, Asian Games, and Grand Prix events.
- **Newsletters (`/news_letter`)**: Federation quarterly digests and periodic bulletins.
- **Photo Albums (`/image_gallery`, `/image_gallery/{id}/{name}`)**: Multi-tier photo albums categorized by event, year, and venue with lightbox viewing.
- **Video Gallery (`/video_gallery`, `/video_gallery/{id}/{name}`)**: Video collections with embedded responsive YouTube players for fight highlights, interviews, and seminars.

### 4.7 TFI Tent (Athletes, Rankings, Education & Honors)
- **National Athlete Rankings (`/athlete_ranking`, `/memberprofile/{type}`)**: Searchable registry of certified athletes, coaches, and referees. Displays current national ranking points, weight category, state association, and profile photo.
- **Awards & Honors (`/awards_and_honorured`, `/awardsandhonorured/{name}`)**: Federation honors awarded to outstanding martial artists, coaches, and contributors.
- **Hall of Fame (`/halloffame`, `/halloffame/{name}`)**: Inductees who have represented India at international Olympic, Asian, and World events.
- **Anti-Doping Policy (`/antidoping`)**: National Anti-Doping Agency (NADA) and World Anti-Doping Agency (WADA) compliance directives, prohibited substance lists, therapeutic use exemption (TUE) guidelines, and educational videos.
- **Education & Seminars (`/education`)**: National referee refresher courses, coaching license seminars, and black belt Dan grading guidelines.

### 4.8 Membership Applications & Inquiries ("Join TFI")
- **Individual Registration (`/individual`)**: Online enrolment form for Athletes, Coaches, Referees, Officials, and Medical personnel.
- **Academy Affiliation Form (`/acadmey`)**: Application form for martial art dojangs and training clubs seeking federation recognition.
- **District Association Registration (`/district_tfi`)**: Onboarding application for district bodies.
- **State Association Affiliation (`/as_a_state_assoc`)**: Official affiliation request for state-level governing bodies.
- **Sponsorship & Partnership (`/sponsor`)**: Corporate sponsorship, brand partnership, and CSR grant proposals.
- **Volunteer Registration (`/volunteer`)**: Volunteer sign-up for national tournaments, logistics, and medical support.
- **Automated Mail Router (`POST /tfiSendEmail`)**: Automatically compiles submitted application data and dispatches branded email notifications to designated federation administrative inboxes.

### 4.9 Federation Directory & Contact
- **Member Directory (`/members/{type}`, `/members/{type}/{name}`)**: Public profiles of all affiliated State Associations, District Associations, and Associate Members, showing official contact persons, phone numbers, and offices.
- **Contact Us Form (`/contact`, `POST /contactUs`)**: Interactive contact portal with Google Maps integration, office address coordinates, and automated inquiry notification routing.

---

## 5. Super Admin Management Console (`/admin/*`)

The Super Admin panel provides total administrative control over the digital infrastructure.

```
+-------------------------------------------------------------------------------+
|                             SUPER ADMIN CONSOLE                               |
+-------------------------------------------------------------------------------+
| - Homepage Sliders             | - Committees & Members (Dynamic AJAX)        |
| - Federation Profile & Emails  | - Commissions & Appointed Experts            |
| - Default Background Banners   | - Official Documents (PDF Library)           |
| - Taekwondo Martial Art Page   | - Rules, Regulations & Bylaws                |
| - Founding President Message   | - Awards, Honors & Hall of Fame              |
| - Executive Governance Roster  | - Anti-Doping Policies & Education           |
| - Secretariat Personnel        | - National & International Press News        |
| - Management Council           | - Multi-Folder Image & Video Albums          |
| - Federation Departments       | - National, International & Other Events     |
| - Honorary Patrons & Advisors  | - State, District & Associate Members        |
| - Championship Results         | - Athletes, Coaches & Referees Registries    |
+-------------------------------------------------------------------------------+
```

### 5.1 Presentation & Federation Settings
- **`slider` (SliderController)**: Add, edit, reorder (ascending position), and delete homepage carousel slides. Supports background images, slide captions, and external/internal button links.
- **`profile` (MainProfileController)**: Controls global federation contact details, headquarter address, customer support phone lines, primary recipient email (`send_to_email`), secondary recipient email (`send_to_email_2`), and official social media handles (Facebook, Twitter/X, Instagram, YouTube, LinkedIn).
- **`default_background` (DefaultBgController)**: Manage fallback header background graphics for sub-pages across the portal.

### 5.2 Federation Organization & Leadership
- **`taekwondo` (TaekwondoController)**: Authoring the historical, philosophical, and technical content of Taekwondo in India using CKEditor.
- **`president_message` (PresidentMessageController)**: Manage the President's portrait, title, and public address text.
- **`governance` (GovernanceController)**: Manage executive committee members, portrait uploads, designations, and display priority.
- **`secretariat` (SecretariatController)**: Manage secretariat administrative officers, office designations, and contact numbers.
- **`management` (ManagementController)**: Manage federation managerial personnel and department coordinators.
- **`department` (DepartmentController)**: Create and edit federation functional departments and assign heads of departments.
- **`patrons` (PatronsController)**: Manage honorary patrons, legal advisors, and corporate advisors.

### 5.3 Committees & Commissions Subsystem
- **`committee` (CommitteeController)**: Create new standing committees.
- **`committee_member` (CommitteeMemberController)**: Add, edit, or remove committee members.
- **Dynamic AJAX Member Assignment**:
  - `POST /admin/createNewCommittee`: Creates committee with instant modal response.
  - `GET /admin/getAllMembersForSelectedCommittee/{id}`: Asynchronous fetching of member lists for seamless UI updates without full page reloads.
  - `POST /admin/updateCommittee`: Updates committee title and jurisdiction.
  - `POST /admin/updateCommitteeMembers`: Bulk updates appointed members and roles.
- **`commission` & `commission_member` (CommissionController, CommissionMemberController)**: Parallel dynamic subsystem managing specialized federation commissions.

### 5.4 Compliance, Rules & Publications
- **`documents` (DocumentsController)**: Upload and manage official PDF publications. Tags documents into `DOCUMENTS`, `AUDIT & ACCOUNTING`, or `FORMS & CIRCULARS`. Handles secure file storage and public symlink generation.
- **`rulesandregulations` (RulesAndRegulationController)**: Upload competition rulebooks, constitutional amendments, and operational bylaws with rich-text descriptions and attached PDF downloads.

### 5.5 Media, Galleries & Press Releases
- **`national_news` & `international_news` (NationalNewsController, InternationalNewsController)**: Publish press releases and articles. Integrated with CKEditor for formatting, image embeds, cover photo uploads, and publication timestamps.
- **`album` & `image_gallery` (AlbumController, ImageGalleryController)**: Multi-folder image management system:
  - Create parent and child image albums.
  - Bulk image upload with automatic dimension and format validation.
  - Folder rename, album deletion, and individual photo management (`deleteSelectedAlbumImages`, `renameSelectedFolder`, `deleteSelectedFolder`, `uploadMoreImagesAndFolders`).
- **`video_album` & `video_gallery` (VideoAlbumController, VideoGalleryController)**: Create video albums and curate video lists using standard YouTube URLs or embed codes (`updateSelectedAlbumDetails`, `updateSelectedAlbumYoutubeLinks`, `createNewVideoAlbum`).

### 5.6 Championship & Event Lifecycle Management
- **`national_event`, `international_event`, `other_event` (NationalEventController, InternationalEventController, OtherEventController)**:
  - Event title, dates (start and end), host state, city, venue stadium, and summary intro.
  - Validated cover graphic (350x250 pixels).
  - **The 3 Presentation Modes**:
    1. *Mode 1 (Content)*: Stores rich-text description for display on the main site.
    2. *Mode 2 (Microsite)*: Instantiates a dedicated championship microsite. Automatically creates a new Event Admin user (`role = 'event'`), hashes the password, provisions records in `event_profiles` and `default_events`, and appends the UID to `events.user_access`.
    3. *Mode 3 (External Link)*: Directs users to external international championship portals.
- **`results` (ResultsController)**: Upload championship medal tallies, match scorecards, division winners, and official result PDFs.

### 5.7 Multi-Tenant Association Management
- **`state_association`, `district_association`, `full_member`, `other_association`**:
  - Register state and district federations.
  - Assign geographical jurisdiction.
  - Onboard administrative accounts: Assign existing administrator or create a new user on the fly (`role = 'association'`). Automatically appends the user UID to `associations.user_access` and provisions initial association profiles and default backgrounds.

### 5.8 Athlete, Coach & Referee Registries (TFI Tent)
- **`profile_athlete` (ProfileAthleteController)**: Athlete database with national registration number, state, weight category, date of birth, national ranking points, and portrait.
- **`profile_coaches` (ProfileCoachesController)**: Certified coach registry with certification grade (Level 1, 2, 3), state affiliation, and licensing validity.
- **`profile_judges` (ProfileJudgesController)**: Certified referee and judge registry with referee class (National/International Class), Poomsae/Kyorugi certification, and state.
- **`award` & `halloffame` (AwardController, HallOfFameController)**: Honors, awards, and hall of fame inductions.
- **`antidoping` (AntiDopingController)**: WADA/NADA anti-doping regulations, banned lists, and educational materials.
- **`education` (EducationController)**: Training modules, referee course schedules, and coaching clinics.

---

## 6. Multi-Tenant Association Sub-Portals (`/state/...`, `/district/...`, `/assoc_admin/*`)

State and District Associations operate fully functional sub-websites under the national platform.

### 6.1 Public Association Sub-Website Routes
Every association receives a dedicated web space accessible via friendly URLs:
- State Associations: `/state/{assoc_id}/{assoc_name}`
- District Associations: `/district/{assoc_id}/{assoc_name}`
- Other Affiliated Members: `/other_assoc/{assoc_id}/{assoc_name}`

#### Sub-Website Features:
1. **Association Homepage**: Custom hero slider, welcome message, latest regional news, and upcoming tournaments.
2. **Leadership Messages**:
   - `/president_message`: Regional President's portrait and address.
   - `/secretary_message`: Regional Secretary General's message and report.
3. **Regional Governance (`/governance`)**: Directory of state/district executive board members.
4. **Patrons & Advisors (`/patronsandadviser`)**: Regional dignitaries and honorary advisors.
5. **Regional Committees (`/committees/{committee_name}`)**: Local technical, referee, and disciplinary committees.
6. **Circulars & Documents (`/documents`)**: Official notifications, state trial circulars, and entry criteria.
7. **Contact Headquarters (`/contactus`)**: Local federation office address, email, phone, and inquiry form.
8. **Regional News & Bulletins (`/news`)**: Local tournaments, athlete felicitations, and grassroots updates.
9. **Regional Galleries (`/image_albums`, `/video_albums`)**: Local photo albums and YouTube video coverage.
10. **Affiliated Sub-Districts (`/district_association`)**: State sub-portals list and link to all affiliated district bodies.
11. **Local Championships (`/assoc_events`, `/state/event/{assoc_id}/{event_id}/{name}`)**: Tournaments hosted by the association.

### 6.2 Association Admin Console (`/assoc_admin/*`)
Association administrators manage their sub-website through a dedicated dashboard protected by `auth.assoc`:
- **`association_list` (AccessController)**: Lists all associations assigned to the logged-in administrator.
- **`slider/{assoc_id}` (SliderController)**: Add, edit, reorder, and remove hero banner slides for the association homepage.
- **`profile/{assoc_id}` (ProfileController)**: Manage office address, contact email, phone, and social links.
- **`default_background/{assoc_id}` (DefaultsController)**: Customize header background graphics.
- **`president_message/{assoc_id}` & `secretary_message/{assoc_id}`**: Manage leadership photos and addresses.
- **`governance/{assoc_id}` (GovernanceController)**: Manage executive board members, roles, and portraits.
- **`petrons/{assoc_id}` (PetronController)**: Manage local patrons and advisors.
- **`committees/{assoc_id}` & `committee_member/{assoc_id}`**: Manage regional committees and dynamic member rosters.
- **`documents/{assoc_id}` (DocumentController)**: Upload state/district circulars, guidelines, and PDF notices.
- **`news/{assoc_id}` (NewsController)**: Publish regional news articles with cover photos and rich text.
- **`album_image/{assoc_id}` & `album_video/{assoc_id}`**: Manage photo albums, bulk picture uploads, and YouTube video playlists.
- **`district_association/{assoc_id}` (DistrictController)**: State admins can onboard and manage affiliated district bodies.
- **`other_association/{assoc_id}` (OtherController)**: Manage institutional clubs and affiliated academies.
- **`event/{assoc_id}` (EventController)**: Create and administer state/district championships.

---

## 7. Dedicated Championship Microsites (`/events/{id}/{name}`, `/event_admin/*`)

Tournaments provisioned in "Dedicated Microsite" mode operate as self-contained digital championship portals.

### 7.1 Public Championship Microsite Architecture
Accessible at `/events/{event_id}/{event_name}`:
1. **Championship Home**: Official event hero slider, tournament countdown, venue overview, and host state welcome.
2. **Tournament News (`/news`)**: Real-time tournament announcements, weigh-in schedules, and ring allocations.
3. **Schedule, Draws & Results (`/schedule_and_results`)**:
   - Official Draw Sheets (Kyorugi & Poomsae brackets).
   - Match order and ring schedules.
   - Live medal tallies and podium winners (Gold, Silver, Bronze) by weight category.
4. **Important PDFs**: Direct access to competition circulars, hotel/accommodation guides, anti-doping declarations, and age verification rules.
5. **Championship Galleries (`/image_albums`, `/video_albums`)**: High-resolution tournament photos and video highlights of finals.

### 7.2 Event Admin Console (`/event_admin/*`)
Championship administrators manage tournament operations through a dedicated portal protected by `auth.event`:
- **`event_list` (EventAccessController)**: Lists championships assigned to the logged-in administrator.
- **`slider/{event_id}` (SliderController)**: Upload and manage promotional tournament banners.
- **`profile/{event_id}` (ProfileController)**: Set stadium address, reporting dates, venue maps, and organizer contact details.
- **`default_background/{event_id}` (DefaultsController)**: Configure background graphics for championship pages.
- **`news/{event_id}` (EventNewsController)**: Publish live daily bulletins and competition updates.
- **`important_pdf/{event_id}` (EventImportantPdfController)**: Upload draw sheets, weigh-in notices, and official circulars.
- **`album_image/{event_id}` & `album_video/{event_id}`**: Upload tournament photo albums and embed YouTube match broadcasts.
- **`results/{event_id}` (ResultController)**: Publish category-wise winners and upload verified signed result sheets.

---

## 8. Relational Database Schema & Data Dictionary

The platform database comprises 40+ normalized tables supporting multi-tenancy, media, and federated structures:

```
+-----------------------------------------------------------------------------------+
|                           CORE DATABASE RELATIONSHIPS                             |
+-----------------------------------------------------------------------------------+
|  [users] 1 ----- * [events] (via user_access FIND_IN_SET)                         |
|  [users] 1 ----- * [associations] (via user_access FIND_IN_SET)                   |
|                                                                                   |
|  [events] 1 ----- 1 [event_profiles]                                              |
|  [events] 1 ----- * [event_sliders]                                               |
|  [events] 1 ----- * [news_events]                                                 |
|  [events] 1 ----- * [important_p_d_f_events]                                      |
|  [events] 1 ----- * [album_image_events] 1 ----- * [event_image_galleries]        |
|  [events] 1 ----- * [events_video_albums] 1 ----- * [events_videos]               |
|  [events] 1 ----- * [event_results]                                               |
|                                                                                   |
|  [associations] 1 ----- 1 [association_profiles]                                  |
|  [associations] 1 ----- * [association_sliders]                                   |
|  [associations] 1 ----- * [association_news]                                      |
|  [associations] 1 ----- * [association_documents]                                 |
|  [associations] 1 ----- * [association_governances]                               |
|  [associations] 1 ----- * [association_patrons]                                   |
|  [associations] 1 ----- * [association_committees] 1 ----- * [assoc_comm_members] |
|  [associations] 1 ----- * [association_albums] 1 ----- * [assoc_image_galleries]  |
|  [associations] 1 ----- * [association_video_albums] 1 ----- * [assoc_videos]     |
|  [associations] 1 ----- * [association_events]                                    |
|                                                                                   |
|  [committees] 1 ----- * [committee_members]                                       |
|  [commissions] 1 ----- * [commission_members]                                     |
|  [albums] 1 ----- * [image_galleries]                                             |
|  [video_albums] 1 ----- * [video_galleries]                                       |
+-----------------------------------------------------------------------------------+
```

### Key Table Schema Breakdown:
- **`users`**: `id`, `name`, `email`, `email_verified_at`, `password`, `role` (`admin`, `association`, `event`, `user`), `remember_token`, `timestamps`.
- **`events`**: `id`, `title`, `location`, `date`, `intro`, `content`, `cover_image`, `event_presentation` (1=Content, 2=Microsite, 3=External Link), `link`, `user_access` (comma-separated UIDs), `timestamps`.
- **`associations`**: `id`, `name`, `type` (`state`, `district`, `full`, `other`), `state_id`, `district_id`, `user_access` (comma-separated UIDs), `status`, `timestamps`.
- **`member_profiles`**: `id`, `name`, `type` (`athlete`, `coach`, `judge`), `state_id`, `points`, `category`, `photo`, `license_no`, `timestamps`.
- **`documents`**: `id`, `title`, `category` (`DOCUMENTS`, `AUDIT & ACCOUNTING`, `FORMS & CIRCULARS`), `file_path`, `timestamps`.
- **`rules_and_regulations`**: `id`, `title`, `content`, `pdf_file`, `timestamps`.
- **`news`**: `id`, `title`, `intro`, `content`, `cover_image`, `type` (`national`, `international`), `Date`, `timestamps`.
- **`albums` & `image_galleries`**: `id`, `album_name`, `parent_id`, `path`, `timestamp`.
- **`video_albums` & `video_galleries`**: `id`, `album_name`, `youtube_link`, `timestamps`.
- **`join_t_f_i_s`**: `id`, `full_name`, `email`, `phone`, `applied_as`, `state`, `district`, `address`, `data` (JSON payload), `timestamps`.
- **`contact_uses`**: `id`, `full_name`, `email`, `phone`, `subject`, `message`, `type`, `assoc_id`, `timestamps`.

---

## 9. Transactional Email System & Production Operations

### 9.1 Transactional Email Routing (Brevo SMTP)
Registration emails, password resets, application confirmations, and inquiry alerts are routed through a dedicated cloud transactional provider (Brevo).
- **Host**: `smtp-relay.brevo.com`
- **Supported Outgoing Ports**:
  - **Port 2525 (STARTTLS)**: Industry-standard fallback port. Used to completely bypass shared hosting and cPanel firewall rules ("SMTP Restrictions") that intercept standard port 587.
  - **Port 465 (SSL/TLS)**: Secure implicit SSL connection.
- **Sender Address**: Configured to branded domain address (e.g. `noreply@indiataekwondo.com` or verified sender).

### 9.2 Production Maintenance & Artisan Commands
When deploying changes or updating configuration on cPanel:
```bash
# Clear all cached configurations and views
ea-php82 artisan config:clear
ea-php82 artisan cache:clear
ea-php82 artisan view:clear
ea-php82 artisan route:clear

# Re-link public storage for uploads
ea-php82 artisan storage:link

# Test SMTP connection from terminal
ea-php82 artisan tinker --execute='Mail::raw("Brevo test", function($m) { $m->to("admin@indiataekwondo.com")->subject("SMTP Test"); }); echo "Sent successfully\n";'
```

### 9.3 Diagnostic & Monitoring Log Inspection
To inspect live production errors:
```bash
# Monitor errors in real time
tail -f storage/logs/laravel.log

# Extract the latest 3 production error entries
grep "production.ERROR" storage/logs/laravel.log | tail -n 3
```

---
*End of Technical Specification and Functional Documentation.*
