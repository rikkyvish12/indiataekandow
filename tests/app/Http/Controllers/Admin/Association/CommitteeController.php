<?php

namespace App\Http\Controllers\Admin\Association;

use Illuminate\Http\Request;
use App\Models\AssociationCommittee;
use App\Models\AssociationCommitteeMember;
use App\Models\Association;
use App\Models\AssociationType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommitteeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($assoc_id)
    {
        return view('pages.admin.association.committee.index')->with('assoc_id',$assoc_id)->with('committee',AssociationCommittee::orderBy('created_at','desc')->where('assoc_id','=',$assoc_id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($assoc_id)
    {
        return view('pages.admin.association.committee.create')->with('assoc_id',$assoc_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createNewCommittee(Request $request)
    {
        // dd($request->all());
        // $committee=new AssociationCommittee;
        // $committee->name=$request->input('name');
        // $committee->assoc_id=$assoc_id;
        // $committee->save();
        // return redirect(route('assoc_admin.committees_index',$assoc_id))->with('success','Committee Added Successfully');
        try{
            $temp_member_id= 0;
            $images = $request->file('file');  
            $committeeMembers = json_decode($request->input('committeeMember'),true); 
            $file_details_object = $request->input('files_info');  
            $file_details = json_decode($file_details_object,true);
            $assoc_id = $request->input('assoc_id');  
 
    
            $committee=new AssociationCommittee;
            $committee->name=$request->input('committee_name');
            $committee->assoc_id=$assoc_id;
            $committee->save();
    
            $destination_path =NULL;
            $assoc = Association::where('id','=',$assoc_id)->first();
            $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
            $final_assoc_type=str_replace('_association', '', $assoc_type);
            $destination_path = 'storage/association/'. $final_assoc_type.'/'.$assoc_id.'/committee_member/'; 

            foreach($committeeMembers as $member){
                // dd($member['id']);
               
                $create_member=new AssociationCommitteeMember;
                $create_member->assoc_id=$assoc_id;
                $create_member->committee_id=$committee->id;                
                $create_member->name=$member['member_name'];;
                $create_member->designation=$member['member_designation'];          
                $create_member->position =$member['member_position'];

                $create_member->save();
    
                
    // dd($file_details);
                foreach($file_details as $file_detail){
                    if($file_detail['parent_id'] == $member['id'] ){
                     foreach($images as $image){ 
                        if($image->getClientOriginalName() == $file_detail['name']){ 
                                $filename = $image->getClientOriginalName();

                                // $destination_path = 'storage/association/state/'.$assoc_id.'/committee_member/'.$create_member->id;                      
                                $image->move($destination_path.$create_member->id.'/',$filename);
    
                                $create_member=AssociationCommitteeMember::find($create_member->id);
                                $create_member->image = '/'.$destination_path.$create_member->id.'/'.$filename;
                            } 
                        }
                    }
                    
                       
                }
                 $create_member->save();
             
                
               
            } 
           
                $final['status']="success";
                return json_encode($final);
            
        }catch(Exception $e) {
            $final['status']="unsuccess";
            return json_encode($final);
          }
        
    

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
        $committee= AssociationCommittee::find($id);
        $members = AssociationCommitteeMember::where('committee_id','=',$committee->id)->get();
        return view('pages.admin.association.committee.edit')->with('assoc_id',$assoc_id)->with(['committee'=>$committee,'member_count'=>count($members)]);

        // return view()->with('assoc_id',$assoc_id)->with('committee',AssociationCommittee::find($id));

    }
    public function getAllMembersForSelectedCommittee($comm_id){
        $members = AssociationCommitteeMember::where('committee_id','=',$comm_id)->orderBy('position')->get();
        return json_encode($members);
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
        // $committee= AssociationCommittee::find($id);
        // $committee->name=$request->input('name');
        // $committee->save();
        // return redirect(route('assoc_admin.committees_index',$assoc_id))->with('assoc_id',$assoc_id)->with('success','Committee Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateCommittee(Request $request){
        $selected_committee_id = $request->input('selected_committee_id');
        $committee_name = $request->input('committee_name');

        $committee = AssociationCommittee::find($selected_committee_id);
        $committee->name = $committee_name;

        $is_updated= $committee->save();

        if($is_updated){
            $final['status'] ="success";
            return json_encode($final);
        }else{
            $final['status'] ="unsuccess";
            return json_encode($final);
        }
    }
    public function updateCommitteeMembers(Request $request){
        
    try{
        // dd($request->all()); 
        
        $message= "";
        $temp_member_id= 0;
        $selected_committee_id= $request->input('selected_committee_id');
        $assoc_id= $request->input('assoc_id');

        $final_updation= array();

        $check_member_removed=false;
        $inside_member_remove=0;
        $member_removed_array=array();
        
        $check_existing_member_updatation=false;
        $inside_existing_member_updatation=0;           
        $existing_member_array=array();

        $check_existing_member_updatation_with_images =false;
        $inside_existing_member_updatation_with_images = 0;
        $existing_member_with_images_array=array();

        $check_new_member_added=false;
        $inside_new_member_added=0;
        $new_member_added_array=array();

        $destination_path =NULL;
        $assoc = Association::where('id','=',$assoc_id)->first();
        $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
        $final_assoc_type=str_replace('_association', '', $assoc_type);
        $destination_path = 'storage/association/'. $final_assoc_type.'/'.$assoc_id.'/committee_member/'; 


        if($request->has('removedExistingMemberIds')){   //any existing member removed
            $removedExistingMemberIds = json_decode($request->input('removedExistingMemberIds'),true); 
            foreach($removedExistingMemberIds as $member){
                $committee_member = AssociationCommitteeMember::find($member['id']);
                
                if($committee_member){
                    $path = ltrim($committee_member->image, '/');
                    // dd($path);
                    if(\File::exists($path))
                    {
                        // echo" if";
                        // dd($path);
                        \File::delete($path);  
                    }
                    $check_member_removed = $committee_member->delete();
                }else{
                    array_push($member_removed_array, ($member['name']));
                }
                

                
             }
             $inside_member_remove = 1;
             
             array_push($final_updation, 'Existing Member Removed');

        }

        if($request->has('existingCommitteeMember') && !$request->has('existing_member_files_info')){   //any existing member updated with no images changed
            
            // dd($request->all());
            $existingCommitteeMembers = json_decode($request->input('existingCommitteeMember'),true);

            foreach($existingCommitteeMembers as $member){
                $update_committee_member = AssociationCommitteeMember::find($member['id']);
                $update_committee_member->name= $member['name'];
                $update_committee_member->image= $member['image'];
                $update_committee_member->position= $member['position'];
                $update_committee_member->designation= $member['designation'];
                $check_existing_member_updatation=  $update_committee_member->save();

                if(!$check_existing_member_updatation){
                    // $existing_member_array.push($member['name']);
                    array_push($existing_member_array, ($member['name']));

                }
            }
            $inside_existing_member_updatation=1;
            
            array_push($final_updation, 'Existing Member Updated');


        }

     

        if($request->has('existingCommitteeMember') && $request->has('existing_member_files_info')){  //any existing member updated with  images update
            
            $existingCommitteeMember = json_decode($request->input('existingCommitteeMember'),true); 

            $existingFile = $request->file('existingFile');  
            $existing_member_files_info_object = $request->input('existing_member_files_info');  
            $existing_member_files_details = json_decode($existing_member_files_info_object,true); 

            foreach($existingCommitteeMember as $member){
                

                if($member['image'] == ""){

                    foreach($existing_member_files_details as $file_detail){
                        if($file_detail['parent_id'] == $member['id'] ){
                         foreach($existingFile as $image){ 
                            if($image->getClientOriginalName() == $file_detail['name']){ 
                                    $filename = $image->getClientOriginalName();
                                    // $destination_path = 'storage/association/state/'.$assoc_id.'/committee_member/'.$selected_committee_id;                      

                                    // $destination_path = 'storage/main/committee_member/'.$member['id'];                      
                                    $image->move($destination_path.$selected_committee_id.'/',$filename);
        
                                    $update_committee_member=AssociationCommitteeMember::find($member['id']);
                                    $update_committee_member->name= $member['name'];
                                    $update_committee_member->position= $member['position'];
                                    $update_committee_member->designation= $member['designation'];
                                    $update_committee_member->image = '/'.$destination_path.$selected_committee_id.'/'.$filename;
                                    $check_existing_member_updatation_with_images=  $update_committee_member->save();
                                    
                                    if(!$check_existing_member_updatation_with_images){
                                        // $existing_member_with_images_array.push($member['name']);
                                        array_push($existing_member_with_images_array, ($member['name']));

                                    }
                                    
                                } 
                            }
                        }
                        
                           
                    }
                }else{
                    $update_committee_member = AssociationCommitteeMember::find($member['id']);
                    $update_committee_member->name= $member['name'];
                    $update_committee_member->position= $member['position'];
                    $update_committee_member->designation= $member['designation'];
                    $update_committee_member->image= $member['image'];
                    $check_existing_member_updatation=  $update_committee_member->save();
                                    
                    if(!$check_existing_member_updatation_with_images){
                    //  $existing_member_with_images_array.push($member['name']);
                    array_push($existing_member_with_images_array, ($member['name']));

                    }
                  
                   

                }
                
               
                
            }
            $inside_existing_member_updatation_with_images=1;
            array_push($final_updation, 'Existing Member Updated With Image Change');

        }


        
        if($request->has('committeeMember') && $request->hasFile('file')){      // add new members 
            $images = $request->file('file');  
            $file_details_object = $request->input('files_info');  
            $file_details = json_decode($file_details_object,true); 
            $committeeMembers = json_decode($request->input('committeeMember'),true); 

            foreach($committeeMembers as $member){
                // dd($member['id']);
               
                $create_member=new AssociationCommitteeMember;
                $create_member->committee_id=$selected_committee_id;
                $create_member->assoc_id=$assoc_id;
                $create_member->name=$member['member_name'];;
                $create_member->designation=$member['member_designation'];          
                $create_member->position =$member['member_position'];
                $create_member->save();
    
                
    // dd($file_details);
                foreach($file_details as $file_detail){
                    if($file_detail['parent_id'] == $member['id'] ){
                     foreach($images as $image){ 
                        if($image->getClientOriginalName() == $file_detail['name']){ 
                                $filename = $image->getClientOriginalName();
                                // $destination_path = 'storage/association/state/'.$assoc_id.'/committee_member/'.$selected_committee_id;                      
                                $image->move($destination_path.$selected_committee_id.'/',$filename);
    
                                $create_member=AssociationCommitteeMember::find($create_member->id);
                                $create_member->image = '/'.$destination_path.'/'.$filename;
                            } 
                        }
                    }
                    
                       
                }
                $check_new_member_added =  $create_member->save();
                if(!$check_new_member_added){
                    // $new_member_added_array.push($member['name']);
                    array_push($new_member_added_array, ($member['name']));

                   }
                
               
            } 
            $inside_new_member_added=1;
            array_push($final_updation, 'New Member Added');

        }
        
        
        if($inside_member_remove == 1){
            $final['member_removed_array'] = json_encode($member_removed_array);
            $final['inside_member_remove'] = 1;
        }

        if($inside_existing_member_updatation == 1){
            // dd("inside existing");
            $final['existing_member_array'] =  json_encode($existing_member_array);
            $final['inside_existing_member_updatation'] = 1;

        }


        if($inside_existing_member_updatation_with_images == 1){
            $final['existing_member_with_images_array'] =  json_encode($existing_member_with_images_array);
            $final['inside_existing_member_updatation_with_images'] = 1;

        }
        
        if($inside_new_member_added == 1){
            $final['new_member_added_array'] =  json_encode($new_member_added_array);
            $final['inside_new_member_added'] = 1;

        }

        $final['final_updation'] = json_encode($final_updation);
      
        return json_encode($final);
    
        }catch(Exception $e) {
            $final['status']="unsuccess";
            return json_encode($final);
        }
       
    }
    public function destroy($assoc_id,$id)
    {
        $committee= AssociationCommittee::find($id);


        $assoc = Association::where('id','=',$assoc_id)->first();
        $assoc_type = AssociationType::where('id','=',$assoc->assoc_type_id )->value('name');
        $final_assoc_type=str_replace('_association', '', $assoc_type);
        $path = 'storage/association/'. $final_assoc_type.'/'.$assoc_id.'/committee_member/'.$id; 

      
        // dd($path);
       if(\File::exists($path))
       {
         \File::deleteDirectory($path);
       }

        AssociationCommitteeMember::where('committee_id','=',$committee->id)->delete();

        $committee->delete();
        return redirect(route('assoc_admin.committees_index',$assoc_id))->with('success','Committee Deleted Successfully');

    }
}
