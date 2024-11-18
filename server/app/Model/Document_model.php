<?php

namespace App\Model;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
class Document_model extends Model
{
    
    public static function ChangePassword($request){

        $data=array(
         
        	'password'=> Hash::make($request->new_password),
       
        );
        $qry=DB::table('users')->where('id',Auth::user()->id)->update($data);
        return $qry;

    }
public static function InsertDocument($request,$images){
	 $d=DB::table('pdf_files')->where('unsaved',0)->orderBy('id','desc')->first();
 if($d=='' || $d==null){
 	$serial_no='2001';
 }
 else{
 	$serial_no=$d->serial_no;
 } 


        $data=array(
        	'user_id'=> Auth::user()->id,
        	'passport_number'=>$request->passport_number,
        	'idea'=>$request->name,
        	'pdf_detail'=>$request->idea,
        	'serial_no'=>$serial_no+1,
        	'document_file'=> implode("|",$images),
        );
		$qry=DB::table('pdf_files')->insert($data);
		if($qry){
			return 1;
		}
		
	}
	

public static function showDocumentUser(){
$qry=DB::table('pdf_files')->where('unsaved',0)->where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate(12);
return $qry;

}

public static function InsertDocumentBeforeClose($request){
	 
 
        $data=array(
        	'user_id'=> Auth::user()->id,
        	'passport_number'=>$request->passport_number,
        	'idea'=>$request->name,
        	'pdf_detail'=>$request->idea,
         'unsaved'=>1
        );
		$qry=DB::table('pdf_files')->insert($data);
		if($qry){
			return 1;
		}
		
	}
 

}