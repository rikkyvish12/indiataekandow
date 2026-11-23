<?php

namespace App\Http\Controllers\Admin\Association;

use Illuminate\Http\Request;
use App\Models\DefaultEvents;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Models\States;
use App\Models\Districts;

class AccessController extends Controller
{
   
    public function index()
    {
        $user_id = Auth::user()->id;
        
         $assoc = DB::table('associations')->whereRaw('FIND_IN_SET('.$user_id.',user_access)')->get();
         foreach ($assoc as $value) {
             if($value->assoc_type_id == 1){
                $value->sub_info = 'State Association->'.States::where('id',$value->state_id)->value('name');
             }elseif($value->assoc_type_id == 2){
                $value->sub_info = 'District Association->'.Districts::where('id',$value->district_id)->value('name').','.States::where('id',$value->state_id)->value('name');
             }else{
                $value->sub_info = 'Other Association';
   
             }
            
         }
        return view('pages.admin.association.assoc_list')->with('assoc',$assoc);
    }
}