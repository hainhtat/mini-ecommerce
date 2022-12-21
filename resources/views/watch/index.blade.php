@extends('layout.master')
@section('content')
<div class="">
    <a href="{{route('watch.create')}}" class="btn btn-sm btn-success">Create</a>
</div>

<table class="table table-stripe mt-3">
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($watches as $watch)
            <tr>
                <td>
                    <img src="{{asset('images/'.$watch->image)}}" alt="" width="50px" class="img-thumbnail">
                </td>
                <td>{{$watch->name}}</td>
                <td>{{$watch->price}}</td>
                <td>{{$watch->category->name}}</td>
                <td>{{$watch->description}}</td>
                <td>
                    <a href="{{route('watch.edit', $watch->id)}}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{route('watch.destroy', $watch->id)}}" class="d-inline" method="post" onsubmit="return confirm('Delete this watch?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{$watches->links()}}
@endsection