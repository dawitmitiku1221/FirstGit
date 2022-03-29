<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\musuems;
use Illuminate\Http\Request;

class MuseumRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=musuems::orderBy('created_at','desc')->get();
        return view('musuem.musuem')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('musuem.post');
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
            'recordName'=>'required',
        'description'=>'required' ,
        'recordimage'=>'image|nullable'
     ]);
     
     if($request->hasFile('recordimage')){
        $filenamewithext=$request->file('recordimage')->getClientOriginalName();
        $filename=pathinfo('$filenamewithext',PATHINFO_FILENAME);
        $extention=$request->file('recordimage')->getClientOriginalExtension();
        
        $fiilenametostore=$filename.'_'.time().'.'.$extention;
       $request->file('recordimage')->storeAs('public/musuem_images',$fiilenametostore);
        }
        else{
            $fiilenametostore='noimage.jpg';
        }
            $posts=new musuems;
            $posts->recordName=$request->input('recordName');
            $posts->description=$request->input('description');
           //  $post->user_id=auth()->user()->id;
        $posts->recordimage=$fiilenametostore;
        $posts->save();
            return redirect('/musuem')->with('success','Musuem Record Uploaded');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts=musuems::find($id);
        return view('musuem.show')->with('posts',$posts);
  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts=musuems::find($id);
        return view('musuem.edit')->with('posts',$posts);

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
            'recordName'=>'required',
        'description'=>'required' ,
        'recordimage'=>'image|nullable'
     ]);
 if($request->hasFile('recordimage')){
 $filenamewithext=$request->file('recordimage')->getClientOriginalName();
 $filename=pathinfo('$filenamewithext',PATHINFO_FILENAME);
 $extention=$request->file('recordimage')->getClientOriginalExtension();
 
 $fiilenametostore=$filename.'_'.time().'.'.$extention;
 $request->file('recordimage')->storeAs('public/musuem_images',$fiilenametostore);
 }
 
     $posts= musuems::find($id);
     $posts->recordName=$request->input('recordName');
     $posts->description=$request->input('description');
     if($request->hasFile('recordimage')){
        $posts->recordimage=$fiilenametostore;
    }
    $posts->save();
     return redirect('/musuem')->with('success','Musuem Record updated');
   
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts=musuems::find($id);
        $posts->Delete();
        
        if($posts->recordimage!='noimage.jpg'){

          Storage::Delete('/public/musuem_images/'.$posts->recordimage);
        }
        return redirect('musuem')->with('success','Musuem record removed');
   
    }
}
