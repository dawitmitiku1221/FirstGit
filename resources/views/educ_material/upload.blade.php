@extends('layouts.app');
@section('content')
<div class="container">
    <form action="{{route('educ_material.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
              <div class="card-body">
  
                <div class="form-group">
                    <label class="form-label" for="title" >Title</label>
                    <input type="text" name="title" class="form-control" />
                </div>
  
                 <div class="form-group">
                  <label class="form-label" for="Auther" >Auther</label>
                  <input type="text" name="Auther" class="form-control" />
                </div>
  
               <div class="form-group">
                  <label class="form-label" for="type" >Type</label>
                  <input type="text" name="type" class="form-control" />
                </div>
                <div class="form-group">
                    <label class="form-label" for="publishDate" >publish Date</label>
                     <input type="date" name="publishDate"class="form-control" />
                </div>
                  <div class="form-group mb-4">
                     <textarea name="description" class="form-control" ></textarea>
                </div>
                <div class="form-group mb-4">
                  <input type="file" name="photo">
              </div>
                <div class="form-group mb-4">
                 <input type="file" name="file">
             </div> 
  
                <div class="form-group">
                   <input type="submit" value="Upload" class="btn btn-success float-right">
                </div>
            
               
              </div>
              </form>
</div>
    
@endsection