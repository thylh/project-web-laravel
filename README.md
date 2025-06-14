# 📚 Dự án Chia sẻ Tài liệu Học tập - Laravel

Đây là một ứng dụng web được xây dựng bằng **Laravel**, nhằm hỗ trợ sinh viên và giảng viên đăng tải, tìm kiếm và chia sẻ tài liệu học tập dễ dàng. Hệ thống phân quyền người dùng rõ ràng với chức năng duyệt tài liệu trước khi công khai.

---

## 🧰 Công nghệ và Thư viện

- **Laravel 10+** – framework PHP mạnh mẽ
- **PHP 8.1+**
- **MySQL/phpMyAdmin** – hệ quản trị cơ sở dữ liệu
- **Blade** – template engine
- **Composer** – quản lý thư viện PHP
- **Bootstrap/Tailwind** – giao diện frontend
- **Laravel Auth** – hệ thống đăng nhập & phân quyền
- **Storage** – quản lý tệp tài liệu

---

## 🚀 Tính năng

### Chức năng người dùng:
- Đăng ký / Đăng nhập / Đổi mật khẩu
- Gửi tài liệu theo quy trình 3 bước
- Xem, tìm kiếm, tải về tài liệu đã được duyệt
- Quản lý thông tin cá nhân

### Chức năng quản trị (Admin):
- Duyệt, từ chối tài liệu
- Quản lý người dùng (cấm, xóa, phân quyền)
- Thống kê số lượng tài liệu và người dùng

### Chức năng đặc biệt:
- Tìm kiếm theo từ khóa
- Hiển thị tài liệu PDF ngay trong trình duyệt
- Tải lên tệp `.pdf`, `.docx`, `.zip`...
- Xử lý file tạm, tự động xóa sau thời gian nhất định
- Tìm kiếm tài liệu theo tiêu đề/mô tả

---

## 📘 Mô tả chi tiết

### 🔐 Đăng nhập & Đăng ký

- Truy cập `/dangnhap` để đăng nhập
- Truy cập `/dangky` để tạo tài khoản mới

**Tài khoản mẫu:**

- Admin: `admin@example.com` / `admin123`
- User: Đăng ký mặc định
> Lưu ý: Admin có quyền duyệt/xóa tài liệu. Người dùng chỉ được gửi tài liệu.

---

### 🏠 Trang chủ

- Hiển thị, mô tả chung về web
- Cam kết, mục tiêu hướng tới
- Recommend của user
- Cho phép:
  - Tìm kiếm tài liệu theo tiêu đề, mô tả
  - Xem lý thuyết theo phân lớp
  - Nhấn để xem list tài liệu
  - Tải về nếu có quyền
- Nếu người dùng chưa đăng nhập, popup hoặc điều hướng sẽ yêu cầu đăng nhập khi thao tác như tải file.

---

### 📄 Trang chi tiết tài liệu

- Hiển thị nội dung tóm tắt: tiêu đề, mô tả, ngày gửi, người gửi, số lượt xem & download
- Hỗ trợ định dạng file PDF, zip, png, jpg → có thể xem trực tiếp trên trình duyệt <Các định dạng khác có thể tải về để xem>
- Nút tải về tài liệu (nếu đã được duyệt)

---

### 📤 Gửi tài liệu (User)

- Truy cập mục `Đăng tài liệu` sau khi đăng nhập
- Gửi qua **3 bước**:
  1. Duyệt file
  2. Chọn loại tài liệu & chuyên ngành & mô tả
  3. Tải lên file
- Sau khi gửi, tài liệu chờ admin duyệt

---

### 👤 Trang cá nhân

- Hiển thị thông tin người dùng
- Cho phép cập nhật:
  - Họ tên
  - Email
  - Số tài liệu đã đăng (đã duyệt)
  - Số ngày tham gia web

---

### 🛠️ Trang quản trị (Admin)

- Truy cập `/admin/dashboard` (sau khi đăng nhập với vai trò `admin`) hoặc đăng nhập với vai trò admin -> tự opentab sang `/admin/dashboard`
- Chức năng chính:
  - Duyệt, từ chối tài liệu người dùng gửi
  - Xem chi tiết từng tài liệu
  - Xem và quản lý danh sách người dùng
  - Thống kê số lượng tài liệu, lượt tải

---

## 🗂️ Cấu trúc thư mục chính

```plaintext
project-web-laravel/
├── routes/
│   └── web.php                  # Định tuyến web chính
├── app/
│   └── Http/
│       └── Controllers/         # Controllers người dùng và admin
├── resources/
│   └── views/                   # Giao diện Blade
├── storage/
│   └── app/
│       ├── public/
│       │   └── documents/       # Lưu tài liệu đã upload
│       └── tmp/                 # Lưu file tạm (sẽ tự xóa)
├── public/                      # Entry point & assets công khai
└── .env                         # Cấu hình môi trường (KHÔNG đẩy lên GitHub)
```

## ⚙️ Hướng dẫn cài đặt và chạy dự án

### Yêu cầu:
- PHP 8.1+
- Composer
- MySQL
- Laravel CLI

### Các bước cài đặt:

```bash
# Clone dự án
git clone https://github.com/thylh/project-web-laravel.git
cd project-web-laravel

# Cài thư viện PHP
composer install

# Tạo file môi trường
cp .env.example .env

# Tạo key và migrate database
php artisan key:generate
php artisan migrate

# Tạo seeder (Tài khoản Admin)
php artisan db:seed

# Tạo folder lưu data
/storage/app/public/documents/ --Folder lưu data chính
/storage/app/tmp/ --Folder lưu data tạm
php artisan storage:link

# Chạy ứng dụng
php artisan serve

