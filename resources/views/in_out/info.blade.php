@extends('Gioi_thieu.layout-intro')

@section('title', 'Thông tin cá nhân')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/info.css') }}">
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" /> --}}
@endpush

@push('scripts')
<script>
window.addEventListener('DOMContentLoaded', () => {
    const genderSelect = document.getElementById("gender");
    const avatarDiv = document.querySelector(".avatar");
    const userNavbar = document.getElementById('user-navbar');
    const loginSection = document.getElementById('login-section');
    const dropdownMenu = document.getElementById('dropdown-menu');
    const logoutLink = document.getElementById('logout-link');

    function getAvatarSrc(gender) {
        gender = gender.toLowerCase();
        if (gender === "nữ") {
            return "{{ asset('images/pic/default-nu.webp') }}";
        } else if (gender === "nam") {
            return "{{ asset('images/pic/default-nam.webp') }}";
        } else {
            return "{{ asset('images/pic/default.png') }}";
        }
    }

    function updateAvatar(gender) {
        const src = getAvatarSrc(gender);
        avatarDiv.style.backgroundImage = `url('${src}')`;
        // Nếu có avatar mini
        const avatarMini = document.querySelector(".avatar-mini");
        if (avatarMini) {
            avatarMini.src = src;
        }
    }

    // Cập nhật avatar lần đầu
    updateAvatar(genderSelect.value);

    // Cập nhật khi người dùng thay đổi
    genderSelect.addEventListener("change", () => {
        updateAvatar(genderSelect.value);
    });

    // Navbar xử lý đơn giản
    if (loginSection && userNavbar) {
        loginSection.style.display = 'none';
        userNavbar.style.display = 'flex';
        userNavbar.querySelector('.username-mini').textContent = "{{ Auth::user()->name }}";
    }

    // Dropdown xử lý
    const userToggle = userNavbar.querySelector('.user-toggle');
    userToggle.addEventListener('click', function (e) {
        e.stopPropagation();
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    });

    document.addEventListener('click', function (e) {
        if (!userNavbar.contains(e.target)) {
            dropdownMenu.style.display = 'none';
        }
    });

    logoutLink?.addEventListener('click', function (e) {
        e.preventDefault();
        alert('Đã đăng xuất!');
        location.reload();
    });        
});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const registrationDate = new Date("{{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('Y-m-d') }}T00:00:00");
        const today = new Date();
        registrationDate.setHours(0, 0, 0, 0);
        today.setHours(0, 0, 0, 0);
        const diffTime = today - registrationDate;
        const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
        document.getElementById("joined-days").textContent = `${diffDays} ngày`;
    });
</script>
@endpush

@section('content')
    <main>
        <div class="sidebar">
            <div class="profile1">
                <div class="avatar-box">
                    <div class="avatar"></div>
                    <span class="status-dot"></span>
                </div>
                <div class="user-info">
                    <h3>{{ Auth::user()->name }}</h3>
                    {{-- <p>#cuune</p> --}}
                    <p class="highlight">Chào mừng trở lại!</p>
                </div>
            </div>
            <div class="profile2">
                <div class="highlight">Thông tin cá nhân</div>
                <div class="next">&gt;</div>
            </div>
        </div>
        <div class="container">
            <h2>Thông tin</h2>
            <div class="info">
                <p><span class="label">Họ và tên:</span> <span class="value">{{ Auth::user()->name }}</span></p>
                <p><span class="label">Giới tính:</span> <span>
                    <select name="gender" id="gender" class="value">
                        <option value="Nam">Nam</option>
                        <option value="Nữ" selected>Nữ</option>
                        <option value="Khác">Khác</option>
                    </select> 
                </span></p>    
                <p><span class="label">E-mail:</span> <span class="value">{{ Auth::user()->email }}</span></p>
                <p><span class="label">Tỉnh/Thành phố:</span> <span class="value">Chưa biết</span></p>
                <p><span class="label">Quận/Huyện:</span> <span class="value"> Chưa biết</span></p>
                {{-- <p><span class="label">Khối/Lớp:</span> <span class="value">Lớp 5</span></p> --}}
                <p><span class="label">Tài liệu đã đăng:</span> <span class="value">{{ $documentCount }}</span></p>
                <p><span class="label">Đã tham gia:</span> <span class="value" id="joined-days"></span></p>
            </div>
            {{-- <div class="footer-notes">
                <div class="change">
                    <a href="{{ route('password.form') }}">
                        <button type="button" class="change-password">Đổi mật khẩu</button>
                    </a>
                </div>
            </div> --}}
        </div>
    </main>
@endsection