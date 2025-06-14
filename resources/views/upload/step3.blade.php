@extends('in_out.layouts')

@section('title','STEP3')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="steps">
        <span class="step done">1</span>
        <span class="step done">2</span>
        <span class="step active">3</span>
    </div>

    <h1>Tải lên hoàn tất! Vui lòng chờ Admin duyệt.</h1>

    <div class="success">
        ✅ Tải lên hoàn tất
        <a href="{{ asset('storage/' . $file) }}" target="_blank">Mở tài liệu →</a>
    </div>

    <a href="{{ route('upload.step1') }}"><button type="submit">Tải lên thêm tập tin</button></a>
    <a href="{{ url('/trangchu') }}"><button type="submit">Về trang chủ</button></a>
</div>
@endsection
