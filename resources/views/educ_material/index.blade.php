@extends('layouts.app')
@section('content')
    <div class="container">
        
    <a href="educ_material/create" class="btn btn-primary mb-4">Upload</a>

    <form action="" method="GET">
        <table class="table">
            @if (count($books)>0)
            <tr>
                <th>id</th>
                <th>Title</th>
                <th>Auther</th>
                <th>Type</th>
                <th>published date</th>
                <th>description</th>
                <th>Education Material</th>
                <th colspan="2">action</th>
            </tr>
           
        @foreach ($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->Auther }}</td>
                <td>{{ $book->type }}</td>
                <td>{{ $book->publishDate }}</td>
                <td>{{ $book->description }}</td>
                {{--  <td>  <img style="width:100%;"src="/storage/educ_photo/{{$book->photo}}"> </td>  --}}
                <td>
                    <a href="/educ_material/{{$book->id}}/edit" class="btn btn-primary">update</a>
                    <a href=" {{ route('educ_material.destroy', $book->id) }}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
            @else 
            <h1 style="margin: 20%; color:rgb(255, 0, 76)"> No books uploaded</h1>

            @endif
           
        </table>
    </form>
    </div>
@endsection