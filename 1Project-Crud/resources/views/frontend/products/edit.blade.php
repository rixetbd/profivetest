@extends('frontend.master')

@section('page_title', 'Edit Product')

@section('custom_css')

@endsection

@section('content')

<div class="container my-5">
    <form class="custom-form" action="{{route('product.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row py-2">
            <div class="col-sm-12 col-md-6 my-1">
                <label class="mb-1" for="name">Product Name</label>
                <input type="hidden" name="id" value="{{($data->id)}}">
                <input class="form-control" type="text" name="name" placeholder="Enter a product name" value="{{($data->name)}}">
            </div>
            <div class="col-sm-12 col-md-6 my-1">
                <label class="mb-1" for="price">Category Name</label>
                <select name="category_id" id="" class="form-select">
                    <option value="">-- Select A Category</option>
                    @foreach ($category as $item)
                        <option value="{{$item->id}}" {{($item->id == $data->category_id?'selected':'')}}>{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12 col-md-6 my-1">
                <label class="mb-1" for="p_code">Product Code</label>
                <input class="form-control" type="text" name="p_code" placeholder="Enter product code" value="{{($data->p_code)}}">
            </div>
            <div class="col-sm-12 col-md-6 my-1">
                <label class="mb-1" for="quantity">Quantity</label>
                <input class="form-control" type="number" name="quantity" placeholder="Enter Quantity" value="{{($data->quantity)}}">
            </div>
            <div class="col-sm-12 col-md-6 my-1">
                <label class="mb-1" for="buying_price">Buying Price</label>
                <input class="form-control" type="number" name="buying_price" placeholder="Enter Buying Price" value="{{($data->buying_price)}}">
            </div>
            <div class="col-sm-12 col-md-6 my-1">
                <label class="mb-1" for="selling_price">Selling Price</label>
                <input class="form-control" type="number" name="selling_price" placeholder="Enter Selling Price" value="{{($data->selling_price)}}">
            </div>
            <div class="col-sm-12 col-md-12 my-1">
                <label class="mb-1" for="price">Description</label>
                <textarea class="form-control" name="description" rows="10" placeholder="Type description...">{{($data->description)}}</textarea>
            </div>
            <div class="col-sm-12 col-md-12 my-1">
                <label class="mb-1" for="image">Upload Photo</label>
                <input class="form-control" type="file" name="image">
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <button class="btn btn-sm btn-success my-1" type="submit"><i class="fas fa-plus me-1"></i> Update Product</button>
            <a class="btn btn-sm btn-secondary my-1" href="{{route('product.index')}}"><i class="fas fa-angle-left me-1"></i> Back</a>
        </div>
    </form>
</div>

@endsection


@section('custom_js')
<script>

</script>
@endsection
