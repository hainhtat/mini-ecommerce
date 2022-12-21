@extends('layout.master')
@section('content')
<div class="">
    <a href="{{route('watch.index')}}" class="btn btn-sm btn-dark">Back</a>
</div>

    <form action="{{route('watch.store')}}" class="mt-3" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="category">Choose Category</label>
            <select name="category_id" id="" class="form-control">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}">
        </div>

        <div class="form-group">
            <label for="price">price</label>
            <input type="number" id="price" name="price" class="form-control">  
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" class="form-control">  
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>  
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-success">Create</button>
        </div>
    </form>
@endsection