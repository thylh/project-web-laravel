@extends('in_out.layouts')

@section('title', 'STEP1')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
@endpush

@section('content')
<div class="container">
    <h1>Chọn tập tin của bạn</h1>
    <p>Kiếm <span class="coin">💰</span> tín dụng bằng cách tải lên và chia sẻ ghi chú học tập của bạn</p>

    <div class="steps">
        <span class="step active">1</span>
        <span class="step">2</span>
        <span class="step">3</span>
    </div>

    <form action="{{ route('upload.step2.post') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="drop-area" id="drop-area" style="border: 2px dashed #aaa; padding: 30px; text-align: center; cursor: pointer;">
            <p><strong>Kéo và thả tập tin vào đây để tải lên</strong></p>
            <p>Kích thước tối đa: 100MB. Định dạng: PDF, DOC, DOCX, JPEG, PNG, XLS, ZIP</p>
            <div id="file-info" style="margin-top: 15px;"></div>
            <input type="file" name="file" id="fileInput" hidden accept=".pdf,.doc,.docx,.jpeg,.jpg,.png,.xls,.zip">
            <button type="button" onclick="document.getElementById('fileInput').click()">Hoặc duyệt các tập tin ở đây</button>
        </div>
        <div style="display: flex; justify-content: end;">
            <button type="submit">Tiếp tục</button>
        </div>
    </form>
    <div class="info-link">
        <a href="javascript:void(0)" onclick="openModal()">Thế nào là một tài liệu tốt?</a>
    </div>
</div>

@include('upload.partials.info_modal')
<script src="{{ asset('js/upload.js') }}"></script>
@endsection
