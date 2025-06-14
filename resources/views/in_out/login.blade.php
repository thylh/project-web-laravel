@extends('in_out.layouts')

@section('title', 'Login')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
@endpush

@section('content')
<div class="login-section fade-in">
    <h2 class="slide-up">ĐĂNG NHẬP TÀI KHOẢN</h2>
    <form method="POST" action="{{ url('/dangnhap') }}" class="login-form">
        @csrf
        <label for="login">Email hoặc Tên đăng nhập:</label>
        @if ($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif
        <input type="text" id="login" name="login" required>

        <label for="password">Mật khẩu:</label>
        <input type="password" name="password" required>

        <button type="submit">Đăng nhập</button>

        <p>Chưa có tài khoản? <a href="{{ url('/dangky') }}">Đăng ký</a></p>
    </form>
    @if(session('success'))
        <div class="alert-success" style="padding: 10px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif
    @if(session('done'))
        <div class="alert alert-success" style="padding: 10px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px; margin-bottom: 15px;">
            {{ session('done') }}
        </div>
    @endif
</div>
@endsection
