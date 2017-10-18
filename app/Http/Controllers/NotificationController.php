<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Record;
use App\User;
use App\Notification;
use Auth;
use Illuminate\Support\Facades\Storage;
use File;

class NotificationController extends Controller
{
    
	public function show(Record $rec){

		$archivos = Record::all();

		return view('User/showallfiles')->with("notify",$archivos);

	}

	public function showFolder($id){

		return view('User/folder')->with('id_de_hash', $id);
	}

	public function showShared(){
		return view('User/sharedwith');
	}

	public function shardWith(Request $request){


		$a = new User($request->all());

		$user = User::where('email', $a->name)->first();
		
		if($user){
		$user = ($user->all());

		$shared = new Notification($request->all());
		
		foreach ($user as $role) {
			if(Auth::user()->id != $role->id){
			$shared->user_id = ($role->id);
			$shared->user_name = $role->name;
			$shared->author_id = $request->author_id;
			$shared->record_id = $request->record_id;
			$shared->record_name = $request->record_name;
			$shared->save();
			}
		}

	}else{
		dd("No existe usuario");
	}

		// $shared = new Notification($request->all());
  //       $shared->user_id = $request->user_id;
  //       $shared->user_name = $request->user_name;
  //       $shared->record_id = $request->record_id;
  //       $shared->record_name = $request->record_name;
  //       $shared->save();

		return view('User/sharedwith')->with("rec",$shared);
	}
}
