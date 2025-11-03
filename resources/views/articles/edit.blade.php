@extends('layouts.app')

@section('title', 'Sửa bài viết')

@section('content')
    <h2>Sửa bài viết #{{ $article->id }}</h2>


<form action="{{ route('articles.update', $article->id) }}" 
      method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Tiêu đề</label>
    <input type="text" name="title" value="{{ old('title', $article->title) }}">

    <label>Nội dung</label>
    <textarea name="body">{{ old('body', $article->body) }}</textarea>

    <label>Ảnh</label>
    @if($article->image_path)
        <p><img src="{{ asset('storage/' . $article->image_path) }}" width="150"></p>
    @endif
    <input type="file" name="image">

    <button type="submit">Cập nhật</button>
</form>

@endsection
