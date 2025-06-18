@extends('admin.layout-admin')

@section('content')
<div class="container">
    <h2>Danh sách danh mục</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-2">Thêm danh mục</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Xoá danh mục này?')" class="btn btn-sm btn-danger">Xoá</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection