@extends('frontend.master')

@section('page_title', 'Blog Site')

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
            <h4 class="font_style_one font_30">Blog</h4>
        </div>
    </div>

    <div class="row my-3">
        @foreach ($blog as $item)
        <div class="col-sm-12 col-md-6 my-3">
            <div class="card shadow-soft p-4 border_radius_10">
                {{-- <img src="https://images.unsplash.com/photo-1561154464-82e9adf32764?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60" class="card-img-top" alt="..."> --}}
                <div class="card-body">
                    <h5 class="card-title">{{$item->name}}</h5>
                    <h6 class="card-subtitle my-3 text-muted ">{{$item->category_id}} - {{$item->author}}</h6>
                    <p class="card-text">{{Str::limit($item->description, 150)}}</p>
                    <a href="{{ route('frontend.blogview',$item->slug)}}" class="btn btn-sm shadow-soft px-4 py-2 border_radius_10">Read More...</a>
                </div>
            </div>
        </div>
        @endforeach

        <div class="col-12 mt-4">
            {!! $blog->links() !!}
        </div>
    </div>
</div>
@endsection
