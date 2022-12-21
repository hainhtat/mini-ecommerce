@extends('layout.master')
@section('content')
<div class="">
    <a href="{{route('category.create')}}" class="btn btn-sm btn-success">Create</a>
</div>

<table class="table table-stripe mt-3">
    <thead>
        <tr>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{$category->name}}</td>
                <td>
                    <a href="{{route('category.edit', $category->id)}}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{route('category.destroy', $category->id)}}" class="d-inline" method="post" onsubmit="return confirm('Delete this category?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{$categories->links()}}
@endsection