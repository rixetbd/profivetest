@extends('backend.master')

@section('page_title', 'Edit User')

@section('custom_css')

@endsection

@section('content')

<div class="container my-5">
    <div class="d-flex justify-content-between py-3">
        <div>
            <h4 class="font_style_one font_30">Edit Task</h4>
        </div>
        <div>
            <a class="btn btn-sm btn-secondary my-1" href="{{route('users.index')}}"><i
                class="fas fa-angle-left me-1"></i> Back</a>
        </div>
    </div>

    <div class="shadow-soft px-3 py-4 border_radius_10">
        <form class="custom-form" action="{{route('users.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row py-2">
                <div class="col-sm-12 col-md-6 my-1">
                    <label class="mb-1" for="name">Name</label>
                    <input type="hidden" name="id" value="{{($data->id)}}">
                    <input class="form-control" type="text" name="name" placeholder="Enter name"
                        value="{{($data->name)}}">
                </div>
                <div class="col-sm-12 col-md-6 my-1">
                    <label class="mb-1" for="email">Email</label>
                    <input class="form-control" type="text" name="email" placeholder="Enter email"
                        value="{{($data->email)}}">
                </div>
                <div class="col-sm-12 col-md-6 my-1">
                    <label class="mb-1" for="password">Password</label>
                    <input class="form-control" type="password" name="password" placeholder="Enter password">
                </div>
                <div class="col-sm-12 col-md-6 my-1">
                    <label class="mb-1" for="con_password">Confirm Password</label>
                    <input class="form-control" type="password" name="con_password" placeholder="Enter confirm password">
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button class="btn btn-sm btn-success my-1" type="submit"><i class="fas fa-plus me-1"></i> Update
                    User</button>
            </div>
        </form>
    </div>
</div>

@endsection


@section('custom_js')
<script>

</script>
@endsection
