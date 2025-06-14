@push('styles')
<link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endpush

<style>
footer {
    background-image: url("{{ asset('images/pic/4920290.jpg') }}");
}
</style>

<footer>
    <div class="footer1">
        <div><a href="{{ url('/trangchu') }}"><img src="{{ asset('images/capy.png') }}" alt="Logo_1" class="logo_ft" /></a></div>
        <div class="method">
            <div class="method1">
                <img src="{{ asset('images/pic/icon-ytb.svg') }}" alt="">
                <a style="text-decoration:none;" href="#">Youtube</a>
            </div>
            <div class="method2">
                <img src="{{ asset('images/pic/icon-fb.svg') }}" alt="">
                <a style="text-decoration:none;" href="#">Facebook</a>
            </div>
        </div>
    </div>
    <div class="footer2">
        <div class="box1">
            <h3>🏫Về Capybara Study</h3>
            <ul style="list-style: none;">
                <li><a href="#">Giới thiệu</a></li>
                <li><a href="#">Tin tức</a></li>
                <li><a href="#">Thỏa thuận sử dụng</a></li>
                <li><a href="#">Chính sách bảo mật</a></li>
            </ul>
        </div>
        <div class="box2">
            <h3>🛠Trợ giúp</h3>
            <ul style="list-style: none;">
                <li><a href="#">Câu hỏi thường gặp</a></li>
                <li><a href="#">Hotline: 1900.xxx.xxx</a></li>
                <li><a href="#">Email: Capybarastudy@gmail.com</a></li>
            </ul>
        </div>
        <div class="box3">
            <h3> 🌍Learning Center</h3>
            <ul style="list-style: none;">
                <li><a href="#">Địa chỉ: xxx, Hà Đông, Thành phố Hà Nội</a></li>
                <li><a href="#">Bản quyền thuộc về xxx</a></li>
            </ul>
        </div>
    </div>
    <div class="footer3">
        <p><b>TRANG WEB GIÁO DỤC ĐƯỢC THÀNH LẬP BỞI 5 THÀNH VIÊN</b>.<br> Dự án được thực hiện bởi sinh viên nhằm mục đích học tập và nghiên cứu.
        </p>
        <p ><b>2025 © A Student Project Of CapybaraStudy.</b></p>
    </div>
</footer>
