<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrangChuController;
use App\Http\Controllers\LopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UploadController;

// Chỉ nên giữ 1 route cho "/"
// Route::get('/', function () {
//     return view('WELCOME');
// });

// Các route test
Route::get('/test-head', function () {
    return view('Trang_chu.header');
});

Route::get('/test-body', function () {
    return view('Trang_chu.body');
});
// Trang chủ sử dụng controller
Route::get('/', [TrangChuController::class, 'index']);

// Route cho lớp 10 (chỉ chọn 1 method)

Route::get('/lop10', [LopController::class, 'lop10'])->name('lop10');

// Route cho lớp 11
Route::get('/lop11', [LopController::class, 'lop11'])->name('lop11');

//r lớp 12
Route::get('/lop12', [LopController::class, 'lop12'])->name('lop12');

// hoặc nếu bạn muốn dùng showLop10 thì sửa lại:
# Route::get('/lop10', [LopController::class, 'showLop10'])->name('lop10');

Route::get('/lythuyet_10', function () {
    return view('Lop10.lythuyet_10');
});

Route::get('/lythuyet_11', function () {
    return view('Lop11.lythuyet_11');
});
Route::get('/lythuyet_12', function () {
    return view('Lop12.lythuyet_12');
});




// Tạo route cho bài 1
// web.php
// Lớp 10
Route::get('/lop10/bai1', function () {
    return view('Lop10.Bai1');
})->name('lop10.bai1');

Route::get('/lop10/bai2', function () {
    return view('Lop10.Bai2');
})->name('lop10.bai2');

Route::get('/lop10/ltdd', function () {
    return view('Lop10.LTDD');
})->name('lop10.ltdd');

Route::get('/lop10/lythuyet', function () {
    return view('Lop10.lythuyet_10');
})->name('lop10.lythuyet');
Route::get('/10-bai1', function () {
    return view('Lop10.Bai1');
});
Route::get('/10-bai2', function () {
    return view('Lop10.Bai2');
});
Route::get('/Lop10/Bai2', function () {
    return view('Lop10.Bai2');
});

Route::get('/Lop10/Bai1', function () {
    return view('Lop10.Bai1');
});

// Lớp 11
Route::get('/lop11/bai1', function () {
    return view('Lop11.Bai1');
})->name('lop11.bai1');

Route::get('/lop11/bai2', function () {
    return view('Lop11.Bai2');
})->name('lop11.bai2');

Route::get('/lop11/ltdd', function () {
    return view('Lop11.LTDD');
})->name('lop11.ltdd');

Route::get('/lop11/lythuyet', function () {
    return view('Lop11.lythuyet_11');
})->name('lop11.lythuyet');
Route::get('/11-bai1', function () {
    return view('Lop11.Bai1');
});
Route::get('/11-bai2', function () {
    return view('Lop11.Bai2');
});
Route::get('/Lop11/Bai2', function () {
    return view('Lop11.Bai2');
});

Route::get('/Lop11/Bai1', function () {
    return view('Lop11.Bai1');
});

// Lớp 12
Route::get('/lop12/bai1', function () {
    return view('Lop12.Bai1');
})->name('lop12.bai1');

Route::get('/lop12/bai2', function () {
    return view('Lop12.Bai2');
})->name('lop12.bai2');

Route::get('/lop12/ltdd', function () {
    return view('Lop12.LTDD');
})->name('lop12.ltdd');

Route::get('/lop12/lythuyet', function () {
    return view('Lop12.lythuyet_12');
})->name('lop12.lythuyet');
Route::get('/12-bai1', function () {
    return view('Lop12.Bai1');
});
Route::get('/12-bai2', function () {
    return view('Lop12.Bai2');
});
Route::get('/Lop12/Bai2', function () {
    return view('Lop12.Bai2');
});

Route::get('/Lop12/Bai1', function () {
    return view('Lop12.Bai1');
});

//Phần Login-res-out-change
Route::get('/dangnhap', [AuthController::class, 'showLogin'])->name('login');
Route::post('/dangnhap', [AuthController::class, 'login'])->middleware('throttle:5,1');;

Route::get('/dangky', [AuthController::class, 'showRegister'])->name('register');
Route::post('/dangky', [AuthController::class, 'register']);

Route::post('/dangxuat', [AuthController::class, 'logout'])->name('logout')->middleware('auth');;

Route::get('/doimatkhau', [AuthController::class, 'showChangePasswordForm'])->name('password.form')->middleware('auth');
Route::post('/doimatkhau', [AuthController::class, 'changePassword'])->name('password.change')->middleware('auth');

// Giới thiệu
Route::get('/gioithieu', function () {
    return view('Gioi_thieu.introduction');
});

// Document
use App\Http\Controllers\DocumentController;

Route::get('/Document', [DocumentController::class, 'index'])->name('documents.index');
Route::get('/document/view/{id}', [DocumentController::class, 'view'])->middleware('auth')->name('document.view');
// Route::get('/Document', function () {
//     return view('Tailieu-Dethi.document');
// });
Route::get('/search', [DocumentController::class, 'search'])->name('documents.search');

//Upload
Route::middleware('auth')->group(function () {
    Route::prefix('upload')->group(function () {
        Route::get('/', [UploadController::class, 'step1'])->name('upload.step1');
        Route::post('/', [UploadController::class, 'postStep2'])->name('upload.step2.post');
        Route::get('/info', [UploadController::class, 'step2'])->name('upload.step2');
        Route::post('/info', [UploadController::class, 'postStep3'])->name('upload.step3');
    });
});


use App\Http\Controllers\Admin\DocumentReviewController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\CheckRole;

// User profile
Route::middleware(CheckRole::class . ':user')->group(function () {
    Route::get('/user/profile', [AuthController::class, 'profile']);
});

//viewAdmin
Route::middleware([CheckRole::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'home'])->name('admin.dashboard.home');
    Route::get('/admin/documents', [DocumentReviewController::class, 'index'])->name('admin.document.index');
    Route::post('/dashboard/documents/{id}/approve', [DocumentReviewController::class, 'approve'])->name('admin.dashboard.approve');
    Route::post('/dashboard/documents/{id}/reject', [DocumentReviewController::class, 'reject'])->name('admin.dashboard.reject');
    Route::get('/users', [DashboardController::class, 'index'])->name('admin.users.index');
    Route::delete('/users/{id}', [DashboardController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/documents/approved', [DocumentReviewController::class, 'approved'])->name('admin.documents.approved');
    Route::delete('/admin/documents/{id}', [DocumentReviewController::class, 'destroy'])->name('admin.document.destroy');
});

Route::get('/redirect-admin', function () {
    return view('admin.redirect-admin');
});

// upload file admin
use App\Http\Controllers\Admin\AdminUploadController;

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/upload', [AdminUploadController::class, 'create'])->name('admin.upload.create');
    Route::post('/upload', [AdminUploadController::class, 'store'])->name('admin.upload.store');
});
//danh muc 
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
});
