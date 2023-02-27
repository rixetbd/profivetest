@extends('frontend.master')

@section('page_title', 'Welcome - RESTful API')

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
        border-top: 1px solid #0000001a;
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
                <h5 class="card-title">RESTful API</h5>
                <p class="card-text">Welcome to RESTful API System.</p>
                <a href="#" class="btn px-4">Check By PostMan</a>
            </div>
        </div>
    </div>
</div>
@endsection
