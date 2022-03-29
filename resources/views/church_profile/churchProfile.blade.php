@extends('layouts.app')
@section('content')
@if (!count($posts)>0)
    <a href="churchprofile/create" class="btn btn-primary mb-4">Create Profile</a>
@endif

@foreach ($posts as $post )
    

<h1>{{$post->churchName}}</h1>
<div class="row">
   
    <img style="width:100%;"src="/storage/churchP_images/{{$post->photo}}" >
    
<h1>Address: {{$post->address}}</h1>
<h1>Email: {{$post->email}}</h1>
<h1>Phone number:+251{{$post->phone}}</h1>
</div>
<p>{{$post->description}}</p>
<small>created on{{$post->created_at}}</small>
<hr>
@if(!Auth::guest())
<div style="display: flex;">
    <a href="/churchprofile/{{$post->id}}/edit" class="btn btn-primary">Update</a>
 </div>
    @endif

@endforeach
 @endsection