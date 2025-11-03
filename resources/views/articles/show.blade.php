@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="container py-4">
        <h2 class="mb-3 text-primary">{{ $article->title }}</h2>

        @if ($article->image_path)
            <img src="{{ asset('storage/' . $article->image_path) }}" 
                 alt="Ảnh bài viết" 
                 class="img-fluid mb-3 rounded"
                 style="max-width: 600px;">
        @endif

        <p class="lead">{{ $article->body }}</p>

        <a href="{{ route('articles.index') }}" class="btn btn-secondary mt-3">⬅ Quay lại danh sách</a>
    </div>
@endsection
