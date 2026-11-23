<?php

namespace App\Http\Controllers\Admin\Main;

use App\Models\Commission;
use App\Models\CommissionMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.main.commission.index')->with('commission',Commission::orderBy('created_at','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.main.commission.create');
    }

    public function createNewCommission(Request $request)
    {
    //    dd($request->all());
    try{
        $temp_member_id= 0;
        $images = $request->file('file');  
        $commissionMembers = json_decode($request->input('commissionMember'),true); 
        $file_details_object = $request->input('files_info');  
        $file_details = json_decode($file_details_object,true); 

        $commission=new Commission;
        $commission->name=$request->input('commission_name');
        $commission->save();

        foreach($commissionMembers as $member){
            // dd($member['id']);
           
            $create_member=new CommissionMember;
            $create_member->commission_id=$commission->id;
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
                            $destination_path = 'storage/main/commission_member/'.$create_member->id;                      
                            $image->move($destination_path.'/',$filename);

                            $create_member=CommissionMember::find($create_member->id);
                            $create_member->image = '/'.$destination_path.'/'.$filename;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $commission=new Commission;
        $commission->name=$request->input('name');
        $commission->save();
        return redirect(route('admin.commission.index'))->with('success','Commission Added Successfully');

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
        $commission= Commission::find($id);
        $members = CommissionMember::where('commission_id','=',$commission->id)->get();
        return view('pages.admin.main.commission.edit')->with(['commission'=>$commission,'member_count'=>count($members)]);

    }

    public function getAllMembersForSelectedCommission($comm_id){
        $members = CommissionMember::where('commission_id','=',$comm_id)->orderBy('position')->get();
        return json_encode($members);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $commission= Commission::find($id);
    //     $commission->name=$request->input('name');
    //     $commission->save();
    //     return redirect(route('admin.commission.index'))->with('success','Commission Updated Successfully');

    // }
        public function updateCommission(Request $request){
            $selected_commission_id = $request->input('selected_commission_id');
            $commission_name = $request->input('commission_name');

            $commission = Commission::find($selected_commission_id);
            $commission->name = $commission_name;

            $is_updated= $commission->save();

            if($is_updated){
                $final['status'] ="success";
                return json_encode($final);
            }else{
                $final['status'] ="unsuccess";
                return json_encode($final);
            }
        }
        public function updateCommissionMembers(Request $request){
            
        try{
            // dd($request->all()); 
            
            $message= "";
            $temp_member_id= 0;
            $selected_commission_id= $request->input('selected_commission_id');
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


            if($request->has('removedExistingMemberIds')){   //any existing member removed
                $removedExistingMemberIds = json_decode($request->input('removedExistingMemberIds'),true); 
                foreach($removedExistingMemberIds as $member){
                    $commission_member = CommissionMember::find($member['id']);
                    if($commission_member){
                        $path = ltrim($commission_member->image, '/');
                    // dd($path);
                        if(\File::exists($path))
                        {
                            // echo" if";
                            // dd($path);
                            \File::delete($path);  
                        }
                        $check_member_removed = $commission_member->delete();
                    }else{
                        array_push($member_removed_array, ($member['name']));
                    }
                    

                    
                 }
                 $inside_member_remove = 1;
                 
                 array_push($final_updation, 'Existing Member Removed');

            }

            if($request->has('existingCommissionMember') && !$request->has('existing_member_files_info')){   //any existing member updated with no images changed
                
                // dd($request->all());
                $existingCommissionMembers = json_decode($request->input('existingCommissionMember'),true);

                foreach($existingCommissionMembers as $member){
                    $update_commission_member = CommissionMember::find($member['id']);
                    $update_commission_member->name= $member['name'];
                    $update_commission_member->image= $member['image'];
                    $update_commission_member->position= $member['position'];
                    $update_commission_member->designation= $member['designation'];
                    $check_existing_member_updatation=  $update_commission_member->save();

                    if(!$check_existing_member_updatation){
                        // $existing_member_array.push($member['name']);
                        array_push($existing_member_array, ($member['name']));

                    }
                }
                $inside_existing_member_updatation=1;
                
                array_push($final_updation, 'Existing Member Updated');


            }

         

            if($request->has('existingCommissionMember') && $request->has('existing_member_files_info')){  //any existing member updated with  images update
                
                $existingCommissionMember = json_decode($request->input('existingCommissionMember'),true); 

                $existingFile = $request->file('existingFile');  
                $existing_member_files_info_object = $request->input('existing_member_files_info');  
                $existing_member_files_details = json_decode($existing_member_files_info_object,true); 

                foreach($existingCommissionMember as $member){
                    

                    if($member['image'] == ""){

                        foreach($existing_member_files_details as $file_detail){
                            if($file_detail['parent_id'] == $member['id'] ){
                             foreach($existingFile as $image){ 
                                if($image->getClientOriginalName() == $file_detail['name']){ 
                                        $filename = $image->getClientOriginalName();
                                        $destination_path = 'storage/main/commission_member/'.$member['id'];  

            
                                        $update_commission_member=CommissionMember::find($member['id']);
                                        $path = $update_commission_member->image;
                                        $path = ltrim($path, '/');
                                        // dd($path);
                                        if(\File::exists($path))
                                        {
                                            // echo" if";
                                            
                                            
                                            // dd($path);
                                            \File::delete($path);  
                                        }
                                        $image->move($destination_path.'/',$filename);

                                        $update_commission_member->name= $member['name'];
                                        $update_commission_member->position= $member['position'];
                                        $update_commission_member->designation= $member['designation'];
                                        $update_commission_member->image = '/'.$destination_path.'/'.$filename;
                                        $check_existing_member_updatation_with_images=  $update_commission_member->save();


                                        
                                        if(!$check_existing_member_updatation_with_images){
                                            // $existing_member_with_images_array.push($member['name']);
                                            array_push($existing_member_with_images_array, ($member['name']));

                                        }
                                        
                                    } 
                                }
                            }
                            
                               
                        }
                    }else{
                        $update_commission_member = CommissionMember::find($member['id']);
                        $update_commission_member->name= $member['name'];
                        $update_commission_member->position= $member['position'];
                        $update_commission_member->designation= $member['designation'];
                        $update_commission_member->image= $member['image'];
                        $check_existing_member_updatation=  $update_commission_member->save();
                                        
                        if(!$check_existing_member_updatation){
                        //  $existing_member_with_images_array.push($member['name']);
                        array_push($existing_member_array, ($member['name']));

                        }
                      
                       

                    }
                    
                   
                    
                }
                $inside_existing_member_updatation_with_images=1;
                array_push($final_updation, 'Existing Member Updated With Image Change');

            }


            
            if($request->has('commissionMember') && $request->hasFile('file')){      // add new members 
                $images = $request->file('file');  
                $file_details_object = $request->input('files_info');  
                $file_details = json_decode($file_details_object,true); 
                $commissionMembers = json_decode($request->input('commissionMember'),true); 

                foreach($commissionMembers as $member){
                    // dd($member['id']);
                   
                    $create_member=new CommissionMember;
                    $create_member->commission_id=$selected_commission_id;
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
                                    $destination_path = 'storage/main/commission_member/'.$create_member->id;                      
                                    $image->move($destination_path.'/',$filename);
        
                                    $create_member=CommissionMember::find($create_member->id);
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commission= Commission::find($id);
        $get_members=  CommissionMember::where('commission_id','=',$id)->delete(); 
        $path = 'storage/main/commission_member/'.$id;  

        if(\File::exists($path))
       {
         \File::deleteDirectory($path);
       }       

        $commission->delete();
        return redirect(route('admin.commission.index'))->with('success','Commission Deleted Successfully');

    }
}
