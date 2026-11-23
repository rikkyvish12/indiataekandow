<?php

namespace App\Http\Traits;
use Carbon\Carbon;

use Mail;
use App\CreatePassword;


trait MailRouter
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function sendTFIEmail($data,$applied_as,$client_emails,$full_name)
    {
    

//  dd($data);
        Mail::send('emails.sendTfiMail',["data"=>$data,"form_name"=>$applied_as],function($message) use ($client_emails,$applied_as,$full_name){

            $message->to($client_emails)->subject('Application to Join TFI - As '.$applied_as.'(-'.$full_name.')');
            $message->from('mailtonaveedofficial@gmail.com','TFI');
     
         });

    
 
    }

    public function contactUs($data,$type,$client_emails,$full_name,$assoc_name)
    {
      

      $current_date_time = Carbon::now();
//  dd($profile_title);
      if($type ==="assoc"){
         Mail::send('emails.contactUs',["data"=>$data,"type"=>$type],function($message) use ($client_emails,$assoc_name,$full_name,$current_date_time){

            $message->to($client_emails)->subject('New-Enquiry for '.$assoc_name.'=> ('.$full_name.') '.$current_date_time);
            $message->from('mailtonaveedofficial@gmail.com','TFI');
   
         });
      }else{
            Mail::send('emails.contactUs',["data"=>$data,"type"=>$type],function($message) use ($client_emails,$full_name,$current_date_time){

                  $message->to($client_emails)->subject('New-Enquiry => '.'('.$full_name.') '.$current_date_time);
                  $message->from('mailtonaveedofficial@gmail.com','TFI');
         
               });
            }

    
 
    }


   //  public function sendRegisterPharmacistEmail($data,$pharmacist_email,$token) 
   //  {
   //  $sendTo = $pharmacist_email;
   //  Mail::send('emails.pharmacist_register_mail',$data,function($message)use ($sendTo){

   //     $message->to($sendTo,'')->subject('Registeration in Medicare Application.');
   //     $message->from('dotsoftwares.in@gmail.com','Medicare');

   //  });

   //  $new_password_token = new CreatePassword;
   //  $new_password_token->email = $pharmacist_email;
   //   $new_password_token->token = $token;
   //   $new_password_token->save();


   //  }

   // public function sendOrderEmailtoBusiness($data,$business_email,$ship_status)
   // {
   //     $sendTo = $business_email;
   //     $data['ship_status'] = $ship_status;
   //     Mail::send('emails.bussiness_confirm_order_mail',$data,function($message) use ($sendTo){

   //     $message->to($sendTo,'')->subject('New Order Placed');
   //     $message->from('aju.260890@gmail.com','Retronics Sales');

   //  });
   // }
   // public function sendOrderEmailtoCustomer($data,$customer_email)
   // {
   //     $sendTo = $customer_email;
   //     Mail::send('emails.cust_confirm_order_mail',$data,function($message) use ($sendTo){ 

   //     $message->to($sendTo,'')->subject('Order placed');
   //     $message->from('aju.260890@gmail.com','Retronics');

   //  });
   // }


    
}
