@extends('admin.layout-admin')

@section('content')
    <h2>Danh sách tài liệu đã duyệt</h2>

    @if($documents->isEmpty())
        <p>Không có tài liệu nào đã duyệt.</p>
    @else
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
                color: #333;
            }
            tr:hover {
                background-color: #f1f1f1;
            }
            .btn-danger {
                background-color: #dc3545;
                color: white;
                border: none;
                padding: 5px 10px;
                cursor: pointer;
                border-radius: 4px;
            }
            .btn-danger:hover {
                background-color: #c82333;
            }
        </style>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên tài liệu</th>
                    <th>Người đăng</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($documents as $document)
                    <tr>
                        <td>{{ $document->id }}</td>
                        <td>{{ $document->title }}</td>
                        <td>{{ $document->user->name ?? 'Không rõ' }}</td>
                        <td>
                            <form action="{{ route('admin.document.destroy', $document->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xoá?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xoá</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection