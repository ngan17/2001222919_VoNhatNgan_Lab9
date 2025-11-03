@extends('layouts.app')

@section('title', 'Danh sách bài viết')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="page-title">📚 Danh sách bài viết</h2>
            <a href="{{ route('articles.create') }}" class="btn btn-primary">+ Thêm bài viết</a>
        </div>

        {{-- Flash message --}}
        @if(session('success'))
            <div class="alert-success">
                 {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $a)
                        <tr>
                            <td style="width:60px">{{ $a->id }}</td>

                            {{-- Thumbnail --}}
                            <td style="width:120px">
                                @if(!empty($a->image_path) && file_exists(storage_path('app/public/' . $a->image_path)))
                                    <img src="{{ asset('storage/' . $a->image_path) }}"
                                         alt="Ảnh {{ $a->title }}"
                                         style="max-width:100px; height:auto; border-radius:6px;">
                                @else
                                    {{-- Placeholder nếu chưa có ảnh --}}
                                    <img src="{{ asset('images/placeholder.png') }}"
                                         alt="No image"
                                         style="max-width:100px; height:auto; opacity:0.7; border-radius:6px;">
                                @endif
                            </td>

                            <td>{{ $a->title }}</td>

                            <td class="actions">
                                <a href="{{ route('articles.show', $a->id) }}">
                                    <x-button variant="primary">Xem</x-button>
                                </a>

                             <a href="{{ route('articles.edit', $a->id) }}">

                                    <x-button variant="primary">Sửa</x-button>
                                </a>

                                <form action="{{ route('articles.destroy', $a->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-button variant="danger"
                                              onclick="return confirm('Bạn có chắc muốn xoá bài viết này?')">
                                        Xoá
                                    </x-button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center; color:#888;">
                                Chưa có bài viết.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('styles')
<style>
    body {
        background: #f5f7fa;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    .page-title {
        margin-bottom: 0;
        font-size: 24px;
        font-weight: 600;
        color: #333;
    }

    .alert-success {
        padding: 12px 18px;
        margin-bottom: 20px;
        border: 1px solid #28a745;
        background: #e6f4ea;
        color: #1e7e34;
        border-radius: 8px;
        font-weight: 500;
    }

    .card {
        background: #fff;
        padding: 12px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 12px 16px;
        text-align: left;
        vertical-align: middle;
    }

    .table thead {
        background: #f1f3f5;
        color: #333;
    }

    .table tbody tr {
        transition: background 0.2s;
    }

    .table tbody tr:hover {
        background: #f9fbfc;
    }

    .actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }
</style>
@endpush
