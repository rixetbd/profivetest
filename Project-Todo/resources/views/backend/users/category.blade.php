@extends('backend.master')

@section('page_title', 'Category')

@section('custom_css')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
@endsection

@section('content')

<div class="container my-5">
    <div class="d-flex justify-content-between py-3">
        <div>
            <h4 class="font_style_one font_30">Category</h4>
        </div>
        <div>
            <a href="{{route('users.index')}}" class="btn btn-sm btn-secondary">
                <i class="fas fa-angle-left me-1"></i> Back To Users List
            </a>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-12 col-md-12 mb-4">
            <div class="shadow-soft p-4 border_radius_10">
                <form class="custom-form" action="{{route('category.store')}}" method="post" id="formSubmit" enctype="multipart/form-data">
                    @csrf
                    <div class="row py-2">
                        <div class="col-sm-12 col-md-6 my-1">
                            <label class="mb-1" for="name">Name</label>
                            <input class="form-control" type="text" name="name"
                                placeholder="Enter a category name">
                        </div>
                        <div class="col-sm-12 col-md-6 my-1">
                            <label class="mb-1" for="price">Upload Photo</label>
                            <input class="form-control" type="file" name="image">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-sm btn-success my-1" type="submit"><i class="fas fa-plus me-1"></i> Add
                            Category</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-sm-12 col-md-12">
            <div class="shadow-soft p-4 border_radius_10">
                <table id="dataTableget" class="display">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection


@section('custom_js')
<script src="//cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script>
    $('#dataTableget').DataTable({
        ajax: {
            url: `{{route('category.autoData')}}`,
            dataSrc: ''
        },
        columns: [{
                data: null,
                className: "text-center",
                render: function (data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                "data": function (data, type) {
                    return `<a href="{{asset('uploads/category')}}/` + data.image +
                        `" data-lightbox="roadtrip"><img class="img-thumbnail" width="50" src="{{asset('uploads/category')}}/` +
                        data.image + `" itemprop="thumbnail" alt="Img"></a>`;
                }
            },
            {
                data: 'name'
            },
            {
                data: 'slug'
            },
            {
                "data": null, // (data, type, row)
                className: "text-center",
                render: function (data) {
                    return `<button class="border-0 btn-sm btn-danger red_icon me-2" onclick="data_distroy('` +
                        data.id + `')"><i class="fa fa-trash"></i></button>`;
                },
            },
        ],
        error: function (request, status, error) {
            // notyf.error('No data available in table');
        }
    });


    function data_distroy(id) {
        let formUrlData = `{{route('category.destroy')}}`;
        $.ajax({
            type: "POST",
            url: `${formUrlData}`,
            data: {
                "id": id,
            },
            success: function (data) {
                $('#dataTableget').DataTable().ajax.reload();
                notyf.success("Data Delete Successfully!");
            },
            error: function (request, status, error) {
                notyf.error('Data Delete Unsuccessfully!');
            }
        });
    }

</script>

<script>
    $('#formSubmit').on('submit', function (e) {
        e.preventDefault();
        // alert('Ho');
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data) {
                $('input[type=text]').val('');
                $('input[type=file]').val('');
                $('#dataTableget').DataTable().ajax.reload();
                notyf.success("Action Successful");
            },
            error: function (request, status, error) {
                notyf.error(request.responseJSON.message);
            }
        });
    });
</script>
@endsection
