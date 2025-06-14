@extends('Gioi_thieu.layout-intro')

@section('title', 'Đọc tài liệu')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/details.css') }}">
@endpush

@section('content')
<main>
    <div class="container">
        {{-- <div class="sidebar">
            <h3>Danh mục</h3>
            <ul>
                <li><a href="#">Lớp 10</a></li>
                <li><a href="#">Lớp 11</a></li>
                <li><a href="#">Lớp 12</a></li>
            </ul>
        </div> --}}
        <div class="content">
            <h2>{{ $document->title }}</h2>
            <div class="icon">
                <ul>
                    <li><div class="iconn"><img src="{{ asset('images/pic/icon-doc-1.svg') }}" alt=""></div><div class="number" id="doc-pages">0</div></li>
                    <li><div class="iconn"><img src="{{ asset('images/pic/icon-doc-2.svg') }}" alt=""></div><div class="number" id="doc-views">0</div></li>
                    <li><div class="iconn"><img src="{{ asset('images/pic/icon-doc-3.svg') }}" alt=""></div><div class="number" id="doc-downloads">0</div></li>
                    <li><div class="iconn"><img src="{{ asset('images/pic/icon-doc-4.svg') }}" alt=""></div><div class="number">{{ $document->user->name ?? 'Không rõ' }}</div></li>
                    <li><div class="iconn"><img src="{{ asset('images/pic/icon-doc-5.svg') }}" alt=""></div><div class="number">{{ $document->created_at->format('d/m/Y') }}</div></li>
                </ul>
            </div>

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
                    @php
                        $fileExtension = strtolower(pathinfo($document->file_path, PATHINFO_EXTENSION));
                        $url = asset('storage/' . $document->file_path);
                    @endphp

                    @if ($fileExtension === 'pdf')
                        <div class="pdf-container" id="pdf-container"></div>

                    @elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                        <img src="{{ $url }}" alt="Ảnh tài liệu" style="max-width: 100%; height: auto; display: block; margin: 0 auto;">

                    @elseif (in_array($fileExtension, ['doc', 'docx', 'xls', 'xlsx']))
                        <p style="text-align: center; padding: 2em;">Định dạng tài liệu này đang lỗi. Vui lòng tải xuống.</p>
                    @elseif ($fileExtension === 'zip')
                        @php
                            $zipPath = storage_path('app/public/' . $document->file_path);
                            $zip = new \ZipArchive;
                            $opened = $zip->open($zipPath);
                            $zipContents = [];

                            if ($opened === true) {
                                for ($i = 0; $i < $zip->numFiles; $i++) {
                                    $zipContents[] = $zip->getNameIndex($i);
                                }
                                $zip->close();
                            }
                        @endphp

                        @if (!empty($zipContents))
                            <div style="padding: 1em;">
                                <h4>Nội dung file ZIP:</h4>
                                <ul>
                                    @foreach ($zipContents as $file)
                                        @if (trim($file) !== '')
                                            <li>{{ $file }}</li>
                                        @endif
                                    @endforeach
                                </ul>                                                         
                            </div>
                        @else
                            <p style="text-align: center; padding: 2em;">Không thể xem nội dung file ZIP. Vui lòng tải xuống.</p>
                        @endif    
                    @else
                        <p style="text-align: center; padding: 2em;">Định dạng tài liệu này chưa hỗ trợ xem trực tuyến. Vui lòng tải xuống.</p>
                    @endif
                </div>
            </div>

            <div class="reading-progress-bar-wrapper">
                <div id="reading-progress-bar"></div>
            </div>
            <div class="reading-progress-info">
                <span id="pages-left">Còn ? trang</span>
                <span id="page-status">Trang ? / ?</span>
                <span id="percent-read">0% đã đọc</span>
            </div>

            <div class="download">
                @auth
                    <a href="{{ asset('storage/' . $document->file_path) }}" download>
                        <button>Tải xuống</button>
                    </a>
                @else
                    <button onclick="alert('Bạn cần đăng nhập để tải tài liệu');">Tải xuống</button>
                    {{-- <button disabled>File không tồn tại</button> --}}
                @endauth
            </div>


            <div class="related-docs">
                <h2>Tài liệu bạn có thể quan tâm</h2>
                <div class="doc-list">
                    <div class="doc-card">
                        <img src="{{ asset('images/pic/icon-doc-1.svg') }}" alt="">
                        <a href="#" class="open-pdf" data-url="{{ asset('storage/documents/related1.pdf') }}">[TOÁN 10] TÀI LIỆU LIÊN QUAN 1</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    const url = "{{ asset('storage/' . $document->file_path) }}";
    const viewsEl = document.getElementById('doc-views');
    const downloadsEl = document.getElementById('doc-downloads');
    const filename = '{{ $document->id }}';

    const viewsKey = `views_${filename}`;
    let views = parseInt(localStorage.getItem(viewsKey)) || 0;
    views++;
    localStorage.setItem(viewsKey, views);
    if (viewsEl) viewsEl.textContent = views;

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
