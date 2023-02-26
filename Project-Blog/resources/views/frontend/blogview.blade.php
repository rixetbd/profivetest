@extends('frontend.master')

@section('page_title', $blog->name)

@section('custom_css')
<style>
    .card {
        border: none;
        background-color: #e6e7ee !important;
    }

</style>
@endsection

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mt-5">
        <div>
            <h4 class="font_style_one font_30">{{$blog->name}}</h4>
        </div>
    </div>

    <div class="row my-3">
        <div class="col-sm-12 col-md-12 my-3">
            <div class="card shadow-soft px-4 py-2 my-3 border_radius_10">
                {{-- <img src="https://images.unsplash.com/photo-1561154464-82e9adf32764?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60" class="card-img-top" alt="..."> --}}
                <div class="card-body">
                    <h5 class="card-title">{{$blog->name}}</h5>
                    <h6 class="card-subtitle my-3 text-muted ">{{$blog->category_id}} - {{$blog->author}}</h6>
                </div>
            </div>
            <div class="card shadow-soft p-4 my-3 border_radius_10">
                <div class="card-body">
                    <p class="card-text">{{Str::limit($blog->description, 150)}}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-12 my-3">
            <div class="card shadow-soft px-4 py-2 my-3 border_radius_10">
                {{-- <img src="https://images.unsplash.com/photo-1561154464-82e9adf32764?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60" class="card-img-top" alt="..."> --}}
                <div class="card-body">
                    <h2 class="card-title">Comments</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
