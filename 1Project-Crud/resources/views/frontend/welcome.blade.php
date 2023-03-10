@extends('frontend.master')

@section('page_title', 'Welcome - CRUD')

@section('custom_css')
<style>
    .card {
        border: none;
        width: 18rem;
        border-radius: 10px;
        overflow: hidden;
        background-color: #e6e7ee !important;
    }

    .card-body {
        text-align: center;
    }

    .card-body a.btn {
        box-shadow: 3px 3px 6px #b8b9be, -3px -3px 6px #fff;
        background-color: transparent;
        color: #000;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-soft">
            <img src="{{asset('assets/img/banner.png')}}" class="card-img-top" alt="CRUD Banner">
            <div class="card-body">
                <h5 class="card-title">CRUD</h5>
                <p class="card-text">A simple CRUD App with Laravel.</p>
                <a href="{{route('product.index')}}" class="btn px-4">View</a>
            </div>
        </div>
    </div>
</div>
@endsection
