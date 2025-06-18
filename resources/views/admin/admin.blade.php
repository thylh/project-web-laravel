<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Trang mặc định')</title>
    
     @yield('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/layoutsAdmin.css') }}">
    <style>
        .cube-container {
            width: 80px;
            height: 80px;
            perspective: 800px;
            margin: 10px auto;
        }

        .cube {
            width: 100%;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            animation: rotateCube 8s infinite ease-in-out;
        }

        .face {
            position: absolute;
            width: 80px;
            height: 80px;
            background: transparent; /* Nền trong suốt */
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            font-size: 14px;
            color: #fff; /* Hoặc màu phù hợp với nền bạn đang dùng */
            backface-visibility: hidden;
            border-radius: 10px;
        }

        .face img {
            width: 50px;
            height: 50px;
        }

        /* Định vị 4 mặt */
        .front  { transform: rotateY(   0deg) translateZ(40px); }
        .right  { transform: rotateY(  90deg) translateZ(40px); }
        .back   { transform: rotateY( 180deg) translateZ(40px); }
        .left   { transform: rotateY( -90deg) translateZ(40px); }

        /* Xoay 4 mặt + delay giữa các lần chuyển */
        @keyframes rotateCube {
            0%   { transform: rotateY(0deg); }
            20%  { transform: rotateY(0deg); }
            25%  { transform: rotateY(90deg); }
            45%  { transform: rotateY(90deg); }
            50%  { transform: rotateY(180deg); }
            70%  { transform: rotateY(180deg); }
            75%  { transform: rotateY(270deg); }
            95%  { transform: rotateY(270deg); }
            100% { transform: rotateY(360deg); }
        }
    </style>
</head>
<body>

        <div class="contain">
            <div class="navigation">
                <ul>
                    <li>
                        <div class="cube-container">
                            <div class="cube">
                                <div class="face front">
                                    <img src="{{ asset('images/pic/logo.png') }}" alt="Logo" />
                                </div>
                                <div class="face right">
                                    <span>ADMIN</span>
                                </div>
                                <div class="face back">
                                    <img src="{{ asset('images/pic/logo.png') }}" alt="Logo" />
                                </div>
                                <div class="face left">
                                    <span>ADMIN</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
    
                        <a href="{{ route('admin.dashboard.home') }}">
                            <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                            <span class="title">Dashboard</span>
                        </a>
    
                    </li>
                    <li>
                        <a href="{{ Route('admin.document.index') }}">
                            <span class="icon"><ion-icon name="document-text-outline"></ion-icon></span>
                            <span class="title">Document</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ Route('admin.users.index') }}">
                            <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                            <span class="title">User</span>
                        </a>

                    </li>

                    <li>
                        <a href="{{ Route('admin.categories.index') }}">
                            <span class="icon"><ion-icon name="folder-outline"></ion-icon></span>
                            <span class="title">Category</span>
                        </a>

                    </li>

                    <li>
                        <a href="{{ route('admin.upload.create') }}">
                            <span class="icon">
                                <ion-icon name="cloud-upload-outline"></ion-icon>
                            </span>
                            <span class="title">Upload</span>
                        </a>
                        
                    </li>

                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="icon"><ion-icon name="exit-outline"></ion-icon></span>
                            <span class="title">Logout</span>
                        </a>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        
                        
                    </li>
                </ul>
            </div>
            <div class="main">
                <div class="topbar">
                    <div class="toggle">
                        <ion-icon name="menu-outline"></ion-icon>
                    </div>
    
                    <div class="search">
                        <label >
                            <input type="text" placeholder="Search here" > 
                            <ion-icon name="search-outline"></ion-icon>
                        </label>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
</body>
</html>
