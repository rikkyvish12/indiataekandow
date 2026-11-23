<?php

namespace App\Providers;

use App\Models\Defaults;
use App\Models\Committee;
use App\Models\News;
use App\Models\Education;
use App\Models\MainProfile;
use App\Models\AssociationProfile;
use App\Models\DefaultAssociation;
use App\Models\DefaultEvents;
use App\Models\Association;
use App\Models\AssociationType;
use App\Models\Districts;
use App\Models\States;
use App\Models\AssociationCommittee;
use App\Models\EventProfile;
use App\Models\RulesAndRegulations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use DB;
use App\Models\Events;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        Schema::defaultStringLength(191);
        view()->share('no', '1');
        view()->share('no1', '1');
        view()->share('no2', '1');
        view()->share('eventprofile', EventProfile::orderBy('created_at','desc')->first());
        view()->share('profile', MainProfile::orderBy('created_at','desc')->first());
        view()->share('latest_news', News::latest()->take(4)->get());
        view()->share('education',Education::orderBy('created_at','desc')->get());
        view()->share('defaults',Defaults::orderBy('created_at','desc')->first());
        view()->share('committee',Committee::orderBy('created_at','desc')->get());
        view()->share('rules',RulesAndRegulations::orderBy('created_at','desc')->get());
       // view()->share('state_profile',AssociationProfile::orderBy('created_at','desc')->first());
        view()->share('assoc_defaults',DefaultAssociation::orderBy('created_at','desc')->first());
        view()->share('event_defaults',DefaultEvents::orderBy('created_at','desc')->first());
        view()->share('committee',AssociationCommittee::orderBy('created_at','desc')->get());

        view()->composer('*', function ($view) 
        {
            if (Auth::check()){
                view()->share('access',true);
            if(Auth::user()->role == 'association'){
                view()->share('assoc_type','');
                view()->share('assoc_name','');
            if(isset(Route::getCurrentRoute()->parameters['assoc_id'])){
             $assoc_id = Route::getCurrentRoute()->parameters['assoc_id'];
             $assoc = Association::where('id',$assoc_id)->first();
             $user_access = $assoc->user_access;
             $array = explode(',', $user_access);

             if(in_array(Auth::user()->id,$array))
            {
                view()->share('access',true);
            }else{
             view()->share('access',false);
            }
           
             $assoc_type = AssociationType::where('id',$assoc->assoc_type_id)->pluck('name')[0];

             if($assoc->assoc_type_id == 1){
                $state_name = States::where('id',$assoc->state_id)->value('name');
                view()->share('assoc_type',$assoc_type);
                view()->share('state_name',$state_name);
                view()->share('assoc_name',$assoc->name);
             }elseif($assoc->assoc_type_id == 2){
             $district_name = Districts::where('id',$assoc->district_id)->pluck('name')[0];
             $state_name = States::where('id',$assoc->state_id)->pluck('name')[0];
              view()->share('assoc_type',$assoc_type);
              view()->share('district_name',$district_name);
              view()->share('state_name',$state_name);
              view()->share('assoc_name',$assoc->name);
             }elseif($assoc->assoc_type_id == 3){
                view()->share('assoc_type',$assoc_type);
                view()->share('assoc_name',$assoc->name);
             }

           }

         
             
            }elseif(Auth::user()->role == 'event'){
                if(isset(Route::getCurrentRoute()->parameters['event_id'])){
                   $event_id = Route::getCurrentRoute()->parameters['event_id'];
                   $event = Events::where('id',$event_id)->first();
                   $user_access = $event->user_access;
                   $array = explode(',', $user_access);
                   if(in_array(Auth::user()->id,$array))
                   {
                       view()->share('access',true);
                   }else{
                       view()->share('access',false);
                   }
                   if($event->assoc_id != null)
                   {
                     // $assoc = Associations::where('id',$event->assoc_id)->first();
                      view()->share('event_type',"Association Event");
                      view()->share('event',$event);
                   }else{
                      view()->share('event_type',"Primary Event");
                      view()->share('event',$event);
                   }

                }
            }
        }  
        });

        
       
       


    }
  
}
