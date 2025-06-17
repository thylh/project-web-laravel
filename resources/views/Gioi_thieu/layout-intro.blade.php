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
    <style>
        .chat-fixed {
          position: fixed;
          bottom: 20px;
          right: 20px;
          background-color: #0084FF;
          color: white;
          padding: 12px 18px;
          border-radius: 25px;
          text-decoration: none;
          font-weight: bold;
          box-shadow: 0 2px 10px rgba(0,0,0,0.3);
          z-index: 9999;
        }
      </style>
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
    <a href="https://m.me/722689647590237" target="_blank" class="chat-fixed">
        💬 Message
      </a>
</body>
</html>
