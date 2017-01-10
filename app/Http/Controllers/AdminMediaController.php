<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Photo;

class AdminMediaController extends Controller
{
    public function index(){        
        $photos = Photo::all();
        return view('admin.media.index', compact('photos'));
    }

    public function create(){
        return view('admin.media.create');
    }
    
    public function store(Request $request){
        $file = $request->file('file');
        
        $name = time() . '_' . $file->getClientOriginalName();
        
        $file->move('images', $name);
        
        Photo::create(['file'=>$name]);
    }
    
    public function destroy($id){
        $photo = Photo::findOrFail($id);
        $deletedPhoto = $photo->file;
        if(File::exists($photo->file)){
            unlink(public_path() . $photo->file);
        }
        $photo->delete();
        
        Session::flash('message', 'Photo "'. $deletedPhoto .'" has been deleted.');
        return redirect('/admin/media');
    }
}