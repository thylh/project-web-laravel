@extends('in_out.layouts')

@section('title', 'STEP2')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endpush

@section('content')
<div class="container">
    <h2>Thêm thông tin tài liệu</h2>

    @if(session('original_file_name'))
        <p><strong>Tập tin:</strong> {{ session('original_file_name') }}</p>
    @endif
    <div class="steps">
        <span class="step done">1</span>
        <span class="step active">2</span>
        <span class="step">3</span>
    </div>

    <form action="{{ route('upload.step3') }}" method="POST">
        @csrf

        <label>
            Tên tài liệu:
            <input type="text" name="title" value="{{ old('title', pathinfo(basename(session('original_file_name')), PATHINFO_FILENAME)) }}">
        </label>

        <label>
            Loại tài liệu:
            <select name="type">
                <option value="lecture">Lecture</option>
                <option value="exercise">Exercise</option>
                <option value="exam">Exam</option>
                <option value="other">Other</option>
            </select>
        </label>

        <label>
            Mô tả tài liệu:
            <textarea name="description" placeholder="VD: Bài giảng thực hành hệ điều hành">{{ old('description') }}</textarea>
        </label>
        <div style="display: flex; justify-content: space-between;">
            <a href="{{ route('upload.step1') }}"><button type="button">Quay lại</button></a>
            <button type="submit">Hoàn thành</button>
        </div>
    </form>
</div>
@endsection
