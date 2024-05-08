@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>Add new book</h1>
        <form action="{{ route('admin.add-book') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="bookname" class="form-label">Book name</label>
                <input name="name" type="text" class="form-control" id="bookname" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <div id="emailHelp" class="form-text" style="color: red">{{ $errors->first('name') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="bookauthor" class="form-label">Book Author name</label>
                <input name="author" type="text" class="form-control" id="bookauthor" value="{{ old('author') }}">
                @if ($errors->has('author'))
                    <div id="emailHelp" class="form-text" style="color: red">{{ $errors->first('author') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="bookdesc" class="form-label">Book Description</label>
                <textarea name="description" class="form-control" id="bookdesc">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                    <div id="emailHelp" class="form-text" style="color: red">{{ $errors->first('description') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Book Image</label>
                <input name="image" type="file" class="form-control" id="image">
                @if ($errors->has('image'))
                    <div id="emailHelp" class="form-text" style="color: red">{{ $errors->first('image') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Add Book</button>
        </form>
    </div>
@endsection
