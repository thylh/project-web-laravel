<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Trang Lớp 11</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    <link rel="stylesheet" href="{{ asset('css/lop10.css') }}">
    <link rel="stylesheet" href="{{ asset('css/LT10.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    @include('Trang_Chu.header')

    <div class="LT_10">
       <div class="menu_LT_1">
    <p class="Style_10_1">
        <a style="padding-top:20px; color:grey;" href="{{ route('lop11.ltdd')}}"><b>Lý thuyết Toán 11 đầy đủ</b></a>

        <a href="#"><b>Lý thuyết Chương 1: Mệnh đề và tập hợp</b></a>
        <a href="{{ route('lop11.bai1') }}">Lý thuyết Bài 1: Mệnh đề</a>
        <a href="{{ route('lop11.bai2') }}">Lý thuyết Bài 2: Tập hợp và các phép toán trên tập hợp</a>
        <a href="#"><b>Lý thuyết Chương 2: Bất phương trình và hệ bất phương trình bậc nhất hai ẩn </b></a>
        <a href="{{ route('lop11.bai1') }}">Lý thuyết Bài 3: Bất phương trình bậc nhất hai ẩn</a>
        <a href="{{ route('lop11.bai2') }}">Lý thuyết Bài 4: Hệ bất phương trình bậc nhất hai ẩn</a>
         <a href="#"><b>Lý thuyết Chương 3: Hệ thức lượng trong tam giác</b></a>
        <a href="{{ route('lop11.bai1') }}">Lý thuyết Bài 5: Giá trị lượng giác của một góc từ 0⁰ đến 180⁰ </a>
        <a href="{{ route('lop11.bai2') }}">Lý thuyết Bài 6: Hệ thức lượng giác trong tam giác</a>
    </p>
</div>

    <div class="content_LT_1" id="content">
        @yield('noidung')
    </div>

    <div class="img_LT_1">
        <img style="" src="{{ asset('images/img1.jpg') }}" alt="" />
        <h4 style="padding-top:10px">🎵 Tận hưởng giai điệu trong lúc học</h4>
            <br>
            <iframe  width="100%" height="300px" src="https://www.youtube.com/embed/nZtFlrwCbs4" frameborder="0" allowfullscreen></iframe>
    </div>

    </div>

    @include('Trang_Chu.footer')
    <a href="https://m.me/722689647590237" target="_blank" class="chat-fixed">
        💬 Message
      </a>

</body>
</html>
