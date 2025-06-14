@extends('Lop12.lythuyet_12')

@section('noidung')
    <link rel="stylesheet" href="{{ asset('css/LT10.css') }}">

<style>
/* Ghi đè background của content_LT_1 */
.content_LT_1 {
    background: white !important;
}
</style>

<p class="12-bai1" style="">
    <h1 style="display:flex;padding-left:110px;margin-left:100px;padding-top:20px;padding-bottom:20px;color:rgb(103, 103, 243)">Lý thuyết Mệnh đề</h1>
    <img style="width:660px;" src="{{ asset('images/lop10-1.PNG') }}" alt="" />
    <img style="width:660px;position:relative;left:23px;" src="{{ asset('images/lop10-2.PNG') }}" alt="" />
    <img style="width:660px;" src="{{ asset('images/lop10-3.PNG') }}" alt="" />
    <img style="width:660px;" src="{{ asset('images/lop10-4.PNG') }}" alt="" />
    <img style="width:660px;" src="{{ asset('images/lop10-5.PNG') }}" alt="" />
    <img style="width:660px;" src="{{ asset('images/lop10-6.PNG') }}" alt="" />
    <img style="width:660px;" src="{{ asset('images/lop10-7.PNG') }}" alt="" />
    <img style="width:660px;margin-bottom:50px;padding-bottom:80px" src="{{ asset('images/lop10-8.PNG') }}" alt="" />
    <p style="display:flex;justify-content:center">............................................................<i>Hết</i>............................................................</p>
    <p style="color: rgb(22, 21, 21); font-size: 15px;padding-top:30px;padding-right:40px; display:flex;justify-content:right;"><a class="b1-sau" href="/Lop12/Bai2">Trang sau >></a></p>
</p>
@endsection
