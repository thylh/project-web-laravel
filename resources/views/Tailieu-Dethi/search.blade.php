@extends('Gioi_thieu.layout-intro')

@section('title', 'Kết quả tìm kiếm')

@section('content')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/document.css') }}">
@endpush

<main class="container">
    <div class="content">
        <div class="content1"><h1>Kết quả tìm kiếm cho: "{{ $query }}"</h1></div>
        @if($documents->count())
            <div class="content2">
                @foreach($documents as $doc)
                    <div class="card">
                        <h3>{{ $doc->title }}</h3>
                        <div class="box-border">
                            <p class="subject">
                                {{ $doc->type == 'lecture' ? 'Bài giảng' : ($doc->type == 'exercise' ? 'Bài tập' : ($doc->type == 'exam' ? 'Kỳ thi' : 'Khác')) }}
                            </p>
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
                @endforeach
            </div>
        @else
            <div style="display: flex; justify-content: center;">Không tìm thấy tài liệu phù hợp.</div>
        @endif
    </div>
    
</main>
@endsection
@push('scripts')
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
@endpush