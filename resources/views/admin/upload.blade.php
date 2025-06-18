@extends('admin.layout-admin')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Admin Upload Tài liệu</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.upload.store') }}" method="POST" enctype="multipart/form-data" class="shadow p-4 rounded bg-light">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Loại tài liệu</label>
            <input type="text" name="type" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả (tuỳ chọn)</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Tệp tài liệu</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Tải lên</button>
    </form>
</div>

<style>
    .container {
        max-width: 600px;
        margin: auto;
    }
    h2 {
        color: #333;
    }
    .alert {
        margin-bottom: 20px;
    }
    .form-control {
        border-radius: 0.25rem;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 0.25rem;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
</style>
@endsection