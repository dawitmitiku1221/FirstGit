@extends('layouts.app')
@section('content')
<h1>Upload musuem record</h1>
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">

   
<form action="{{route('musuem.store')}}" method="POST" enctype="multipart/form-data">
     @csrf
     
     <div class="form-outline mb-4">
     
    <label class="form-label" for="recordName" >Name</label>
    <input type="text" name="recordName" class="form-control" />
  </div>


  <!-- Message input -->
  <div class="form-outline mb-4"> 
     <label class="form-label" for="description">Description</label>
    <textarea class="form-control" name="description"  rows="4"></textarea>

  </div>

   <div class="form-outline mb-4">
    <input type="file" id="form3example3" class="form-control" name="recordimage" />
    
  </div>


  <!-- Submit button -->
  <button type="submit" class="btn btn-primary btn-block mb-4"> Post </button>
</form>
</div>
</div>
@endsection