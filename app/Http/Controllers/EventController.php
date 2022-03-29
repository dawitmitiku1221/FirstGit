<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Event::orderBy('created_at','desc')->get();
        return view('posts.event')->with('posts',$posts);
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
        'description'=>'required' ,
        'post_image'=>'image|nullable'
     ]);
 if($request->hasFile('post_image')){
 $filenamewithext=$request->file('post_image')->getClientOriginalName();
 $filename=pathinfo('$filenamewithext',PATHINFO_FILENAME);
 $extention=$request->file('post_image')->getClientOriginalExtension();
 
 $fiilenametostore=$filename.'_'.time().'.'.$extention;
$request->file('post_image')->storeAs('public/post_images',$fiilenametostore);
}
 else{
     $fiilenametostore='noimage.jpg';
 }
     $posts=new Event;
     $posts->title=$request->input('title');
     $posts->description=$request->input('description');
    //  $post->user_id=auth()->user()->id;
 $posts->post_image=$fiilenametostore;
 $posts->save();
     return redirect('/posts')->with('success','post created');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts=Event::find($id);
        return view('posts.show')->with('posts',$posts);
  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts=Event::find($id);
        return view('posts.edit')->with('posts',$posts);
  
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
        $this->validate($request,[
            'title'=>'required',
        'description'=>'required' ,
        'post_image'=>'image|nullable'
     ]);
 if($request->hasFile('post_image')){
 $filenamewithext=$request->file('post_image')->getClientOriginalName();
 $filename=pathinfo('$filenamewithext',PATHINFO_FILENAME);
 $extention=$request->file('post_image')->getClientOriginalExtension();
 
 $fiilenametostore=$filename.'_'.time().'.'.$extention;
 $request->file('post_image')->storeAs('public/post_images',$fiilenametostore);
 }
 
     $post= Event::find($id);
     $post->title=$request->input('title');
     $post->description=$request->input('description');
     if($request->hasFile('post_image')){
        $post->post_image=$fiilenametostore;
    }
    $post->save();
     return redirect('/posts')->with('success','post updated');
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts=Event::find($id);
        $posts->delete();
        
        if($posts->post_image!='noimage.jpg'){
          Storage::delete('/public/post_images/'.$posts->post_image);
        }
        return redirect('posts')->with('success','post removed');
   
    }
}
