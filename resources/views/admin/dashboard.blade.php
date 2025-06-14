@extends('admin.layout-admin')

@section('title', 'ADMIN')

@section('content')
<style>
    .dashboard-row {
        display: flex;
        justify-content: space-around;
        margin: 30px auto 0;
        max-width: 1000px;
        gap: 20px;
        flex-wrap: wrap;
    }

    .dashboard-row + .dashboard-row {
        margin-top: 50px;
    }

    .dashboard-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 30px;
        flex: 1 1 250px;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
    }

    .dashboard-card h3 {
        font-size: 18px;
        color: #555;
        margin-bottom: 10px;
    }

    .dashboard-card .number {
        font-size: 32px;
        font-weight: bold;
        color: #007bff;
    }
</style>

<div class="dashboard-row">
    <div class="dashboard-card">
        <h3>Tài liệu đã đăng</h3>
        <div class="number">{{ $approvedCount }}</div>
    </div>
    <div class="dashboard-card">
        <h3>Tài liệu chờ duyệt</h3>
        <div class="number">{{ $pendingCount }}</div>
    </div>
    <div class="dashboard-card">
        <h3>Tài liệu mới hôm nay</h3>
        <div class="number">{{ $todayCount }}</div>
    </div>
</div>

<div class="dashboard-row">
    <div class="dashboard-card">
        <h3>Người dùng hiện tại</h3>
        <div class="number">{{ $userCount }}</div>
    </div>
    <div class="dashboard-card">
        <h3>Người dùng mới hôm nay</h3>
        <div class="number">{{ $newUsersToday }}</div>
    </div>
</div>
@endsection
