<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\Commission;
use Illuminate\Http\Request;
use App\Models\CommissionMember;
use App\Http\Controllers\Controller;

class CommissionMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = CommissionMember::orderBy('created_at','desc')->get();

        foreach($member as $value){
            $value['commission'] = Commission::where('id','=',$value['commission_id'])->value('name');
        }
       return view('pages.admin.main.commissionmember.index')->with('member',$member);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.main.commissionmember.create')->with('commission',Commission::orderBy('created_at','desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $member=new CommissionMember;
         $member->commission_id=$request->input('commission');
         $member->name=$request->input('name');
         $member->designation=$request->input('designation');
        //  $member->position=$request->input('position');
        if( $member->position == $request->input('position')){
            $member->position=$request->input('position');

        }else{
            // dd("in else");
            $positions =  CommissionMember::where('commission_id','=',$request->input('commission'))
                            ->where('position', '!=' , $member->position )
                            ->pluck('position')
                            ->toArray();
            // dd($positions);
            $temp_pos= $request->input('position');
            // dd($temp_pos);
            if(in_array($temp_pos , $positions)){
                return redirect()->back()->with('error','CommissionMember with specified position already exist in selected commmittee')->withInput();

            }else{
                $member->position=$request->input('position');
            }
        }
         $member->save();
        $member = CommissionMember::find($member->id);
         if($request->hasFile('image'))
         {
             $image = $member->id.'.'.request()->image->getClientOriginalExtension();
             request()->image->move('storage/main/commission_member/', $image);
             $member->image='/storage/main/commission_member/'.$image;
         }
         $member->save();

         return redirect(route('admin.commission_member.index'))->with('success','Member Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.admin.main.commissionmember.edit')->with(['commission'=>Commission::orderBy('created_at','desc')->get(),'member'=>CommissionMember::find($id)]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
   
    public function update(Request $request, $id)   
    {
        $member= CommissionMember::find($id);

        $member->commission_id = $request->input('commission');
        $member->name=$request->input('name');
        $member->designation=$request->input('designation');
        
        // $member->position=$request->input('position');

        if( $member->position == $request->input('position')){
            $member->position=$request->input('position');

        }else{
            // dd("in else");
            $positions =  CommissionMember::where('commission_id','=',$request->input('commission'))
                            ->where('position', '!=' , $member->position )
                            ->pluck('position')
                            ->toArray();
            // dd($positions);
            $temp_pos= $request->input('position');
            // dd($temp_pos);
            if(in_array($temp_pos , $positions)){
                return redirect()->back()->with('error','CommissionMember with specified position already exist in selected commmittee')->withInput();

            }else{
                $member->position=$request->input('position');
            }
        }
        if($request->hasFile('image'))
        {
            $image = $id.'.'.request()->image->getClientOriginalExtension();
            request()->image->move('storage/main/commission_member/', $image);
            $member->image='/storage/main/commission_member/'.$image;
        }
        $member->save();

        return redirect(route('admin.commission_member.index'))->with('success','Member Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member= CommissionMember::find($id);

        $member->delete();

        return redirect(route('admin.commission_member.index'))->with('success','Member Deleted Successfully');

    }
}
