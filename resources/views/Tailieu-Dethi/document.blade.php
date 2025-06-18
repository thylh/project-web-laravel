@extends('Gioi_thieu.layout-intro')

@section('title', 'Document')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/document.css') }}">
@endpush

@section('content')
    <main>
        <div class="container">
            {{-- <div class="sidebar">
                <h2>Danh mục</h2>
                <ul>
                    <li><a href="#">Lớp 10</a></li>
                    <li><a href="#">Lớp 11</a></li>
                    <li><a href="#">Lớp 12</a></li>
                </ul>
            </div> --}}
            <div class="content">
                <div class="content1"><h1>TÀI LIỆU - ĐỀ THI</h1></div>
                <div class="content2">
                    @forelse($documents as $doc)
                        <div class="card">
                            <h3>{{ $doc->title }}</h3>
                            <div class="box-border">
                                <p class="subject">{{ $doc->type == 'lecture' ? 'Bài giảng' : ($doc->type == 'exercise' ? 'Bài tập' : ($doc->type == 'exam' ? 'Kỳ thi' : 'Khác')) }}</p>
                                <p class="free">Miễn phí</p>
                            </div>
                            <div class="stats">
                                <span>
                                    <img src="{{ asset('/images/pic/View_light.svg') }}" alt="">
                                    <span id="doc-views-{{ $doc->id }}">{{ $doc->views ?? 0 }}</span>
                                </span>
                                <span>
                                    <img src="{{ asset('/images/pic/Import_light.svg') }}" alt="">
                                    <span id="doc-downloads-{{ $doc->id }}">{{ $doc->downloads ?? 0 }}</span>
                                </span>
                            </div>
                            <div class="buttons">
                                <a href="{{ route('document.view', $doc->id) }}" class="read">Đọc online</a>
                                <a href="{{ asset('storage/' . $doc->file_path) }}" class="down download-btn" data-id="{{ $doc->id }}" download>
                                    <img src="{{ asset('/images/pic/Import_light.svg') }}" alt="">
                                </a>
                            </div>
                        </div>
                    @empty
                        <div style="display: flex; justify-content: center;">Hiện chưa có tài liệu nào được duyệt.</div>
                    @endforelse
                </div>

                {{ $documents->links('vendors.pagination.custom') }}

            </div>
            
        </div>
    </main>
    <script>
        

        // Pagination script
    //     const pagination = document.getElementById("pagination");
    //     const totalPages = 10;
    //     let currentPage = 1;

    //     function createPagination(currentPage) {
    //     pagination.innerHTML = '';
    //     pagination.className = "pagination";

    //     const createPageItem = (text, isActive = false, isEllipsis = false) => {
    //         const span = document.createElement("div");
    //         span.className = "page-item";
    //         span.innerText = text;
    //         if (isActive) span.classList.add("active");
    //         if (!isEllipsis) {
    //         span.addEventListener("click", () => {
    //             if (text === '←') {
    //             if (currentPage > 1) createPagination(--currentPage);
    //             } else if (text === '→') {
    //             if (currentPage < totalPages) createPagination(++currentPage);
    //             } else {
    //             createPagination(+text);
    //             }
    //         });
    //         }
    //         return span;
    //     };

    //     pagination.appendChild(createPageItem('←'));

    //     if (currentPage > 3) {
    //         pagination.appendChild(createPageItem('1'));
    //         pagination.appendChild(createPageItem('...', false, true));
    //     }


    //     for (let i = currentPage - 1; i <= currentPage + 1; i++) {
    //         if (i >= 1 && i <= totalPages) {
    //             pagination.appendChild(createPageItem(i, currentPage === i));
    //         }
    //     }


    //     if (currentPage < totalPages - 1) {
    //         if (currentPage < totalPages - 2) pagination.appendChild(createPageItem('...', false, true));
    //         pagination.appendChild(createPageItem(totalPages, currentPage === totalPages));
    //     }

    //     pagination.appendChild(createPageItem('→'));
    //     }

    //     createPagination(currentPage);
    </script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.card').forEach(function (card) {
            const id = card.querySelector('.download-btn')?.dataset?.id;
            if (!id) return;

            const viewsKey = `views_${id}`;
            const downloadsKey = `downloads_${id}`;

            // Update view count
            let views = parseInt(localStorage.getItem(viewsKey)) || 0;
            views++;
            localStorage.setItem(viewsKey, views);
            const viewsEl = document.getElementById(`doc-views-${id}`);
            if (viewsEl) viewsEl.textContent = views;

            // Update download count
            let downloads = parseInt(localStorage.getItem(downloadsKey)) || 0;
            const downloadsEl = document.getElementById(`doc-downloads-${id}`);
            if (downloadsEl) downloadsEl.textContent = downloads;

            // Listen download click
            const downloadBtn = card.querySelector('.download-btn');
            if (downloadBtn) {
                downloadBtn.addEventListener('click', () => {
                    downloads++;
                    localStorage.setItem(downloadsKey, downloads);
                    if (downloadsEl) downloadsEl.textContent = downloads;
                });
            }
        });
    });
</script>

@endsection