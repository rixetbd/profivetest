@extends('frontend.master')

@section('page_title', 'Blog Site')

@section('custom_css')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
<style>
    .card {
        border: none;
        background-color: #e6e7ee !important;
    }

    .card-title {
        font-size: 16px;
    }

    .card-subtitle,
    .card-body {
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

        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="shadow-soft p-4 border_radius_10">
                    <table id="dataTableget" class="display table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Publish At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blog as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->category}}</td>
                                <td>{{$item->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('blog.destroy', $item->id)}}">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection

@section('custom_js')
<script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script>
    $('#dataTableget').DataTable();
</script>
@endsection
