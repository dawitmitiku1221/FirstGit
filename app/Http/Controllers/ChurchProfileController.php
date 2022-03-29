<?php

namespace App\Http\Controllers;
use App\Models\ChurchProfile;
use Illuminate\Http\Request;

class ChurchProfileController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=ChurchProfile::all();
        return view('church_profile.churchprofile')->with('posts',$posts);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
return view('church_profile.createProfile');
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
            'churchName'=>'required',
            	'photo'=>'required',
                'address'=>'required',
                	'email'=>'required',
                    	'phone'=>'required',
        ]);


        if($request->hasFile('photo')){
            $fileNameWithExt=$request->file('photo')->getClientOriginalName();

            $filename=pathinfo('$fileNameWithExt',PATHINFO_FILENAME);
            $extension=$request->file('photo')->getClientOriginalExtension();
            
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            
            $path=$request->file('photo')->storeAs('public/churchP_images',$fileNameToStore);
           
            }

        $posts=new ChurchProfile;
        $posts->churchName=$request->input('churchName');
        $posts->address=$request->input('address');
        $posts->email=$request->input('email');
        $posts->phone=$request->input('phone');
        if($request->hasFile('photo')){
            $posts->photo=$fileNameToStore;

        }
        $posts->save();
        return redirect('/churchprofile')->with('success', 'cuhrch profile created');


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
        $posts=ChurchProfile::find($id);
        return view('church_profile.editprofile')->with('posts',$posts);
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
            'churchName'=>'required',
            	'photo'=>'required',
                'address'=>'required',
                	'email'=>'required',
                    	'phone'=>'required',
        ]);
       
        if($request->hasFile('photo')){
            $fileNameWithExt=$request->file('photo')->getClientOriginalName();

            $filename=pathinfo('$fileNameWithExt',PATHINFO_FILENAME);
            $extension=$request->file('photo')->getClientOriginalExtension();
            
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            
            $path=$request->file('photo')->storeAs('public/churchP_images',$fileNameToStore);
           
            }

        $posts= ChurchProfile::find($id);
        $posts->churchName=$request->input('churchName');
        $posts->address=$request->input('address');
        $posts->email=$request->input('email');
        $posts->phone=$request->input('phone');
        if($request->hasFile('photo')){
            $posts->photo=$fileNameToStore;

        }
        $posts->save();
        return redirect('/churchprofile')->with('success', 'cuhrch profile created');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        

    }
}
