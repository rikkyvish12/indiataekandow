<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ImageGalleryController;
// use App\Http\Controllers\Admin\CommitteeController;

// use App\Http\Controllers\Admin\VideoAlbumController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Global Data fetching

Route::get('/storage_symlink', function () {
  Artisan::call('storage:link');
});
Route::get('/getDistricts/{state_id}',[App\Http\Controllers\Admin\Main\DistrictAssociationController::class, 'getDistricts']);
Route::post('/contactUs', [App\Http\Controllers\MainPagesController::class, 'contactUsController']);


Route::get('/', [App\Http\Controllers\MainPagesController::class, 'index']);
Route::get('/taekwondo', [App\Http\Controllers\MainPagesController::class, 'taekwondo']);
Route::get('/founding_president_message', [App\Http\Controllers\MainPagesController::class, 'founding_president_message']);
Route::get('/governance', [App\Http\Controllers\MainPagesController::class, 'governance']);
Route::get('/secretariat', [App\Http\Controllers\MainPagesController::class, 'secretariat']);
Route::get('/management', [App\Http\Controllers\MainPagesController::class, 'management']);
Route::get('/department', [App\Http\Controllers\MainPagesController::class, 'department']);
Route::get('/petrons_and_advisor', [App\Http\Controllers\MainPagesController::class, 'patronsandadviser']);
Route::get('/committee_commission', [App\Http\Controllers\MainPagesController::class, 'committee_commission']);
Route::get('/committee_commission/{committee_id}/{committee_name}',[App\Http\Controllers\MainPagesController::class, 'committee_commission_detail']);
Route::get('/documentsanddownloads',[App\Http\Controllers\MainPagesController::class, 'documentationanddownloads']);
Route::get('/rulesandregulations',[App\Http\Controllers\MainPagesController::class, 'rulesandregulations']);
Route::get('/rulesandregulations/{rulename}',[App\Http\Controllers\MainPagesController::class, 'rulesandregulationsDetails']);

Route::get('/events/{event_type}',[App\Http\Controllers\MainPagesController::class, 'events']);

Route::get('/event/{event_id}/{title}',[App\Http\Controllers\MainPagesController::class, 'events_details']);

Route::get('/news_letter',[App\Http\Controllers\MainPagesController::class, 'news_letter']);
Route::get('/international_news',[App\Http\Controllers\MainPagesController::class, 'international_news']);

Route::get('/national_news',[App\Http\Controllers\MainPagesController::class, 'national_news']);
Route::get('/national_news/{event_id}/{title}',[App\Http\Controllers\MainPagesController::class, 'national_news_details']);

// Route::get('/find_event_near_me',[App\Http\Controllers\MainPagesController::class, 'find_event_near_me']);
// Route::get('/find_event_near_me/{event_id}/{title}',[App\Http\Controllers\MainPagesController::class, 'find_event_near_me_details']);

Route::get('/image_gallery',[App\Http\Controllers\MainPagesController::class, 'image_album']);
Route::get('/image_gallery/{album_id}/{album_name}',[App\Http\Controllers\MainPagesController::class, 'image_gallery']);
Route::get('/video_gallery',[App\Http\Controllers\MainPagesController::class, 'video_album']);
// Route::get('/video_gallery/{album_name}',[App\Http\Controllers\MainPagesController::class, 'video_gallery']);
Route::get('/video_gallery/{album_id}/{album_name}',[App\Http\Controllers\MainPagesController::class, 'video_gallery']);
Route::get('/awards_and_honorured',[App\Http\Controllers\MainPagesController::class, 'awardsandhonorured']);
Route::get('/awardsandhonorured/{awardname}',[App\Http\Controllers\MainPagesController::class, 'awardsandhonorureddetails']);
Route::get('/halloffame',[App\Http\Controllers\MainPagesController::class, 'halloffame']);
Route::get('/halloffame/{awardname}',[App\Http\Controllers\MainPagesController::class, 'halloffamedetails']);
Route::get('/antidoping',[App\Http\Controllers\MainPagesController::class, 'antidoping']);
Route::get('/contact',[App\Http\Controllers\MainPagesController::class, 'contact']);
// Route::get('education/{educationName}',[App\Http\Controllers\MainPagesController::class, 'education']);
Route::get('/education',[App\Http\Controllers\MainPagesController::class, 'education']);
// Route::get('join_tfi/',[App\Http\Controllers\MainPagesController::class, 'joinTFI']);
Route::get('/individual',[App\Http\Controllers\MainPagesController::class, 'individual']);
Route::get('/sponsor',[App\Http\Controllers\MainPagesController::class, 'sponsor']);
Route::get('/acadmey',[App\Http\Controllers\MainPagesController::class, 'acadmey']);

Route::get('/district_tfi',[App\Http\Controllers\MainPagesController::class, 'districtTFI']);
Route::get('/as_a_state_assoc',[App\Http\Controllers\MainPagesController::class, 'asAstateAssoc']);
Route::get('/volunteer',[App\Http\Controllers\MainPagesController::class, 'volunteer']);

Route::post('/tfiSendEmail', [App\Http\Controllers\MainPagesController::class, 'sendEmail'])->name('tfiSendEmail');

Route::get('/results',[App\Http\Controllers\MainPagesController::class, 'results']);

Route::get('/members/{association_type}',[App\Http\Controllers\MainPagesController::class, 'association']);
Route::get('/members/{association_type}/{association_name}',[App\Http\Controllers\MainPagesController::class, 'associationDetails']);

