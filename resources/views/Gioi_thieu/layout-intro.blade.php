{{-- layout.blade.php --}}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trang web của bạn')</title>

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">

    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">


    {{-- Các file CSS khác nếu có --}}
    @stack('styles')
</head>
<body>

    {{-- Phần Header --}}
    @include('Trang_Chu.header')

    {{-- Các phần nội dung tùy biến khác --}}
    <main>
        @yield('content')
    </main>
     {{-- Footer --}}
    @include('Trang_Chu.footer') {{-- <== Thêm dòng này trước </body> --}}

    {{-- JS cho phần header (search) --}}
    <script src="{{ asset('js/search.js') }}"></script>
    

    {{-- Các file JS khác nếu có --}}
    @stack('scripts')
    
</body>
</html>
