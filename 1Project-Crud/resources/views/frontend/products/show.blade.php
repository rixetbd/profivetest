@extends('frontend.master')

@section('page_title', $data->name)

@section('custom_css')

@endsection

@section('content')

<div class="container my-5">
    <div class="shadow-soft px-3 py-4 border_radius_10">

        <div class="d-flex align-items-center">
            <div class="me-3">
                <img src="{{asset('uploads/product/'.$data->image)}}" class="card-img-top" style="width:200px;">
            </div>
            <div class="">
                <h2>{{$data->name}}</h2>
                <h6>{{$data->getCategory->name}}</h6>
            </div>

        </div>



        <div class="py-4">
            {!! $data->description !!}
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Info</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{$data->name}}</td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>{{$data->getCategory->name}}</td>
                </tr>
                <tr>
                    <th>Product Code</th>
                    <td>{{$data->p_code}}</td>
                </tr>
                <tr>
                    <th>Product Quantity</th>
                    <td>{{$data->quantity}}</td>
                </tr>
                <tr>
                    <th>Buying Price</th>
                    <td>{{$data->buying_price}}</td>
                </tr>
                <tr>
                    <th>Selling Price</th>
                    <td>{{$data->selling_price}}</td>
                </tr>
            </tbody>
        </table>



        <a class="btn btn-sm btn-secondary my-1" href="{{route('product.index')}}"><i
                class="fas fa-angle-left me-1"></i> Back</a>
                
    </div>
</div>

@endsection
