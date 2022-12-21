@extends('layout.master')
@section('content')
<div class="">
    <a href="{{route('watch.index')}}" class="btn btn-sm btn-dark">Back</a>
</div>

    <form action="{{route('watch.update',$watch->id)}}" class="mt-3" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="category">Choose Category</label>
            <select name="category_id" id="" class="form-control">
                @foreach($categories as $category)
                    <option value="{{$category->id}}"
                        @if($category->id == $watch->id)
                            selected
                        @endif
                    >{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name">name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{$watch->name}}">
        </div>

        <div class="form-group">
            <label for="price">price</label>
            <input type="number" id="price" name="price" class="form-control" value="{{$watch->price}}">  
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" class="form-control">  
            <img src="{{asset('images/'.$watch->image)}}" alt="" class="img-thumbnail" width="150px">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{$watch->description}}</textarea>  
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-success">Update</button>
        </div>
    </form>
@endsection