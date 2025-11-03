@extends('layouts.app')
@section('title', __('messages.article.create'))
@section('content')
    <h2>{{ __('messages.article.create') }}</h2>
    
    {{-- Thông báo cảnh báo bằng tiếng Việt --}}
    <x-alert type="warning" title="{{ __('messages.warning') }}">
        {{ __('Dữ liệu hiện chỉ mô phỏng (chưa lưu DB).') }}
    </x-alert>

    <form action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        
        {{-- TIÊU ĐỀ --}}
        <div>
            <label for="title">{{ __('validation.attributes.title') }}</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}">
            @error('title') 
                <div style="color:#b91c1c; font-size: 14px; margin-top: 4px;">
                    {{ $message }}
                </div> 
            @enderror
        </div>

        {{-- NỘI DUNG --}}
        <div style="margin-top: 16px;">
            <label for="body">{{ __('validation.attributes.body') }}</label>
            <textarea id="body" name="body" rows="6" style="width: 100%; padding: 8px; border: 1px solid #d1d5db;">{{ old('body') }}</textarea>
            @error('body') 
                <div style="color:#b91c1c; font-size: 14px; margin-top: 4px;">
                    {{ $message }}
                </div> 
            @enderror
        </div>

        {{-- ẢNH MINH HOẠ --}}
        <div style="margin-top: 16px;">
            <label for="image">{{ __('validation.attributes.image') }} ({{ __('messages.optional', ['default' => 'tuỳ chọn']) }})</label>
            <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png">
            @error('image') 
                <div style="color:#b91c1c; font-size: 14px; margin-top: 4px;">
                    {{ $message }}
                </div> 
            @enderror
        </div>

        {{-- NÚT SUBMIT --}}
        <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-primary">
                {{ __('messages.save') }}
            </button>
        </div>
    </form>
@endsection

@push('styles')
    <style>
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-family: inherit;
            box-sizing: border-box;
        }

        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .btn-danger {
            background: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background: #a71d2a;
        }
    </style>
@endpush