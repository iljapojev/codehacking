<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Requests;
use App\Http\Requests\PostsCreateRequest;
use App\Http\Requests\PostsEditRequest;
use App\Http\Controllers\Controller;
use App\Post;
use App\Photo;
use App\Category;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('name','id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $input = $request->all();
        $user = Auth::user();
        
        if($request->file('photo_id')){
            $file = $request->file('photo_id');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move('images', $filename);
            $photo = Photo::create(['file' => $filename]);
            
            $input['photo_id'] = $photo->id;
        }
        
        $user->posts()->create($input);
        
        return redirect('admin/posts');
        
        
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
        $post=Post::findOrFail($id);
        $categories = Category::lists('name', 'id');
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsEditRequest $request, $id)
    {
        $input = $request->all();
        
        if($file = $request->file('photo_id')){
            
            $post = Post::findOrFail($id);
            unlink(public_path() . $post->photo->file);
            
            
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move('images', $filename);
            $photo = Photo::create(['file' => $filename]);
            
            $input['photo_id'] = $photo->id;
        }
        
        Auth::user()->posts()->whereId($id)->first()->update($input);
        
        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postTitle = Post::findOrFail($id)->title;
        
        $post = Post::findOrFail($id);
        if($post->photo){
            unlink(public_path() . $post->photo->file);
        }
        $post->delete();

        Session::flash('message','Post "' . $postTitle . '" has been deleted.');
        
        return redirect('/admin/posts');
    }
}
