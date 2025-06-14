<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Trang Lớp 11</title>

    {{-- Link CSS riêng cho header và footer và file css riêng của lop10 --}}
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    <link rel="stylesheet" href="{{ asset('css/lop10.css') }}">
</head>
<body>
    @include('Trang_Chu.header')

    <img class="glow" style="height:330px; width: 100%;" src="{{ asset('images/pic1.jpg') }}" alt="Ảnh lớp 11" />

    <div class="lop10">
        <div class="lop10_1">
            <h1 style="padding-top: 100px;padding-left: 110px;"><a href="{{ url('/lythuyet_11') }}">Toán lớp 11</a></h1>
        <div style="display: flex;padding-top:30px">
            <a href="{{ url('/lythuyet_11') }}"><img  src="{{ asset('images/pic3.jpg') }}" alt="Ảnh pic3" /></a>
           <p style="margin-left:30px; margin-top:50px"> <a class="lythuyet" style="text-decoration:none; font-size: 19px;" href="{{ url('/lythuyet_11') }}">Lý thuyết Toán lớp 11</a>
            <br> <br>
           Lý thuyết Toán lớp 11 được hệ thống hoá và phân loại chi tiết theo từng chuyên đề trọng tâm, bám sát nội dung chương trình SGK. Mỗi chuyên đề đều được biên soạn khoa học, đa dạng và có tính mở rộng, nâng cao, giúp học sinh tiếp cận kiến thức một cách chắc chắn, rèn luyện tư duy toán học từ cơ bản đến nâng cao.
            </p>
        </div>
        <div class="lop10_1">
            <div style="display: flex;padding-top:60px;">
            <a href="{{ url('/lythuyet_10') }}"><img  src="{{ asset('images/pic3.jpg') }}" alt="Ảnh pic3" /></a>
           <p style="margin-left:30px; margin-top:50px"> <a class="lythuyet" style="text-decoration:none; font-size: 19px;" href="{{ url('/lythuyet_11') }}">Ôn tập Toán lớp 11</a>
            <br> <br>
           Tổng hợp chuyên đề Toán lớp 11 với cấu trúc mạch lạc, đầy đủ các kiến thức trọng tâm từ sách giáo khoa. Tài liệu này không chỉ giúp học sinh ôn tập kỹ lưỡng mà còn phát triển kỹ năng giải toán, tư duy logic và sáng tạo thông qua hệ thống bài tập phong phú, từ cơ bản đến nâng cao.
            </p>
        </div>

        </div>
    </div>
        <div class="lop10_2">
            
        </div>
    </div>
        @include('Trang_Chu.footer')

</body>
</html>
