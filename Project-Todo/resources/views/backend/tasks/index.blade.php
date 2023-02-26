@extends('backend.master')

@section('page_title', 'Tasks List')

@section('custom_css')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
@endsection

@section('content')

<div class="container my-5">
    <div class="d-flex justify-content-between py-3">
        <div>
            <h4 class="font_style_one font_30">Tasks</h4>
        </div>
        <div>
            <a href="{{route('tasks.create')}}" class="btn btn-sm btn-secondary">
                <i class="fas fa-plus me-1"></i> Add Task
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="shadow-soft p-4 border_radius_10">
                <table id="dataTableget" class="display">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Buying Price</th>
                            <th>Quantity</th>
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
            url: `{{route('tasks.autoData')}}`,
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
                    return `<a href="{{asset('uploads/users')}}/` + data.image +
                        `" data-lightbox="roadtrip"><img class="img-thumbnail" width="45" src="{{asset('uploads/users')}}/` +
                        data.image + `" itemprop="thumbnail" alt="Img"></a>`;
                }
            },
            {
                data: 'name'
            },
            {
                data: 'category_id'
            },
            {
                data: 'buying_price'
            },
            {
                className: "text-center",
                data: 'quantity'
            },
            {
                "data": null, // (data, type, row)
                className: "text-center",
                render: function (data) {
                    return `<button class="border-0 btn-sm btn-info me-2" onclick="data_edit('` +
                        data.id + `','` + data.name + `')"><i class="fa fa-edit"></i></button>` +
                        `<button class="border-0 btn-sm btn-danger red_icon me-2" onclick="data_distroy('` +
                        data.id + `')"><i class="fa fa-trash"></i></button>`;
                },
            },
        ],
        error: function (request, status, error) {
            notyf.error('No data available in table');
        }
    });


    function data_distroy(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let formUrlData = `{{route('tasks.destroy')}}`;
                $.ajax({
                    type: "POST",
                    url: `${formUrlData}`,
                    data: {
                        "id": id,
                    },
                    success: function (data) {
                        $('#dataTableget').DataTable().ajax.reload();
                        notyf.success("Employee Delete Successfully!");
                    },
                    error: function (request, status, error) {
                        notyf.error('Employee Delete Unsuccessfully!');
                    }
                });
            }
        })
    }

    category.edit

    function data_edit(id)
    {
        var url = '{{ route("tasks.edit", ":id") }}';
        url = url.replace(':id', id);
        // window.open(url, '_blank');
        window.location.href = url;
    }
</script>
@endsection
