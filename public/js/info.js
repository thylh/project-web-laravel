        // Ngày đăng ký (có thể thay đổi động nếu cần)
        const registrationDate = new Date("2025-01-06"); // YYYY-MM-DD
        // Lấy ngày hôm nay
        const today = new Date();
        // Tính số mili giây chênh lệch
        const diffTime = today - registrationDate;
        // Chuyển thành số ngày ( làm tròn xuống )
        const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
        // Gán vào span
        document.getElementById("joined-days").textContent = `${diffDays} ngày`;

        window.addEventListener('DOMContentLoaded', () => {
            // 1. Lấy giới tính và đặt avatar trong sidebar
            const gender = document.getElementById("gender").textContent.trim().toLowerCase();
            const avatarDiv = document.querySelector(".avatar");
            let avatarSrc = 'pic/avatar-dafault.png'; // Mặc định nếu k có giới tính
            if (gender === "nữ") {
                avatarSrc = 'pic/default-nu.webp';
            } else if (gender === "nam") {
                avatarSrc = 'pic/default-nam.webp';
            }
            avatarDiv.style.backgroundImage = `url('${avatarSrc}')`;

            // 2. Thông tin người dùng
            const user = {
                name: 'Hoàng Bảo Trang',
                avatar: avatarSrc
            };

            // 3. Ẩn login section, hiển thị user navbar với avatar + tên
            document.getElementById('login-section').style.display = 'none';
            const userNavbar = document.getElementById('user-navbar');
            userNavbar.style.display = 'flex';
            userNavbar.querySelector('.avatar-mini').src = user.avatar;
            userNavbar.querySelector('.username-mini').textContent = user.name;

            // 4. Toggle dropdown menu khi nhấn vào avatar + tên
            const userToggle = userNavbar.querySelector('.user-toggle');
            const dropdownMenu = document.getElementById('dropdown-menu');
            userToggle.addEventListener('click', function (e) {
                e.stopPropagation();
                dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
            });

            // 5. Click ngoài thì ẩn dropdown
            document.addEventListener('click', function (e) {
                if (!userNavbar.contains(e.target)) {
                    dropdownMenu.style.display = 'none';
                }
            });

            // 6. Xử lý Đăng xuất (giả lập)
            document.getElementById('logout-link').addEventListener('click', function (e) {
                e.preventDefault();
                alert('Đã đăng xuất!');
                location.reload(); // Hoặc chuyển về trang đăng nhập
            });
        });