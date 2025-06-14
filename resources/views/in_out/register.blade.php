@extends('in_out.layouts')

@section('title', 'Sign in')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
@endpush

@section('content')
<div class="login-section fade-in">
    <h2 class="slide-up">ĐĂNG KÝ TÀI KHOẢN</h2>
    <form method="POST" action="{{ url('/dangky') }}" class="login-form">
        @csrf
        @if ($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <label for="name">Họ và tên</label>
        <input type="text" id="name" name="name" required />

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required />

        <label for="username">Tên đăng nhập</label>
        <input type="text" id="username" name="username" required />

        <label for="password">Mật khẩu</label>
        <input type="password" id="password" name="password" required />

        <label for="password_confirmation">Nhập lại mật khẩu</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required />

        <button type="submit">Đăng ký</button>

        <p>Đã có tài khoản? <a href="{{ url('/dangnhap') }}">Đăng nhập</a></p>
    </form>
</div>
@endsection
