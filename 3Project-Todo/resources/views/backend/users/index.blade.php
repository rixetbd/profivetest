@extends('backend.master')

@section('page_title', 'Users List')

@section('custom_css')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
@endsection

@section('content')

<div class="container my-5">
    <div class="d-flex justify-content-between py-3">
        <div>
            <h4 class="font_style_one font_30">Users</h4>
        </div>
        <div>
            <a href="{{route('users.create')}}" class="btn btn-sm btn-secondary">
                <i class="fas fa-plus me-1"></i> Add User
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
                            <th>Name</th>
                            <th>Email</th>
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
            url: `{{route('users.autoData')}}`,
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
                data: 'name'
            },
            {
                data: 'email'
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
                let formUrlData = `{{route('users.destroy')}}`;
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
        })
    }
</script>
@endsection
