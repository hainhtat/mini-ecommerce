@extends('layout.master')
@section('content')
<div class="">
    <a href="{{route('category.index')}}" class="btn btn-sm btn-dark">Back</a>
</div>

    <form action="{{route('category.update', $category->id)}}" class="mt-3" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control" value="{{$category->name}}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-warning">Update</button>
        </div>
    </form>
@endsection