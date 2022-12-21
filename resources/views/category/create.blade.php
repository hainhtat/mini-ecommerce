@extends('layout.master')
@section('content')
<div class="">
    <a href="{{route('category.index')}}" class="btn btn-sm btn-dark">Back</a>
</div>

    <form action="{{route('category.store')}}" class="mt-3" method="post">
        @csrf
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-success">Create</button>
        </div>
    </form>
@endsection