Route::get('/athlete_ranking',[App\Http\Controllers\MainPagesController::class, 'athlete_ranking']);
Route::get('/memberprofile/{type}',[App\Http\Controllers\MainPagesController::class, 'memberprofile']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('dummy', App\Http\Controllers\DummyController::class);

Route::get('ckeditorr', [App\Http\Controllers\CkeditorController::class, 'index']);
Route::post('ckeditorr/upload', [App\Http\Controllers\CkeditorController::class, 'upload'])->name('ckeditor.upload');

Route::post('/admin/createNewCommittee',[App\Http\Controllers\Admin\Main\CommitteeController::class,'createNewCommittee'] );
Route::get('/admin/getAllMembersForSelectedCommittee/{comm_id}', [App\Http\Controllers\Admin\Main\CommitteeController::class, 'getAllMembersForSelectedCommittee']);
Route::post('/admin/updateCommittee',[App\Http\Controllers\Admin\Main\CommitteeController::class,'updateCommittee'] );
Route::post('/admin/updateCommitteeMembers',[App\Http\Controllers\Admin\Main\CommitteeController::class,'updateCommitteeMembers'] );

Route::post('/admin/createNewCommission',[App\Http\Controllers\Admin\Main\CommissionController::class,'createNewCommission'] );
Route::get('/admin/getAllMembersForSelectedCommission/{comm_id}', [App\Http\Controllers\Admin\Main\CommissionController::class, 'getAllMembersForSelectedCommission']);
Route::post('/admin/updateCommission',[App\Http\Controllers\Admin\Main\CommissionController::class,'updateCommission'] );
Route::post('/admin/updateCommissionMembers',[App\Http\Controllers\Admin\Main\CommissionController::class,'updateCommissionMembers'] );



// EVENT WEBSITE ROUTES //
Route::get('events/{event_id}/{event_name}', [App\Http\Controllers\EventPagesController::class, 'event_main']);
Route::get('events/{event_id}/{event_name}/image_albums', [App\Http\Controllers\EventPagesController::class, 'event_albums']);
Route::get('events/{event_id}/{event_name}/image_albums/{album_id}/{album_name}', [App\Http\Controllers\EventPagesController::class, 'event_image_gallery']);

Route::get('events/{event_id}/{event_name}/video_albums', [App\Http\Controllers\EventPagesController::class, 'event_video_albums']);
Route::get('events/{event_id}/{event_name}/video_albums/{album_id}/{album_name}', [App\Http\Controllers\EventPagesController::class, 'event_video_gallery']);

Route::get('events/{event_id}/{event_name}/news', [App\Http\Controllers\EventPagesController::class, 'event_news']);
Route::get('events/{event_id}/{event_name}/schedule_and_results', [App\Http\Controllers\EventPagesController::class, 'event_results']);


// STATE WEBSITE ROUTES //

Route::get('state/{assoc_id}/{assoc_name}', [App\Http\Controllers\AssociationPagesController::class, 'assoc_main']);
Route::get('state/{assoc_id}/{assoc_name}/president_message', [App\Http\Controllers\AssociationPagesController::class, 'assoc_president_message']);
Route::get('state/{assoc_id}/{assoc_name}/secretary_message', [App\Http\Controllers\AssociationPagesController::class, 'assoc_secretary_message']);
Route::get('state/{assoc_id}/{assoc_name}/governance', [App\Http\Controllers\AssociationPagesController::class, 'assoc_governacne']);
Route::get('state/{assoc_id}/{assoc_name}/patronsandadviser', [App\Http\Controllers\AssociationPagesController::class, 'assoc_patrons']);
Route::get('state/{assoc_id}/{assoc_name}/committees/{committee_name}', [App\Http\Controllers\AssociationPagesController::class, 'assoc_committee']);
Route::get('state/{assoc_id}/{assoc_name}/documents', [App\Http\Controllers\AssociationPagesController::class, 'assoc_documents']);
Route::get('state/{assoc_id}/{assoc_name}/contactus', [App\Http\Controllers\AssociationPagesController::class, 'assoc_contact']);
Route::get('state/{assoc_id}/{assoc_name}/news', [App\Http\Controllers\AssociationPagesController::class, 'assoc_news']);
Route::get('state/{assoc_id}/{assoc_name}/image_albums', [App\Http\Controllers\AssociationPagesController::class, 'assoc_image_album']);
Route::get('state/{assoc_id}/{assoc_name}/video_albums', [App\Http\Controllers\AssociationPagesController::class, 'assoc_video_album']);
Route::get('state/{assoc_id}/{assoc_name}/image_gallery/{album_id}/{album_name}', [App\Http\Controllers\AssociationPagesController::class, 'assoc_image_gallery']);
Route::get('state/{assoc_id}/{assoc_name}/video_gallery/{album_id}/{album_name}', [App\Http\Controllers\AssociationPagesController::class, 'assoc_video_gallery']);
Route::get('state/{assoc_id}/{assoc_name}/district_association', [App\Http\Controllers\AssociationPagesController::class, 'assoc_district']);
Route::get('state/{assoc_id}/{assoc_name}/other_member', [App\Http\Controllers\AssociationPagesController::class, 'assoc_other']);

Route::get('state/{assoc_id}/{assoc_name}/assoc_events', [App\Http\Controllers\AssociationPagesController::class, 'assoc_events']);

Route::get('state/event/{assoc_id}/{event_id}/{event_name}', [App\Http\Controllers\AssociationPagesController::class, 'assoc_events_details']);

// Route::get('state/events/{event_id}/{event_name}', [App\Http\Controllers\AssociationPagesController::class, 'assoc_events_details']);

// district website routes //
Route::get('district/{assoc_id}/{assoc_name}', [App\Http\Controllers\AssociationPagesController::class, 'assoc_main']);
Route::get('district/{assoc_id}/{assoc_name}/president_message', [App\Http\Controllers\AssociationPagesController::class, 'assoc_president_message']);
Route::get('district/{assoc_id}/{assoc_name}/secretary_message', [App\Http\Controllers\AssociationPagesController::class, 'assoc_secretary_message']);
Route::get('district/{assoc_id}/{assoc_name}/governance', [App\Http\Controllers\AssociationPagesController::class, 'assoc_governacne']);
Route::get('district/{assoc_id}/{assoc_name}/patronsandadviser', [App\Http\Controllers\AssociationPagesController::class, 'assoc_patrons']);
Route::get('district/{assoc_id}/{assoc_name}/committees/{committee_name}', [App\Http\Controllers\AssociationPagesController::class, 'assoc_committee']);
Route::get('district/{assoc_id}/{assoc_name}/documents', [App\Http\Controllers\AssociationPagesController::class, 'assoc_documents']);
Route::get('district/{assoc_id}/{assoc_name}/contactus', [App\Http\Controllers\AssociationPagesController::class, 'assoc_contact']);
Route::get('district/{assoc_id}/{assoc_name}/news', [App\Http\Controllers\AssociationPagesController::class, 'assoc_news']);
Route::get('district/{assoc_id}/{assoc_name}/image_albums', [App\Http\Controllers\AssociationPagesController::class, 'assoc_image_album']);
Route::get('district/{assoc_id}/{assoc_name}/video_albums', [App\Http\Controllers\AssociationPagesController::class, 'assoc_video_album']);
Route::get('district/{assoc_id}/{assoc_name}/image_gallery/{album_id}/{album_name}', [App\Http\Controllers\AssociationPagesController::class, 'assoc_image_gallery']);
Route::get('district/{assoc_id}/{assoc_name}/video_gallery/{album_name}', [App\Http\Controllers\AssociationPagesController::class, 'assoc_video_gallery']);
// Route::get('district/{assoc_id}/{assoc_name}/district_association', [App\Http\Controllers\AssociationPagesController::class, 'assoc_district']);
Route::get('district/{assoc_id}/{assoc_name}/other_member', [App\Http\Controllers\AssociationPagesController::class, 'assoc_other']);
Route::get('district/{assoc_id}/{assoc_name}/assoc_events', [App\Http\Controllers\AssociationPagesController::class, 'assoc_events']);

// district website routes //
Route::get('other_assoc/{assoc_id}/{assoc_name}', [App\Http\Controllers\AssociationPagesController::class, 'assoc_main']);
Route::get('other_assoc/{assoc_id}/{assoc_name}/president_message', [App\Http\Controllers\AssociationPagesController::class, 'assoc_president_message']);
Route::get('other_assoc/{assoc_id}/{assoc_name}/secretary_message', [App\Http\Controllers\AssociationPagesController::class, 'assoc_secretary_message']);
Route::get('other_assoc/{assoc_id}/{assoc_name}/governance', [App\Http\Controllers\AssociationPagesController::class, 'assoc_governacne']);
Route::get('other_assoc/{assoc_id}/{assoc_name}/patronsandadviser', [App\Http\Controllers\AssociationPagesController::class, 'assoc_patrons']);
Route::get('other_assoc/{assoc_id}/{assoc_name}/committees/{committee_name}', [App\Http\Controllers\AssociationPagesController::class, 'assoc_committee']);
Route::get('other_assoc/{assoc_id}/{assoc_name}/documents', [App\Http\Controllers\AssociationPagesController::class, 'assoc_documents']);
Route::get('other_assoc/{assoc_id}/{assoc_name}/contactus', [App\Http\Controllers\AssociationPagesController::class, 'assoc_contact']);
Route::get('other_assoc/{assoc_id}/{assoc_name}/news', [App\Http\Controllers\AssociationPagesController::class, 'assoc_news']);
Route::get('other_assoc/{assoc_id}/{assoc_name}/image_albums', [App\Http\Controllers\AssociationPagesController::class, 'assoc_image_album']);
Route::get('other_assoc/{assoc_id}/{assoc_name}/video_albums', [App\Http\Controllers\AssociationPagesController::class, 'assoc_video_album']);
Route::get('other_assoc/{assoc_id}/{assoc_name}/image_gallery/{album_id}/{album_name}', [App\Http\Controllers\AssociationPagesController::class, 'assoc_image_gallery']);
Route::get('other_assoc/{assoc_id}/{assoc_name}/video_gallery/{album_name}', [App\Http\Controllers\AssociationPagesController::class, 'assoc_video_gallery']);
// Route::get('other_assoc/{assoc_id}/{assoc_name}/district_association', [App\Http\Controllers\AssociationPagesController::class, 'assoc_district']);
//Route::get('other_assoc/{assoc_id}/{assoc_name}/other_member', [App\Http\Controllers\AssociationPagesController::class, 'assoc_other']);
Route::get('other_assoc/{assoc_id}/{assoc_name}/assoc_events', [App\Http\Controllers\AssociationPagesController::class, 'assoc_events']);


Route::get('state_main',function(){
    return view('layouts.main_state');
});


Route::namespace('App\Http\Controllers\Admin\Main')->prefix('admin')->middleware(['auth','auth.admin'])->name('admin.')->group(function(){
    Route::resource('slider', SliderController::class);
    Route::resource('profile', MainProfileController::class);
    Route::resource('taekwondo', TaekwondoController::class);
    Route::resource('president_message', PresidentMessageController::class);
    Route::resource('secretariat', SecretariatController::class);
    Route::resource('governance', GovernanceController::class);
    Route::resource('management', ManagementController::class);
    Route::resource('department', DepartmentController::class);
    Route::resource('patrons', PatronsController::class);
    Route::resource('committee', CommitteeController::class);
    Route::resource('committee_member', CommitteeMemberController::class);
    Route::resource('commission', CommissionController::class);
    Route::resource('commission_member', CommissionMemberController::class);
    Route::resource('documents', DocumentsController::class);
    Route::resource('rulesandregulations', RulesAndRegulationController::class);
    Route::resource('award', AwardController::class);
    Route::resource('halloffame', HallOfFameController::class);
    Route::resource('antidoping', AntiDopingController::class);
    Route::resource('education', EducationController::class);
    Route::resource('international_news', InternationalNewsController::class);
    Route::resource('national_news', NationalNewsController::class);
    Route::resource('album', AlbumController::class);
    Route::resource('image_gallery', ImageGalleryController::class);
    Route::resource('video_gallery', VideoGalleryController::class);
    Route::resource('video_album', VideoAlbumController::class);
    Route::resource('international_event', InternationalEventController::class);
    Route::resource('national_event', NationalEventController::class);
    Route::resource('find_event_near_me', OtherEventController::class);
    Route::resource('other_event', OtherEventController::class);
    Route::resource('results', ResultsController::class);
    
    Route::resource('state_association', StateAssociationController::class);
    Route::resource('district_association', DistrictAssociationController::class);
    Route::resource('other_association', OtherAssociationController::class);

    
    Route::resource('associate_member', StateAssociationController::class);
    Route::resource('district_member', DistrictAssociationController::class);
    Route::resource('full_member', FullMemberController::class);
    Route::resource('other_member', OtherAssociationController::class);


    Route::resource('default_background', DefaultBgController::class);
    Route::resource('profile_athlete', ProfileAthleteController::class);
    Route::resource('profile_coaches', ProfileCoachesController::class);
    Route::resource('profile_judges', ProfileJudgesController::class);
    Route::post('createNewImageAlbum',[App\Http\Controllers\Admin\Main\ImageGalleryController::class,'createNewImageAlbum'] );


    //commitee admin routes
    Route::post('/updateSelectedAlbumDetails',[App\Http\Controllers\Admin\Main\VideoAlbumController::class,'updateSelectedAlbumDetails'] );
    Route::post('/updateSelectedAlbumYoutubeLinks',[App\Http\Controllers\Admin\Main\VideoAlbumController::class,'updateSelectedAlbumYoutubeLinks'] );
    Route::post('/createNewVideoAlbum',[App\Http\Controllers\Admin\Main\VideoAlbumController::class,'createNewVideoAlbum'] );


    Route::post('/deleteSelectedAlbumImages',[App\Http\Controllers\Admin\Main\ImageGalleryController::class,'deleteSelectedAlbumImages'] );

    Route::post('/renameSelectedFolder',[App\Http\Controllers\Admin\Main\ImageGalleryController::class,'renameSelectedFolder'] );

    Route::post('/deleteSelectedFolder',[App\Http\Controllers\Admin\Main\ImageGalleryController::class,'deleteSelectedFolder'] );

    Route::post('/uploadMoreImagesAndFolders',[App\Http\Controllers\Admin\Main\ImageGalleryController::class,'uploadMoreImagesAndFolders'] );
    Route::post('/updateSelectedAlbumDetails',[App\Http\Controllers\Admin\Main\ImageGalleryController::class,'updateSelectedAlbumDetails'] );


    Route::post('/createNewCommitte',[CommitteeController::class,'createNewCommitte'] );

    // Route::post('/createNewCommission',[CommissionController::class,'createNewCommission'] );

 });

Route::namespace('App\Http\Controllers\Admin\Events')->prefix('event_admin')->middleware(['auth','auth.event'])->name('event_admin.')->group(function(){

    Route::get('event_list', 'EventAccessController@index');

        /* Event Slider Cofig Routes */
    // Route::resource('slider', SliderController::class);
   // Route::get('/slider/{event_id}', 'SliderController@index');
    Route::get('/slider/{event_id}', ['uses' => 'SliderController@index'])->name('slider_index');
    Route::get('/slider/create/{event_id}', 'SliderController@create')->name('slider_create');
    Route::get('/slider/edit/{event_id}/{slider_id}', 'SliderController@edit')->name('slider_edit');

    Route::post('/slider/destroy/{event_id}/{slider_id}',[App\Http\Controllers\Admin\Events\SliderController::class,'destroy'])->name('slider_destroy');
    Route::post('/slider/update/{event_id}/{slider_id}',[App\Http\Controllers\Admin\Events\SliderController::class,'update'])->name('slider_update');
    Route::post('/slider/store/{event_id}',[App\Http\Controllers\Admin\Events\SliderController::class,'store'])->name('slider_store');



    /* Event Profile Cofig Routes */
    //Route::resource('profile', ProfileController::class);
    Route::get('/profile/{event_id}', ['uses' => 'ProfileController@index'])->name('profile_index');

     Route::get('/profile/create/{event_id}', 'ProfileController@create')->name('profile_create');
     Route::post('/profile/store/{event_id}',[App\Http\Controllers\Admin\Events\ProfileController::class,'store'])->name('profile_store');

     Route::get('/profile/edit/{event_id}/{id}', 'ProfileController@edit')->name('profile_edit');
     Route::post('/profile/update/{event_id}/{id}',[App\Http\Controllers\Admin\Events\ProfileController::class,'update'])->name('profile_update');


  
   
     Route::post('/profile/destroy/{event_id}/{slider_id}',[App\Http\Controllers\Admin\Events\ProfileController::class,'destroy'])->name('profile_destroy');
  


 /* Event Profile Cofig Routes */
   // Route::resource('default_background', DefaultsController::class);
   Route::get('/default_background/{event_id}', ['uses' => 'DefaultsController@index'])->name('default_background_index');

    Route::post('/default_background/update/{event_id}/{default_bg_id}',[App\Http\Controllers\Admin\Events\DefaultsController::class,'update'])->name('default_background_update');

    


 /* Event News Cofig Routes */
   // Route::resource('news', EventNewsController::class);
        Route::get('/news/{event_id}', ['uses' => 'EventNewsController@index'])->name('news_index');
        Route::get('/news/create/{event_id}', 'EventNewsController@create')->name('news_create');
        Route::get('/news/edit/{event_id}/{news_id}', 'EventNewsController@edit')->name('news_edit');

        Route::post('/news/update/{event_id}/{news_id}',[App\Http\Controllers\Admin\Events\EventNewsController::class,'update'])->name('news_update');
        Route::post('/news/store/{event_id}',[App\Http\Controllers\Admin\Events\EventNewsController::class,'store'])->name('news_store');
        Route::post('/news/destroy/{event_id}/{news_id}',[App\Http\Controllers\Admin\Events\EventNewsController::class,'destroy'])->name('news_destroy');




/* Event important_pdf Cofig Routes */
  //  Route::resource('important_pdf', EventImportantPdfController::class);
  Route::get('/important_pdf/{event_id}', ['uses' => 'EventImportantPdfController@index'])->name('important_pdf_index');
  Route::get('/important_pdf/create/{event_id}', 'EventImportantPdfController@create')->name('important_pdf_create');
  Route::get('/important_pdf/edit/{event_id}/{pdf_id}', 'EventImportantPdfController@edit')->name('important_pdf_edit');

  Route::post('/important_pdf/update/{event_id}/{news_id}',[App\Http\Controllers\Admin\Events\EventImportantPdfController::class,'update'])->name('important_pdf_update');
  Route::post('/important_pdf/store/{event_id}',[App\Http\Controllers\Admin\Events\EventImportantPdfController::class,'store'])->name('important_pdf_store');
  Route::post('/important_pdf/destroy/{event_id}/{pdf_id}',[App\Http\Controllers\Admin\Events\EventImportantPdfController::class,'destroy'])->name('important_pdf_destroy');


    /* Event important_pdf Cofig Routes */
    Route::resource('album', EventAlbumController::class);
    Route::resource('album_gallery', EventImageGalleryController::class);

    // /* Event album_video Cofig Routes */
    // Route::resource('album_video', EventsVideoAlbumController::class);
    // Route::resource('video_gallery', EventsVideoController::class);

    //start of event video album routes
// Route::resource('album_video', VideoAlbumController::class);

Route::get('/album_video/{event_id}', ['uses' => 'EventsVideoAlbumController@index'])->name('album_video');
Route::get('/album_video/create/{event_id}', 'EventsVideoAlbumController@create')->name('video_album_create');
Route::get('/album_video/edit/{event_id}/{album_id}', 'EventsVideoAlbumController@edit')->name('video_album_edit');

Route::post('/album_video/destroy/{event_id}/{album_id}',[App\Http\Controllers\Admin\Events\EventsVideoAlbumController::class,'destroy'])->name('video_album_destroy');
Route::post('/album_video/update/{event_id}/{album_id}',[App\Http\Controllers\Admin\Events\EventsVideoAlbumController::class,'update'])->name('album_video_update');

Route::post('/createNewVideoAlbumEvent',[App\Http\Controllers\Admin\Events\EventsVideoAlbumController::class,'createNewVideoAlbumEvent'] );

Route::post('/updateSelectedVideoAlbumDetailsEvents',[App\Http\Controllers\Admin\Events\EventsVideoAlbumController::class,'updateSelectedVideoAlbumDetailsEvents'] );
Route::post('/updateSelectedVideoAlbumYoutubeLinksEvents',[App\Http\Controllers\Admin\Events\EventsVideoAlbumController::class,'updateSelectedVideoAlbumYoutubeLinksEvents'] );
 //end of event video album routes

 //start of event image album routes
 
    // Route::resource('album_image', AlbumController::class);

    Route::get('/album_image/{event_id}', ['uses' => 'EventAlbumController@index'])->name('album_image');
    Route::get('/album_image/create/{event_id}', 'EventAlbumController@create')->name('image_album_create');
    Route::get('/album_image/edit/{event_id}/{album_id}', 'EventAlbumController@edit')->name('image_album_edit');

    Route::post('/album_image/destroy/{event_id}/{album_id}',[App\Http\Controllers\Admin\Events\EventAlbumController::class,'destroy'])->name('image_event_album_delete');


    Route::post('/createNewImageAlbumEvent',[App\Http\Controllers\Admin\Events\EventImageGalleryController::class,'createNewImageAlbumEvent'] );  
    Route::post('/deleteSelectedAlbumImages',[App\Http\Controllers\Admin\Events\EventImageGalleryController::class,'deleteSelectedAlbumImages'] );

    Route::post('/renameSelectedFolder',[App\Http\Controllers\Admin\Events\EventImageGalleryController::class,'renameSelectedFolder'] );

    Route::post('/deleteSelectedFolder',[App\Http\Controllers\Admin\Events\EventImageGalleryController::class,'deleteSelectedFolder'] );

    Route::post('/uploadMoreImagesAndFoldersEvents',[App\Http\Controllers\Admin\Events\EventImageGalleryController::class,'uploadMoreImagesAndFoldersEvents'] );
    Route::post('/updateSelectedImageAlbumDetails',[App\Http\Controllers\Admin\Events\EventImageGalleryController::class,'updateSelectedImageAlbumDetails'] );
 
//end of event image album routes

    

    /* Event album_video Cofig Routes */
   // Route::resource('results', ResultController::class);
    Route::get('/results/{event_id}', ['uses' => 'ResultController@index'])->name('results_index');
    Route::get('/results/create/{event_id}', 'ResultController@create')->name('results_create');
    Route::get('/results/edit/{event_id}/{result_id}', 'ResultController@edit')->name('results_edit');

    Route::post('/results/update/{event_id}/{result_id}',[App\Http\Controllers\Admin\Events\ResultController::class,'update'])->name('results_update');
    Route::post('/results/store/{event_id}',[App\Http\Controllers\Admin\Events\ResultController::class,'store'])->name('results_store');
    Route::post('/results/destroy/{event_id}/{result_id}',[App\Http\Controllers\Admin\Events\ResultController::class,'destroy'])->name('results_destroy');

 });

//Start of Association admin routes ==========================================================================================================================
 Route::namespace('App\Http\Controllers\Admin\Association')->prefix('assoc_admin')->middleware(['auth','auth.assoc'])->name('assoc_admin.')->group(function(){
   Route::get('association_list', 'AccessController@index');
/* State Slider routes */
  //  Route::resource('slider', SliderController::class);
    Route::get('/slider/{assoc_id}', ['uses' => 'SliderController@index'])->name('assoc_slider_index');
    Route::get('/slider/create/{assoc_id}', 'SliderController@create')->name('assoc_slider_create');
    Route::get('/slider/edit/{assoc_id}/{slider_id}', 'SliderController@edit')->name('assoc_slider_edit');

    Route::post('/slider/destroy/{assoc_id}/{slider_id}',[App\Http\Controllers\Admin\Association\SliderController::class,'destroy'])->name('state_slider_destroy');
    Route::post('/slider/update/{assoc_id}/{slider_id}',[App\Http\Controllers\Admin\Association\SliderController::class,'update'])->name('state_slider_update');
    Route::post('/slider/store/{assoc_id}',[App\Http\Controllers\Admin\Association\SliderController::class,'store'])->name('state_slider_store');




     /*  Profile Cofig Routes */
    //    Route::resource('profile', ProfileController::class);

    Route::get('/profile/{assoc_id}', ['uses' => 'ProfileController@index'])->name('assoc_profile_index');
    Route::post('/profile/update/{assoc_id}',[App\Http\Controllers\Admin\Association\ProfileController::class,'update'])->name('assoc_profile_update');
/*  default_background Cofig Routes */
    //       Route::resource('default_background', DefaultsController::class);
    Route::get('/default_background/{assoc_id}', ['uses' => 'DefaultsController@index'])->name('state_default_background_index');
    Route::post('/default_background/update/{assoc_id}/{default_bg_id}',[App\Http\Controllers\Admin\Association\DefaultsController::class,'update'])->name('state_default_background_update');
/*  president_message Cofig Routes */
  //   Route::resource('president_message', PresidentMessageController::class);
    Route::get('/president_message/{assoc_id}', ['uses' => 'PresidentMessageController@index'])->name('president_message_index');
    Route::post('/president_message/update/{president_id}',[App\Http\Controllers\Admin\Association\PresidentMessageController::class,'update'])->name('president_message_update');
    /*  secretary_message Cofig Routes */
  //   Route::resource('secretary_message', SecretaryMessageController::class);
  Route::get('/secretary_message/{assoc_id}', ['uses' => 'SecretaryMessageController@index'])->name('secretary_message_index');
  Route::post('/secretary_message/update/{assoc_id}/{secretory_id}',[App\Http\Controllers\Admin\Association\SecretaryMessageController::class,'update'])->name('secretary_message_update');
    /*  secretary_message Cofig Routes */
  //       Route::resource('governance', GovernanceController::class);
    Route::get('/governance/{assoc_id}', ['uses' => 'GovernanceController@index'])->name('governance_index');
    Route::get('/governance/create/{assoc_id}', 'GovernanceController@create')->name('governance_create');
    Route::get('/governance/edit/{assoc_id}/{govern_id}', 'GovernanceController@edit')->name('governance_edit');

    Route::post('/governance/destroy/{govern_id}',[App\Http\Controllers\Admin\Association\GovernanceController::class,'destroy'])->name('governance_destroy');
    Route::post('/governance/update/{assoc_id}/{govern_id}',[App\Http\Controllers\Admin\Association\GovernanceController::class,'update'])->name('governance_update');
    Route::post('/governance/store/{assoc_id}',[App\Http\Controllers\Admin\Association\GovernanceController::class,'store'])->name('governance_store');


  /*  petrons Cofig Routes */
  //   Route::resource('petrons', PetronController::class);
  Route::get('/petrons/{assoc_id}', ['uses' => 'PetronController@index'])->name('petrons_index');
  Route::get('/petrons/create/{assoc_id}', 'PetronController@create')->name('petrons_create');
  Route::get('/petrons/edit/{assoc_id}/{petron_id}', 'PetronController@edit')->name('petrons_edit');

  Route::post('/petrons/destroy/{petron_id}',[App\Http\Controllers\Admin\Association\PetronController::class,'destroy'])->name('petrons_destroy');
  Route::post('/petrons/update/{assoc_id}/{petron_id}',[App\Http\Controllers\Admin\Association\PetronController::class,'update'])->name('petrons_update');
  Route::post('/petrons/store/{assoc_id}',[App\Http\Controllers\Admin\Association\PetronController::class,'store'])->name('petrons_store');
//start of state video album routes
// Route::resource('album_video', VideoAlbumController::class);

Route::get('/album_video/{assoc_id}', ['uses' => 'VideoAlbumController@index'])->name('album_video');
Route::get('/album_video/create/{assoc_id}', 'VideoAlbumController@create')->name('video_album_create');
Route::get('/album_video/edit/{assoc_id}/{album_id}', 'VideoAlbumController@edit')->name('video_album_edit');

Route::post('/album_video/destroy/{assoc_id}/{album_id}',[App\Http\Controllers\Admin\Association\VideoAlbumController::class,'destroy'])->name('video_album_destroy');
Route::post('/album_video/update/{assoc_id}/{album_id}',[App\Http\Controllers\Admin\Association\VideoAlbumController::class,'update'])->name('album_video_update');

Route::post('/createNewVideoAlbum',[App\Http\Controllers\Admin\Association\VideoAlbumController::class,'createNewVideoAlbum'] );

Route::post('/updateSelectedVideoAlbumDetails',[App\Http\Controllers\Admin\Association\VideoAlbumController::class,'updateSelectedVideoAlbumDetails'] );
Route::post('/updateSelectedVideoAlbumYoutubeLinks',[App\Http\Controllers\Admin\Association\VideoAlbumController::class,'updateSelectedVideoAlbumYoutubeLinks'] );
 //end of state video album routes

 //start of state image album routes
 
    // Route::resource('album_image', AlbumController::class);

    Route::get('/album_image/{assoc_id}', ['uses' => 'AlbumController@index'])->name('album_image');
    Route::get('/album_image/create/{assoc_id}', 'AlbumController@create')->name('image_album_create');
    Route::get('/album_image/edit/{assoc_id}/{album_id}', 'AlbumController@edit')->name('image_album_edit');

    Route::post('/album_image/destroy/{assoc_id}/{album_id}',[App\Http\Controllers\Admin\Association\AlbumController::class,'destroy'])->name('image_assoc_album_delete');


    Route::post('/createNewImageAlbum',[App\Http\Controllers\Admin\Association\ImageGalleryController::class,'createNewImageAlbum'] );  
    Route::post('/deleteSelectedAlbumImages',[App\Http\Controllers\Admin\Association\ImageGalleryController::class,'deleteSelectedAlbumImages'] );

    Route::post('/renameSelectedFolder',[App\Http\Controllers\Admin\Association\ImageGalleryController::class,'renameSelectedFolder'] );

    Route::post('/deleteSelectedFolder',[App\Http\Controllers\Admin\Association\ImageGalleryController::class,'deleteSelectedFolder'] );

    Route::post('/uploadMoreImagesAndFoldersAssoc',[App\Http\Controllers\Admin\Association\ImageGalleryController::class,'uploadMoreImagesAndFoldersAssoc'] );
    Route::post('/updateSelectedImageAlbumDetails',[App\Http\Controllers\Admin\Association\ImageGalleryController::class,'updateSelectedImageAlbumDetails'] );
 
//end of state image album routes
     /*  committees Cofig Routes */
  //       Route::resource('committees', CommitteeController::class);
  Route::get('/committees/{assoc_id}', ['uses' => 'CommitteeController@index'])->name('committees_index');
  Route::get('/committees/create/{assoc_id}', 'CommitteeController@create')->name('committees_create');
  Route::get('/committees/edit/{assoc_id}/{committee_id}', 'CommitteeController@edit')->name('committees_edit');
  Route::post('/committees/destroy/{assoc_id}/{committee_id}',[App\Http\Controllers\Admin\Association\CommitteeController::class,'destroy'])->name('committees_destroy');
  Route::post('/committees/update/{assoc_id}/{committee_id}',[App\Http\Controllers\Admin\Association\CommitteeController::class,'update'])->name('committees_update');
  Route::post('/createNewCommittee ',[App\Http\Controllers\Admin\Association\CommitteeController::class,'createNewCommittee'])->name('createNewCommittee');
  Route::post('/committees/store/{assoc_id}',[App\Http\Controllers\Admin\Association\CommitteeController::class,'store'])->name('committees_store');
  Route::get('/getAllMembersForSelectedCommittee/{comm_id}', [App\Http\Controllers\Admin\Association\CommitteeController::class, 'getAllMembersForSelectedCommittee']);
  Route::post('/updateCommittee',[App\Http\Controllers\Admin\Association\CommitteeController::class,'updateCommittee'] );
  Route::post('/updateCommitteeMembers',[App\Http\Controllers\Admin\Association\CommitteeController::class,'updateCommitteeMembers'] );

 /*  committee_member Cofig Routes */
  //       Route::resource('committee_member', CommitteeMemberController::class);

    Route::get('/committee_member/{assoc_id}', ['uses' => 'CommitteeMemberController@index'])->name('committee_member_index');
    Route::get('/committee_member/create/{assoc_id}', 'CommitteeMemberController@create')->name('committee_member_create');
    Route::get('/committee_member/edit/{assoc_id}/{committee_member_id}', 'CommitteeMemberController@edit')->name('committee_member_edit');

    Route::post('/committee_member/destroy/{assoc_id}/{committee_member_id}',[App\Http\Controllers\Admin\Association\CommitteeMemberController::class,'destroy'])->name('committee_member_destroy');
    Route::post('/committee_member/update/{assoc_id}/{committee_member_id}',[App\Http\Controllers\Admin\Association\CommitteeMemberController::class,'update'])->name('committee_member_update');
    Route::post('/committee_member/store/{assoc_id}',[App\Http\Controllers\Admin\Association\CommitteeMemberController::class,'store'])->name('committee_member_store');

 

    /*  documents Cofig Routes */
  //     Route::resource('documents', DocumentController::class);

  Route::get('/documents/{assoc_id}', ['uses' => 'DocumentController@index'])->name('documents_index');
  Route::get('/documents/create/{assoc_id}', 'DocumentController@create')->name('documents_create');

  Route::post('/documents/destroy/{assoc_id}/{document_id}',[App\Http\Controllers\Admin\Association\DocumentController::class,'destroy'])->name('documents_destroy');
  Route::post('/documents/store/{assoc_id}',[App\Http\Controllers\Admin\Association\DocumentController::class,'store'])->name('documents_store');

/*  news Cofig Routes */
  //     Route::resource('news', NewsController::class);
  Route::get('/news/{assoc_id}', ['uses' => 'NewsController@index'])->name('state_news_index');
  Route::get('/news/create/{assoc_id}', 'NewsController@create')->name('state_news_create');
  Route::get('/news/edit/{assoc_id}/{news_id}', 'NewsController@edit')->name('state_news_edit');

  Route::post('/news/destroy/{assoc_id}/{news_id}',[App\Http\Controllers\Admin\Association\NewsController::class,'destroy'])->name('state_news_destroy');
  Route::post('/news/update/{assoc_id}/{news_id}',[App\Http\Controllers\Admin\Association\NewsController::class,'update'])->name('state_news_update');
  Route::post('/news/store/{assoc_id}',[App\Http\Controllers\Admin\Association\NewsController::class,'store'])->name('state_news_store');




    /*  event Cofig Routes */
  // Route::resource('event', EventController::class);
  Route::get('/event/{assoc_id}', ['uses' => 'EventController@index'])->name('event_index');
  Route::get('/event/create/{assoc_id}', 'EventController@create')->name('event_create');
  Route::get('/event/edit/{assoc_id}/{event_id}', 'EventController@edit')->name('event_edit');

  Route::post('/event/destroy/{assoc_id}/{event_id}',[App\Http\Controllers\Admin\Association\EventController::class,'destroy'])->name('event_destroy');
  Route::post('/event/update/{assoc_id}/{event_id}',[App\Http\Controllers\Admin\Association\EventController::class,'update'])->name('event_update');
  Route::post('/event/store/{assoc_id}',[App\Http\Controllers\Admin\Association\EventController::class,'store'])->name('event_store');

  Route::get('/district_association/{assoc_id}', ['uses' => 'DistrictController@index'])->name('district_association_index');
  Route::get('/district_association/create/{assoc_id}', 'DistrictController@create')->name('district_association_create');
  Route::get('/district_association/edit/{assoc_id}/{dist_id}', 'DistrictController@edit')->name('district_association_edit');

  Route::post('/district_association/destroy/{assoc_id}/{dist_id}',[App\Http\Controllers\Admin\Association\DistrictController::class,'destroy'])->name('state_dist_destroy');
  Route::post('/district_association/update/{assoc_id}/{dist_id}',[App\Http\Controllers\Admin\Association\DistrictController::class,'update'])->name('state_dist_update');
  Route::post('/district_association/store/{assoc_id}',[App\Http\Controllers\Admin\Association\DistrictController::class,'store'])->name('assoc_district_association');
    //Route::resource('district_association', DistrictController::class);

    Route::get('/other_association/{assoc_id}', ['uses' => 'OtherController@index'])->name('other_association_index');
    Route::get('/other_association/create/{assoc_id}', 'OtherController@create')->name('other_association_create');
    Route::get('/other_association/edit/{assoc_id}/{other_id}', 'OtherController@edit')->name('other_association_edit');

    Route::post('/other_association/destroy/{assoc_id}/{other_id}',[App\Http\Controllers\Admin\Association\OtherController::class,'destroy'])->name('state_other_destroy');
    Route::post('/other_association/update/{assoc_id}/{other_id}',[App\Http\Controllers\Admin\Association\OtherController::class,'update'])->name('state_other_update');
    Route::post('/other_association/store/{assoc_id}',[App\Http\Controllers\Admin\Association\OtherController::class,'store'])->name('assoc_other_association');
   // Route::resource('other_association', OtherController::class);

    // Route::resource('album_image', AlbumController::class);
    // Route::resource('image_gallery', ImageGalleryController::class);
    // Route::resource('album_video', VideoAlbumController::class);
    // Route::resource('video_gallery', VideoController::class);
 });
//End of Association admin routes