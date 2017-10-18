<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Record;
use App\User;
use App\Notification;
use Auth;
use Illuminate\Support\Facades\Storage;
use File;

class FilesController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $archivo = Record::orderBy('id','ASC')->paginate(8); 
        // return view('User/showfiles')->with('archivos', $archivo);

        // $usuarios = Record::find(1)->users;
        // dd($usuarios);
        // return view('User/showfiles')->with('users', $usuarios);

        return view('User/showfiles');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
    public function index2()
    {
        $record = Record::all();
        return view('User/filesadmin')->with('record',$record);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = User::findOrFail($request->id);
        $user->save();

        if($request->file){
            $nombre = $request->file->getClientOriginalName();
            if (Storage::exists( 'public/files/'.Auth::user()->id.'/' . $nombre,
                file_get_contents($request->file('file')->getRealPath())))
            {   

                 return view('User/showfiles')->with('nombre', $nombre);;
                exit();
            }
            Storage::put(
                'public/files/'.Auth::user()->id.'/' . $nombre,
                file_get_contents($request->file('file')->getRealPath())
                );

        //\Storage::disk('filesRedirect')->put($nombre,  \File::get($file));
        //$nombre = Auth::user()->id.'/' . $nombre;

            $archivo = new Record($request->all());
            $archivo->name = $nombre;
            $archivo->user_id = Auth::user()->id;

            if(is_null($request['is_public'])){
                $archivo->is_public = "no";
            }else{
                $archivo->is_public = $request->is_public;
            }

            $archivo->is_folder = $request->is_folder;
            $archivo->save();

            // $notify = new Notification();
            // $notify->user_id = $request->id;
            // $notify->user_name = $user->name;
            // $notify->record_id = $archivo->id;
            // $notify->record_name = $archivo->name;
            // $notify->save();


        }else{
            $result = File::makeDirectory ('storage/files/'.$request->id.'/'.$request->folder_name, 0777, true, true);

            $hashmd5 = md5($request->folder_name);

            $archivo = new Record($request->all());
            $archivo->name = $request->folder_name;
            $archivo->is_folder = $request->is_folder;
            $archivo->folder_hash = $hashmd5;
            $archivo->user_id = Auth::user()->id;
            $archivo->save();
        }

        //$archivo->users()->sync(Auth::user()->id); //Sync se utiliza como attach para relacionar tabla pivote

        return redirect()->action('FilesController@index');
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
        //
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

        if($request->oldname != "" && $request->oldname != null){

            $archivo = Record::findOrFail($id);
            $req = new Record($request->all());

            if(is_null($req['name'])){
                $archivo->name = $archivo->name;
            }else{
                $archivo->name = $request->name;
            }

            if (Storage::exists( 'public/files/'.Auth::user()->id.'/'.$request->name))
            {   

                return view('User/showfiles')->with('nombre', $archivo);
                exit();  
            }
            
            Storage::move('public/files/'.Auth::user()->id.'/'.$request->oldname, 'public/files/'.Auth::user()->id.'/'.$request->name);
            $archivo->save();

        }else{
            $archivo = Record::findOrFail($request->file_id);
            $archivo->folder_hash = $request->hash_folder;
            if (Storage::exists(  'public/files/'.Auth::user()->id.'/'.$request->name_folder.'/'.$request->name_file))
            {   

                return view('User/showfiles')->with('nombre', $archivo);
                exit();  
            }
            
            
            Storage::move('public/files/'.Auth::user()->id.'/'.$request->name_file, 'public/files/'.Auth::user()->id.'/'.$request->name_folder.'/'.$request->name_file);
            $archivo->save();
        }

        return redirect()->action('FilesController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rec = Record::find($id);

        if($rec->is_folder == "yes"){
            Storage::deleteDirectory('public/files/'.Auth::user()->id.'/'.$rec->name);
            
            $match = Record::find($id)->all();

            for ($i=0; $i < count($match); $i++) { 
                if($match[$i]['folder_hash'] == $rec->folder_hash){
                $archivo = ($match[$i]['id']);
                $borrado = Record::findOrFail($archivo);
                $borrado->delete();
                }
            }
            

        }else{
            if($rec->folder_hash == "106a6c241b8797f52e1e77317b96a201"){
                Storage::delete('public/files/'.Auth::user()->id.'/'.$rec->name);
                $rec->delete();
            }else{
                $folder_hash_asigned = $rec->folder_hash;
                $todo = Record::find($id)->all();
                for ($i=0; $i < count($todo); $i++) {
                    if($todo[$i]['is_folder'] = "yes"){
                        $folder_name = $todo[$i]['name'];
                        Storage::delete('public/files/'.Auth::user()->id.'/'.$folder_name.'/'.$rec->name);
                    }
                }
                $archivo = Record::find($rec->id);
                $archivo->delete();
            }
        }

        return redirect()->action('FilesController@index');


        // dd("echo");
        // $roc = Record::find($id);
        // Storage::deleteDirectory('public/files/'.Auth::user()->id.'/'.$roc->name);

        // return redirect()->action('FilesController@index');



        // $rec = Record::find($id);
        // if($rec->is_folder == "yes"){
        //     $verify = Storage::files('public/files/'.Auth::user()->id.'/'.$rec->name);
        //     for ($i=0; $i < count($verify); $i++) { 
        //         dd("hola");
        //     }
        //     Storage::deleteDirectory('public/files/'.Auth::user()->id.'/'.$rec->name);
        // }

        // $archivo = Record::findOrFail($id);
        // $archivo->delete();
        // return redirect()->action('FilesController@index');
    }
}
