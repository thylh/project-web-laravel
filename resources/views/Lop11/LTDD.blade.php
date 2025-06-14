@extends('Lop11.lythuyet_11')

@section('noidung')
<div style="background-image: url('{{ asset('images/l10/bgr-class.jpg') }}'); 
            background-repeat: no-repeat; 
            background-size: cover; 
            background-position: center; 
            padding: 20px; 
            height: 100%; 
            width: 100%;">

    <h1 style="display: flex; justify-content: center; padding-top: 20px; color: blue;">
        <i>TỔNG HỢP LÝ THUYẾT ĐẦY ĐỦ</i>
    </h1>

    <p>
        <h4 style="padding-top: 20px; padding-left: 60px;">Lý thuyết Chương 1: Mệnh đề và tập hợp</h4><br>
        <a style="padding-left: 120px; text-decoration: none;" href="/11-bai1">Bài 1: Mệnh đề</a> <br><br>
        <a style="padding-left: 120px; text-decoration: none;" href="/11-bai2">Bài 2: Tập hợp các phép toán trên tập hợp</a>

        <h4 style="padding-top: 20px; padding-left: 60px;">Lý thuyết Chương 2: Bất phương trình và hệ bất phương trình bậc nhất hai ẩn</h4><br>
        <a style="padding-left: 120px; text-decoration: none;" href="/11-bai1">Bài 3: Bất phương trình bậc nhất hai ẩn</a> <br><br>
        <a style="padding-left: 120px; text-decoration: none;" href="/11-bai2">Bài 4: Hệ bất phương trình bậc nhất hai ẩn</a>

        <h4 style="padding-top: 20px; padding-left: 60px;">Lý thuyết Chương 3: Hệ thức lượng trong tam giác</h4><br>
        <a style="padding-left: 120px; text-decoration: none;" href="/11-bai1">Bài 4: Giá trị lượng giác của một góc từ 0⁰ đến 180⁰</a> <br><br>
        <a style="padding-left: 120px; text-decoration: none;" href="/11-bai2">Bài 5: Hệ thức lượng giác trong tam giác</a>
    </p>
</div>
@endsection
