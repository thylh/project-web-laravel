@extends('Gioi_thieu.layout-intro')

@section('title', 'Introduce')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/introduction.css') }}">
@endpush

@section('content')
    <main>
        <div class="poster">
            <img src="{{ asset('images/pic/landingpage_2.webp') }}" alt="">
        </div>
        <div class="information">
            <h1>CAPYBARA STUDY - PHƯƠNG PHÁP HỌC HIỆU QUẢ</h1>
            <p>
                Là chương trình ôn tập, tự học
                <span style="font-weight: bold;">TOÁN</span>,
                <span style="font-weight: bold;">VĂN</span>,
                <span style="font-weight: bold;">ANH</span> và 
                <span style="font-weight: bold;">CÁC MÔN HỌC KHÁC</span> 
                trực tuyến dành cho học sinh THPT theo phương pháp mới mẻ, hiện đại, 
                giúp các con tránh được cảm giác nhàm chán với cách học trên sách vở truyền thống.
            </p>
            <p>
                <span style="color: #0b2cc0; font-weight: bold;">Capybara Study </span>giúp cho học sinh có thêm 
                một <span  style="color: #e60606; font-weight: bold;">TRẢI NGHIỆM THÚ VỊ</span>, 
                một <span  style="color: #e60606; font-weight: bold;">NGÂN HÀNG ĐỀ PHONG PHÚ</span>
                và một <span style="color: #e60606; font-weight: bold;">CÔNG CỤ TỰ HỌC HIỆU QUẢ</span>.
            </p>
        </div>

        <div class="success">
            <div class="counter-box">
                <h2 class="counter" data-target="10">0</h2>
                <p>Năm kinh nghiệm trong giáo dục</p>
            </div>
            <div class="counter-box">
                <h2 class="counter" data-target="100">0</h2>
                <p>Đề thi chất lượng</p>
            </div>
            <div class="counter-box">
                <h2 class="counter" data-target="1000">0</h2>
                <p>Dạng bài tập, lý thuyết và thực hành</p>
            </div>
            <div class="counter-box">
                <h2 class="counter" data-target="100" data-type="percent">0%</h2>
                <p>Học sinh và phụ huynh hài lòng</p>
            </div>
        </div>
        <div class="wrapper-box">
            <div class="title">
                <h1>ĐIỂM NỔI BẬT CỦA CAPYBARA STUDY</h1>
            </div>
            <div class="content-box">
                <div class="wrapper">
                    <div class="wrapper-title">Đơn giản - Dễ sử dụng</div>
                    <div class="wrapper-content">Giao diện thân thiện, thiết kế bắt mắt, 
                        chia theo các danh mục tương ứng với quy trình học tập của học sinh.</div>
                </div>
                <div class="wrapper">
                    <div class="wrapper-title">Phù hợp năng lực</div>
                    <div class="wrapper-content">Với việc chia bài theo chuyên đề 
                        dễ dàng giúp các em xây dựng lộ trình học tập phù hợp với năng lực của mình.</div>
                </div>
                <div class="wrapper">
                    <div class="wrapper-title">Bài tập có chọn lọc, phong phú và chất lượng</div>
                    <div class="wrapper-content">Thư viện với trên 1000 bài tập,
                        được soạn một cách tỉ mỉ, cẩn thận với đầy đủ chủ đề.</div>
                </div>
            </div>
        </div>
        <div class="services">
            <div class="title-services"><h1>Dịch vụ của chúng tôi</h1></div>
            <div class="services-wrapper">
                <div class="box-services">
                    <img src="{{ asset('images/pic/services1.webp') }}" alt="">
                    <div class="content-services">BỘ ĐỀ THI</div>
                </div>
                <div class="box-services">
                    <img src="{{ asset('images/pic/services2.webp') }}" alt="">
                    <div class="content-services">CHUYÊN ĐỀ, TÀI LIỆU</div>
                </div>
                <div class="box-services">
                    <img src="{{ asset('images/pic/services3.webp') }}" alt="">
                    <div class="content-services">ĐĂNG TẢI TÀI LIỆU</div>
                </div>
            </div>
        </div>
        <!-- Dịch vụ của Capybara Study -->
        <!-- <section class="services">
            <h2>Dịch vụ của Capybara Study</h2>
            <div class="service-cards">
            <div class="card red">
                <strong>Bộ đề theo khối</strong>
                <p>Chọn lọc đề thi theo lớp học, bám sát chương trình.</p>
            </div>
            <div class="card yellow">
                <strong>Tài liệu học tập</strong>
                <p>Tổng hợp lý thuyết, bài tập, hướng dẫn ôn luyện.</p>
            </div>
            <div class="card green">
                <strong>Đăng tải tài liệu</strong>
                <p>Chia sẻ tài liệu của bạn, góp phần xây dựng cộng đồng.</p>
            </div>
            </div>

            <div class="pricing">
            <h3>Gói học trọn năm chỉ từ <span class="highlight">499.000đ</span></h3>
            <p>Truy cập toàn bộ nội dung luyện đề, tài liệu, kiểm tra định kỳ và thi thử miễn phí.</p>
            <button>Đăng ký ngay</button>
            </div>
        </section>

        Học sinh nói gì -->
        <!-- <section class="testimonials">
            <h2>Học sinh nói gì về Capybara Study</h2>
            <div class="carousel" id="testimonial-carousel">
            <div class="slide active">
                <p>“Trang web rất trực quan, dễ sử dụng. Mình luyện đề mỗi ngày và thấy tiến bộ rõ rệt.”</p>
                <div class="testimonial-author">– Minh Anh, lớp 12A1</div>
            </div>
            <div class="slide">
                <p>“Kho đề thi đa dạng, phần giải thích chi tiết giúp mình hiểu sâu hơn.”</p>
                <div class="testimonial-author">– Tuấn Kiệt, lớp 11 chuyên Toán</div>
            </div>
            <div class="slide">
                <p>“Mình thích nhất là phần thi thử, rất giống thi thật. Học mà như chơi!”</p>
                <div class="testimonial-author">– Khánh Chi, lớp 9</div>
            </div>
            </div>

            <div class="dots" id="carousel-dots">
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            </div> --> 
    </main>

    <script>
        const searchBox = document.querySelector('li.search-box');
        const searchIcon = document.getElementById('searchIcon');

        searchIcon.addEventListener('click', function(e) {
            e.preventDefault(); // ngăn mặc định link # nhảy lên đầu trang
            searchBox.classList.toggle('active');
        });

        // Click ra ngoài thì ẩn menu tìm kiếm
        document.addEventListener('click', function(e) {
            if (!searchBox.contains(e.target)) {
                searchBox.classList.remove('active');
            }
        });


        
        // Đếm ngược số liệu trong phần giới thiệu
        const counters = document.querySelectorAll('.counter');
        let counterStarted = false;

        function startCount() {
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const type = counter.getAttribute('data-type'); // Kiểm tra có phải phần trăm không
                const step = target / 100;
                let count = 0;

                const updateCount = () => {
                    count += step;
                    if (count < target) {
                        if (type === 'percent') {
                            counter.innerText = Math.ceil(count) + '%';
                        } else {
                            counter.innerText = Math.ceil(count).toLocaleString();
                        }
                        requestAnimationFrame(updateCount);
                    } else {
                        if (type === 'percent') {
                            counter.innerText = target + '%';
                        } else {
                            counter.innerText = target.toLocaleString();
                        }
                    }
                };

                updateCount();
            });
        }

        window.addEventListener('scroll', () => {
            const section = document.querySelector('.success');
            const sectionTop = section.getBoundingClientRect().top;
            if (!counterStarted && sectionTop < window.innerHeight) {
                counterStarted = true;
                startCount();
            }
        });

        //
        // let currentIndex = 0;
        // const slides = document.querySelectorAll('.slide');
        // const dots = document.querySelectorAll('.dot');

        // function showSlide(index) {
        // slides.forEach((slide, i) => {
        //     slide.classList.toggle('active', i === index);
        //     dots[i].classList.toggle('active', i === index);
        // });
        // }

        // setInterval(() => {
        // currentIndex = (currentIndex + 1) % slides.length;
        // showSlide(currentIndex);
        // }, 5000); // 5 giây
    </script>
@endsection
