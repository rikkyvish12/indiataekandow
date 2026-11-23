<?php

namespace App\Http\Controllers\Admin\Association;

use Illuminate\Http\Request;
use App\Models\AssociationCommittee;
use App\Models\Association;
use App\Http\Controllers\Controller;
use App\Models\AssociationCommitteeMember;
use Illuminate\Support\Facades\Auth;

class CommitteeMemberController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($assoc_id)
    {
      $member= AssociationCommitteeMember::orderBy('created_at','desc')->where('assoc_id','=',$assoc_id)->get();
        foreach($member as $value){
            $value['committee'] = AssociationCommittee::where('id','=',$value['committee_id'])->value('name');
        }
       return view('pages.admin.association.committeemember.index')->with('assoc_id',$assoc_id)->with('member',$member);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($assoc_id)
    {
        return view('pages.admin.association.committeemember.create')->with('assoc_id',$assoc_id)->with('committee',AssociationCommittee::orderBy('created_at','desc')->where('assoc_id','=',$assoc_id)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$assoc_id)
    {

        $member=new AssociationCommitteeMember;
         $member->committee_id=$request->input('committee');
         $member->assoc_id=$assoc_id;
         $member->name=$request->input('name');
         $member->designation=$request->input('designation');
        //  $member->position=$request->input('position');

        if( $member->position == $request->input('position')){
            $member->position=$request->input('position');

        }else{
            // dd("in else");
            $positions =  AssociationCommitteeMember::where('committee_id','=',$request->input('committee'))
                            ->where('position', '!=' , $member->position )
                            ->pluck('position')
                            ->toArray();
            // dd($positions);
            $temp_pos= $request->input('position');
            // dd($temp_pos);
            if(in_array($temp_pos , $positions)){
                return redirect()->back()->with('error','CommitteeMember with specified position already exist in selected commmittee')->withInput();

            }else{
              $member->position=$request->input('position');
            }
        }

         if($request->hasFile('image'))
         {
             $image = time().'.'.request()->image->getClientOriginalExtension();
             request()->image->move('committee_member_image/', $image);
             $member->image='/committee_member_image/'.$image;
         }
         $member->save();

         return redirect(route('assoc_admin.committee_member_index',$assoc_id))->with('success','Member Added Successfully');

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
    public function edit($assoc_id,$id)
    {
        return view('pages.admin.association.committeemember.edit')->with('assoc_id',$assoc_id)->with(['committee'=>AssociationCommittee::orderBy('created_at','desc')->where('assoc_id','=',$assoc_id)->get(),'member'=>AssociationCommitteeMember::find($id)]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$assoc_id, $id)
    {
        $member= AssociationCommitteeMember::find($id);
        $member->committee_id=$request->input('committee');
        $member->name=$request->input('name');
        $member->designation=$request->input('designation');
        // $member->position=$request->input('position');

        if( $member->position == $request->input('position')){
            $member->position=$request->input('position');

        }else{
            // dd("in else");
            $positions =  AssociationCommitteeMember::where('committee_id','=',$request->input('committee'))
                            ->where('position', '!=' , $member->position )
                            ->pluck('position')
                            ->toArray();
            // dd($positions);
            $temp_pos= $request->input('position');
            // dd($temp_pos);
            if(in_array($temp_pos , $positions)){
                return redirect()->back()->with('error','CommitteeMember with specified position already exist in selected commmittee')->withInput();

            }else{
              $member->position=$request->input('position');
            }
        }

        if($request->hasFile('image'))
        {
            $image = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move('committee_member_image/', $image);
            $member->image='/committee_member_image/'.$image;
        }
        $member->save();

        return redirect(route('assoc_admin.committee_member_index',$assoc_id))->with('success','Member Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($assoc_id,$id)
    {
        $member= AssociationCommitteeMember::find($id);

        $member->delete();
        return redirect()->back()->with('success','Member Deleted Successfully');


    }
}
