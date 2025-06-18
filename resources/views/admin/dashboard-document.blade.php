@extends('admin.layout-admin')

@section('title', 'ADMIN')

@section('content')
<style>
    .container {
        max-width: 1100px;
        margin: 20px auto;
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
    }
    h2 { text-align: center; margin-bottom: 25px; color: #333; }
    .alert { padding: 10px 15px; margin-bottom: 20px; border-radius: 4px; }
    .alert-success { background-color: #d4edda; color: #155724; }
    .alert-danger { background-color: #f8d7da; color: #721c24; }
    table { width: 100%; border-collapse: collapse; background-color: #fefefe; }
    th, td { padding: 12px 15px; border: 1px solid #ddd; text-align: left; }
    th { background-color: #f2f2f2; font-weight: bold; }
    tr:hover { background-color: #f9f9f9; }
    a { color: #007bff; text-decoration: none; }
    .btn-approve, .btn-reject {
        padding: 6px 12px; border: none; border-radius: 4px;
        cursor: pointer; font-size: 14px;
    }
    .btn-approve { background-color: #28a745; color: white; }
    .btn-reject { background-color: #dc3545; color: white; }
    .btn-reject:hover { background-color: #c82333; }
    .btn-approve:hover { background-color: #218838; }
    .action-buttons { display: flex; gap: 8px; }
    .desc-cell { max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .category-badge { background: #e3f2fd; color: #1976d2; padding: 2px 8px; border-radius: 5px; font-size: 13px;}
    .status-badge { background: #ffc107; color: #333; padding: 2px 8px; border-radius: 5px; font-size: 13px;}
    .uploader-cell { color: #555; font-size: 13px;}
</style>

<div class="container">
    <h2>Quản lý tài liệu chờ duyệt</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($documents->isEmpty())
        <p>Không có tài liệu nào cần duyệt.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Danh mục</th>
                    <th>Người đăng</th>
                    <th>Ngày đăng</th>
                    <th>Loại</th>
                    <th class="desc-cell">Mô tả</th>
                    <th>Tập tin</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $doc)
                    <tr>
                        <td>
                            <strong>{{ $doc->title }}</strong>
                            <br>
                            <span class="status-badge">Chờ duyệt</span>
                        </td>
                        <td>
                            @if($doc->category)
                                <span class="category-badge">{{ $doc->category->name }}</span>
                            @else
                                <span style="color: #aaa;">Chưa phân loại</span>
                            @endif
                        </td>
                        <td class="uploader-cell">
                            {{ $doc->user->name ?? 'N/A' }}
                        </td>
                        <td>
                            {{ $doc->created_at ? $doc->created_at->format('d/m/Y') : '' }}
                        </td>
                        <td>{{ $doc->type }}</td>
                        <td class="desc-cell" title="{{ $doc->description }}">
                            @if ($doc->description)
                                <span>{{ $doc->description }}</span>
                            @else
                                <span style="color: #aaa;">Chưa có</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank">Xem</a>
                            <br>
                            <a href="{{ asset('storage/' . $doc->file_path) }}" download>Tải xuống</a>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <form action="{{ route('admin.dashboard.approve', $doc->id) }}" method="POST">
                                    @csrf
                                    <button class="btn-approve" type="submit">Duyệt</button>
                                </form>
                                <form action="{{ route('admin.dashboard.reject', $doc->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn từ chối và xoá tài liệu này?');">
                                    @csrf
                                    <button class="btn-reject" type="submit">Từ chối</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 10px;">
            {{-- Nếu bạn dùng paginate() ở controller --}}
            {{-- {{ $documents->links() }} --}}
        </div>
    @endif

    <hr>
    <li>
        <a href="{{ route('admin.documents.approved') }}">
            <span class="icon"><ion-icon name="checkmark-done-outline"></ion-icon></span>
            <span class="title">Tài liệu đã duyệt</span>
        </a>
    </li>
</div>
@endsection