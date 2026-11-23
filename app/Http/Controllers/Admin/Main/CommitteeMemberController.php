<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\Committee;
use Illuminate\Http\Request;
use App\Models\CommitteeMember;
use App\Http\Controllers\Controller;

class CommitteeMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = CommitteeMember::orderBy('created_at','desc')->get();

        foreach($member as $value){
            $value['committee'] = Committee::where('id','=',$value['committee_id'])->value('name');
        }
       return view('pages.admin.main.committeemember.index')->with('member',$member);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.main.committeemember.create')->with('committee',Committee::orderBy('created_at','desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $member=new CommitteeMember;
         $member->committee_id=$request->input('committee');
         $member->name=$request->input('name');
         $member->designation=$request->input('designation');
        //  $member->position=$request->input('position');
        if( $member->position == $request->input('position')){
            $member->position=$request->input('position');

        }else{
            // dd("in else");
            $positions =  CommitteeMember::where('committee_id','=',$request->input('committee'))
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
         $member->save();
        $member = CommitteeMember::find($member->id);
         if($request->hasFile('image'))
         {
             $image = $member->id.'.'.request()->image->getClientOriginalExtension();
             request()->image->move('storage/main/committee_member/', $image);
             $member->image='/storage/main/committee_member/'.$image;
         }
         $member->save();

         return redirect(route('admin.committee_member.index'))->with('success','Member Added Successfully');

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
        return view('pages.admin.main.committeemember.edit')->with(['committee'=>Committee::orderBy('created_at','desc')->get(),'member'=>CommitteeMember::find($id)]);

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
        $member= CommitteeMember::find($id);

        $member->committee_id = $request->input('committee');
        $member->name=$request->input('name');
        $member->designation=$request->input('designation');
        
        // $member->position=$request->input('position');

        if( $member->position == $request->input('position')){
            $member->position=$request->input('position');

        }else{
            // dd("in else");
            $positions =  CommitteeMember::where('committee_id','=',$request->input('committee'))
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
            $image = $id.'.'.request()->image->getClientOriginalExtension();
            request()->image->move('storage/main/committee_member/', $image);
            $member->image='/storage/main/committee_member/'.$image;
        }
        $member->save();

        return redirect(route('admin.committee_member.index'))->with('success','Member Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member= CommitteeMember::find($id);

        $member->delete();

        return redirect(route('admin.committee_member.index'))->with('success','Member Deleted Successfully');

    }
}
