@extends('admin.layout.main')
@section('title')
    Admin Shop
@endsection
@section('content')
    <h2>Xin chào {{Auth::user()->name}} !</h2>
@endsection

