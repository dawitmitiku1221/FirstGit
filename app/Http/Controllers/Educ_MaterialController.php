<?php

namespace App\Http\Controllers;
use App\Models\Educ_Material;
use Illuminate\Http\Request;

class Educ_MaterialController extends Controller
{

    /**
     * Show all books for download .
     *
     * @return \Illuminate\Http\Response
     */
    
    public function display(){
        $books=Educ_Material::all();
        return view('educ_material.educ_materials')->with('books',$books);
    }
    public function download(){
        // $filePath = public_path("dummy.pdf");
    	// $headers = ['Content-Type: application/pdf'];
    	// $fileName = time().'.pdf';

        // return response()->download($filePath, $fileName, $headers);
    }
     /**
     * Show all books for download .
     *
     * @return \Illuminate\Http\Response
     */
    
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books= Educ_Material::all();
        return view('educ_material.index')->with('books',$books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('educ_material.upload');
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
            	'Auther'=>'required',
                'type'=>'required',
                	'publishDate'=>'required',
                    
        ]);
        if($request->hasFile('file')){
            $filenamewithext=$request->file('file')->getClientOriginalName();
            $filename=pathinfo('$filenamewithext',PATHINFO_FILENAME);
            $extention=$request->file('file')->getClientOriginalExtension();
            
            $fiilenametostore=$filename.'_'.time().'.'.$extention;
            $request->file('file')->storeAs('public/educ_materials',$fiilenametostore);
            }

            if($request->hasFile('photo')){
                $filenamewithext2=$request->file('file')->getClientOriginalName();
                $photoname=pathinfo('$filenamewithext2',PATHINFO_FILENAME);
                $extention=$request->file('file')->getClientOriginalExtension();
                
                $photoenametostore=$photoname.'_'.time().'.'.$extention;
                $request->file('file')->storeAs('public/educ_photo',$photoenametostore);
                }
        $book= new Educ_Material;
      
        $book->title=$request->input('title');
        $book->Auther=$request->input('Auther');
        $book->type=$request->input('type');
        $book->publishDate=$request->input('publishDate');
        $book->description=$request->input('description');
        $book->photo= $photoenametostore;
        $book->file= $fiilenametostore;
        $book->save();
        return redirect('/educ_material')->with('success', 'Uploaded');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $books=Educ_Material::find($id);
        return view('educ_material.show')->with('books',$books);

 }

  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $books=Educ_Material::find($id);
        return view('educ_material.update')->with('books',$books);
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
            	'Auther'=>'required',
                'type'=>'required',
                	'publishDate'=>'required',
                    
        ]);
        $book=  Educ_Material::find($id);
        $book->title=$request->input('title');
        $book->Auther=$request->input('Auther');
        $book->type=$request->input('type');
        $book->publishDate=$request->input('publishDate');
        $book->description=$request->input('description');
        $book->save();
        return redirect('/educ_material')->with('success', 'Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $boods=Educ_Material::find($id);
        $boods->delete();
        return redirect('educ_material')->with('success', 'Updated');
    }
}
