@extends('frontend.master')

@section('page_title', 'Blog Site')

@section('custom_css')
<style>
    .card {
        border: none;
        background-color: #e6e7ee !important;
    }
    .card-title{font-size: 16px;}
    .card-subtitle,
    .card-body{
        font-size: 13px;
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
        <div class="col-sm-12 col-md-4 my-3">
            <div class="card shadow-soft border_radius_10">
                <div style="min-height:200px;">
                    <img src="{{asset('uploads/blog/'.$item->image)}}" class="card-img-top" alt="..." >
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{$item->name}}</h5>
                    <h6 class="card-subtitle my-3 text-muted ">{{$item->category}} - Posted in {{$item->created_at->diffForHumans()}}</h6>
                    <p class="card-text">
                        {!! Str::limit($item->description, 130) !!}
                    </p>
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
