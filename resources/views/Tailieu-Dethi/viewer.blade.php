@extends('Gioi_thieu.layout-intro')

@section('title', '[{{ $document->category->name ?? "Tài liệu" }}] {{ $document->title }}')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/details.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
@endpush

@section('content')
<main>
    <div class="container">
        {{-- Sidebar danh mục lớp --}}
        <div class="sidebar">
            <h3>Danh mục</h3>
            <ul>
                @foreach ($categories as $cat)
                    <li>
                        <a href="{{ route('documents.index', ['category_id' => $cat->id]) }}"
                           class="{{ ($document->category_id ?? null) == $cat->id ? 'active' : '' }}">
                            {{ $cat->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Nội dung tài liệu --}}
        <div class="content">
            <h2>[{{ $document->category->name ?? '' }}] {{ $document->title }}</h2>

            <div class="icon">
                <ul>
                    <li><div class="iconn"><img src="{{ asset('images/pic/icon-doc-1.svg') }}" alt=""></div><div class="number" id="doc-pages">0</div></li>
                    <li><div class="iconn"><img src="{{ asset('images/pic/icon-doc-2.svg') }}" alt=""></div><div class="number" id="doc-views">0</div></li>
                    <li><div class="iconn"><img src="{{ asset('images/pic/icon-doc-3.svg') }}" alt=""></div><div class="number" id="doc-downloads">0</div></li>
                    <li><div class="iconn"><img src="{{ asset('images/pic/icon-doc-4.svg') }}" alt=""></div><div class="number">{{ $document->user->name ?? 'Ẩn danh' }}</div></li>
                    <li><div class="iconn"><img src="{{ asset('images/pic/icon-doc-5.svg') }}" alt=""></div><div class="number">{{ $document->created_at->format('d/m/Y') }}</div></li>
                </ul>
            </div>

            {{-- Viewer PDF --}}
            <div class="pdf-viewer">
                <div class="toolbar">
                    <button id="zoom-out">➖</button>
                    <span id="zoom-percent">100%</span>
                    <button id="zoom-in">➕</button>
                    <input type="range" id="zoom-slider" min="50" max="150" value="100" step="10" />
                    <div style="margin-left: auto;">
                        Trang <span id="current-page">1</span> / <span id="total-pages">?</span>
                    </div>
                </div>
                <div class="pdf-container-wrapper">
                    <div class="pdf-container" id="pdf-container"></div>
                </div>
            </div>

            {{-- Tiến độ đọc --}}
            <div class="reading-progress-bar-wrapper">
                <div id="reading-progress-bar"></div>
            </div>
            <div class="reading-progress-info">
                <span id="pages-left">Còn ? trang</span>
                <span id="page-status">Trang ? / ?</span>
                <span id="percent-read">0% đã đọc</span>
            </div>

            {{-- Tải xuống --}}
            <div class="download">
                @auth
                    <a href="{{ $fileUrl }}" download><button>Tải xuống</button></a>
                @else
                    <button onclick="alert('Bạn cần đăng nhập để tải tài liệu');">Tải xuống</button>
                @endauth
            </div>

            {{-- Tài liệu liên quan --}}
            <div class="related-docs">
                <h2>Tài liệu bạn có thể quan tâm</h2>
                <div class="doc-list">
                    @foreach ($relatedDocs as $doc)
                        <div class="doc-card">
                            <img src="{{ asset('images/pic/icon-doc-1.svg') }}" alt="">
                            <a href="{{ route('document.view', $doc->id) }}">
                                [{{ $doc->category->name ?? '' }}] {{ $doc->title }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    const url = "{{ $fileUrl }}"; // file đã kiểm tra tồn tại từ controller
    const filename = "{{ $document->id }}";
    const viewsEl = document.getElementById('doc-views');
    const downloadsEl = document.getElementById('doc-downloads');

    // Lượt xem
    const viewsKey = `views_${filename}`;
    let views = parseInt(localStorage.getItem(viewsKey)) || 0;
    views++;
    localStorage.setItem(viewsKey, views);
    if (viewsEl) viewsEl.textContent = views;

    // Lượt tải
    const downloadsKey = `downloads_${filename}`;
    let downloads = parseInt(localStorage.getItem(downloadsKey)) || 0;
    if (downloadsEl) downloadsEl.textContent = downloads;

    const downloadBtn = document.querySelector('.download a[download]');
    if (downloadBtn) {
        downloadBtn.addEventListener('click', () => {
            downloads++;
            localStorage.setItem(downloadsKey, downloads);
            if (downloadsEl) downloadsEl.textContent = downloads;
        });
    }

    // PDF Viewer
    let pdfDoc = null;
    let scale = 1;
    const container = document.getElementById('pdf-container');
    const zoomSlider = document.getElementById('zoom-slider');
    const zoomPercent = document.getElementById('zoom-percent');
    const currentPageEl = document.getElementById('current-page');
    const totalPagesEl = document.getElementById('total-pages');
    const pdfWrapper = document.querySelector('.pdf-container-wrapper');
    const progressBar = document.getElementById('reading-progress-bar');
    const percentReadEl = document.getElementById('percent-read');
    const pageStatusEl = document.getElementById('page-status');
    const pagesLeftEl = document.getElementById('pages-left');

    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    pdfjsLib.getDocument(url).promise.then(pdf => {
        pdfDoc = pdf;
        totalPagesEl.textContent = pdf.numPages;
        const pagesEl = document.getElementById('doc-pages');
        if(pagesEl) pagesEl.textContent = pdf.numPages;
        renderAllPages();
    });

    function renderAllPages() {
        container.innerHTML = '';
        for (let pageNum = 1; pageNum <= pdfDoc.numPages; pageNum++) {
            pdfDoc.getPage(pageNum).then(page => {
                const viewport = page.getViewport({ scale: 1 });
                const canvas = document.createElement('canvas');
                const wrapper = document.createElement('div');
                wrapper.className = 'canvas-wrapper';
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                wrapper.appendChild(canvas);
                container.appendChild(wrapper);
                page.render({ canvasContext: context, viewport }).promise.then(() => {
                    canvas.dataset.baseWidth = canvas.width;
                    canvas.dataset.baseHeight = canvas.height;
                    updateZoom();
                });
            });
        }
    }

    function updateZoom() {
        const zoomValue = parseInt(zoomSlider.value);
        scale = zoomValue / 100;
        zoomPercent.textContent = `${zoomValue}%`;
        document.querySelectorAll('.pdf-container canvas').forEach(canvas => {
            canvas.style.transform = `scale(${scale})`;
            const wrapper = canvas.parentElement;
            wrapper.style.width = `${canvas.dataset.baseWidth}px`;
            wrapper.style.height = `${canvas.dataset.baseHeight}px`;
        });
    }

    zoomSlider.addEventListener('input', updateZoom);
    document.getElementById('zoom-in').addEventListener('click', () => {
        let val = parseInt(zoomSlider.value);
        if (val < 200) {
            zoomSlider.value = val + 10;
            updateZoom();
        }
    });
    document.getElementById('zoom-out').addEventListener('click', () => {
        let val = parseInt(zoomSlider.value);
        if (val > 50) {
            zoomSlider.value = val - 10;
            updateZoom();
        }
    });

    pdfWrapper.addEventListener('scroll', () => {
        const scrollTop = pdfWrapper.scrollTop;
        const scrollHeight = pdfWrapper.scrollHeight - pdfWrapper.clientHeight;
        const percent = Math.min(100, Math.round((scrollTop / scrollHeight) * 100));
        progressBar.style.width = `${percent}%`;
        percentReadEl.textContent = `${percent}% đã đọc`;
        const totalPages = pdfDoc ? pdfDoc.numPages : 1;
        const approxPage = Math.min(totalPages, Math.max(1, Math.round((scrollTop / scrollHeight) * totalPages)));
        const remainingPages = totalPages - approxPage;
        pageStatusEl.textContent = `Trang ${approxPage} / ${totalPages}`;
        pagesLeftEl.textContent = `Còn ${remainingPages} trang`;
    });
</script>
@endpush
