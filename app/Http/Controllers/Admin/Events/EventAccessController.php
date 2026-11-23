<?php

namespace App\Http\Controllers\Admin\Events;

use Illuminate\Http\Request;
use App\Models\DefaultEvents;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
class EventAccessController extends Controller
{
   
    public function index()
    {
        $user_id = Auth::user()->id;
        
         $events = DB::table('events')->whereRaw('FIND_IN_SET('.$user_id.',user_access)')->get();
        
        return view('pages.admin.event.event_list')->with('events',$events);
    }
}