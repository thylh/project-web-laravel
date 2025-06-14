@extends('in_out.layouts')

@section('title', 'Đổi mật khẩu')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
@endpush

@section('content')
<div class="change-password-form fade-in">
    <h2 class="slide-up" style="text-align: center;
    color: white;
    background: orange;
    display: block;
    padding: 10px 30px;
    border-radius: 10px;
    font-weight: bold;
    width: fit-content;
    margin: 0 auto 20px;">ĐỔI MẬT KHẨU</h2>

    @if($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('password.change') }}" class="login-form">
        @csrf
        <label for="old_password">Mật khẩu cũ:</label>
        <input type="password" id="old_password" name="old_password" required>

        <label for="new_password">Mật khẩu mới:</label>
        <input type="password" id="new_password" name="new_password" required>

        <label for="new_password_confirmation">Xác nhận mật khẩu mới:</label>
        <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>

        <button type="submit">Xác nhận</button>
    </form>
</div>

@endsection
