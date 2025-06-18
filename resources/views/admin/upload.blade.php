@extends('admin.layout-admin')

@section('content')
<div class="container">
    <h2>Admin Upload Tài liệu</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.upload.store') }}" method="POST" enctype="multipart/form-data">
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
            <label for="category_id" class="form-label">Danh mục</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả (tuỳ chọn)</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Tệp tài liệu</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        <button class="btn btn-primary">Tải lên</button>
    </form>
</div>
@endsection
