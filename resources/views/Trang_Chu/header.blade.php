<head>
<link rel="stylesheet" href="{{ asset('css/header.css') }}" />
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>


<body >
    <header>
        <nav class="navbar">
            <div class="navbar1">
                <div class="hotline">
                    <i class="fas fa-phone-alt"></i>
                    <span style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Hotline: <a style="color: #0b2cc0;" href="">1900.xxx.xxx</a></span>
                </div>
                {{-- <div class="login">
                    <ul style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                        @if(Auth::check())
                            <li>
                                👋 Xin chào, {{ Auth::user()->name }} ({{ Auth::user()->role }})<button class="dropdown-toggle">▾</button>
                            </li>
                            <li>
                                <div class="dropdown-menu">
                                    <a href="{{ url('/user/profile') }}">Thông tin cá nhân</a>
                                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" style="background: none; border: none; color: blue; cursor: pointer; font-family: inherit;">
                                            Đăng xuất
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @else
                            <li><a href="{{ url('/dangky') }}">Đăng ký</a></li>
                            <li>|</li>
                            <li><a href="{{ url('/dangnhap') }}">Đăng nhập</a></li>
                        @endif
                    </ul>
                </div> --}}
                <div class="login">
                    <ul style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                        @if(Auth::check())
                            <li class="dropdown" style="position: relative;">
                                👋 Hi, {{ Auth::user()->name }}
                                <button class="dropdown-toggle" onclick="toggleDropdown(this)">▾</button>

                                <div class="dropdown-menu">
                                    @if(Auth::user()->role === 'user')
                                        <a href="{{ url('/user/profile') }}">Thông tin cá nhân</a>
                                        <a href="{{ route('password.form') }}">Đổi mật khẩu</a>
                                    @elseif(Auth::user()->role === 'admin')
                                        <button type="button" onclick="redirectAdmin()">Quản trị</button>
                                    @endif

                                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                        @csrf
                                        <button type="submit">Đăng xuất</button>
                                    </form>
                                </div>

                                @if(Auth::user()->role === 'admin')
                                <script>
                                    function redirectAdmin() {
                                        window.open('{{ url('/admin/dashboard') }}', '_blank');
                                        window.location.href = '{{ url('/') }}';
                                    }
                                </script>
                                @endif
                                
                            </li>
                        @else
                            <li><a href="{{ url('/dangky') }}">Đăng ký</a></li>
                            <li>|</li>
                            <li><a href="{{ url('/dangnhap') }}">Đăng nhập</a></li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="navbar2">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/capy.png') }}" alt="Logo" class="logo">
                </a>

                {{-- <img src="{{ asset('images/capy.png') }}" alt="Logo" class="logo"> --}}
                <ul class="menu">
                    <li style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"><a href="#">LỚP HỌC</a>
                        <ul class="dropmenu1">
                            <li><a href="{{ route('lop10') }}">Lớp 10</a></li>
                            <li><a href="{{ route('lop11') }}">Lớp 11</a></li>
                            <li><a href="{{ route('lop12') }}">Lớp 12</a></li>
                        </ul>
                    </li>
                    <li style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"><a href="{{ url('/Document') }}">ĐỀ THI - TÀI LIỆU</a></li>
                    <li style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"><a href="{{ url('/upload') }}">ĐĂNG TÀI LIỆU</a></li>
                    <li style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"><a href="{{ url('/gioithieu') }}">GIỚI THIỆU</a></li>
                    <li style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;" class="search-box">
                        <a href="#" id="searchIcon"><i class="fas fa-search"></i></a>
                        {{-- <ul class="dropmenu2">
                            <li><a href="#"><input type="text" placeholder="Tìm kiếm..."></a></li>
                            <li><a href="#"><i class="fas fa-search"></i></a></li> 
                        </ul> --}}
                        <form action="{{ route('documents.search') }}" method="GET">
                            <ul class="dropmenu2">
                                <li>
                                    <input 
                                        type="text" 
                                        name="query" 
                                        placeholder="Tìm kiếm..." 
                                        required
                                    >
                                </li>
                                <li>
                                    <button type="submit" style="all: unset; cursor: pointer;">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </li>
                            </ul>
                        </form>
                    </li>
                </ul>   
            </div>
        </nav>
    </header>
    {{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchIcon = document.getElementById('searchIcon');
        const searchBox = searchIcon.closest('.search-box');

        searchIcon.addEventListener('click', function(e) {
            e.preventDefault();  // Ngăn trình duyệt thực hiện mặc định của thẻ <a>
            searchBox.classList.toggle('active');
        });
    });
    </script>
    <script>
        function toggleDropdown(button) {
            const menu = button.nextElementSibling;
            const isVisible = menu.style.display === 'block';
            // Ẩn tất cả dropdown trước khi mở
            document.querySelectorAll('.dropdown-menu').forEach(m => m.style.display = 'none');
            menu.style.display = isVisible ? 'none' : 'block';
        }

        // Ẩn dropdown khi click ra ngoài
        window.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown-menu').forEach(m => m.style.display = 'none');
            }
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchIcon = document.getElementById('searchIcon');
            if (searchIcon) {
                const searchBox = searchIcon.closest('.search-box');

                searchIcon.addEventListener('click', function (e) {
                    e.preventDefault();
                    searchBox.classList.toggle('active');
                });
                document.addEventListener('click', function (e) {
                    if (!searchBox.contains(e.target)) {
                        searchBox.classList.remove('active');
                    }
                });
            }
            window.toggleDropdown = function (button) {
                const menu = button.nextElementSibling;
                const isVisible = menu.style.display === 'block';

                document.querySelectorAll('.dropdown-menu').forEach(m => m.style.display = 'none');
                if (!isVisible) {
                    menu.style.display = 'block';
                }
            };
            window.addEventListener('click', function (e) {
                if (!e.target.closest('.dropdown')) {
                    document.querySelectorAll('.dropdown-menu').forEach(m => m.style.display = 'none');
                }
            });
        });
    </script>
</body>
</style>
