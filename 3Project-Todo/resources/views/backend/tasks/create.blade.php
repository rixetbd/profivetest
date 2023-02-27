@extends('backend.master')

@section('page_title', 'Add Task')

@section('custom_css')

@endsection

@section('content')

<div class="container my-5">
    <div class="d-flex justify-content-between py-3">
        <div>
            <h4 class="font_style_one font_30">Create Task</h4>
        </div>
        <div>
            <a class="btn btn-sm btn-secondary my-1" href="{{route('tasks.index')}}"><i
                class="fas fa-angle-left me-1"></i> Back</a>
        </div>
    </div>

    <div class="shadow-soft px-3 py-4 border_radius_10">
        <form class="custom-form" action="{{route('tasks.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row py-2">
                <div class="col-sm-12 col-md-6 my-1">
                    <label class="mb-1" for="name">Task Name</label>
                    <input class="form-control" type="text" name="name" placeholder="Enter a product name" required>
                </div>
                <div class="col-sm-12 col-md-6 my-1">
                    <label class="mb-1" for="quantity">Status</label>
                    <select class="form-select" name="status" required>
                        <option value="">-- Select A Optioin</option>
                        <option value="Todo">Todo</option>
                        <option value="On Test">On Test</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
                <div class="col-sm-12 col-md-6 my-1">
                    <label class="mb-1" for="start_from">Start From</label>
                    <input class="form-control" type="date" name="start_from" required>
                </div>
                <div class="col-sm-12 col-md-6 my-1">
                    <label class="mb-1" for="due_date">Due Date</label>
                    <input class="form-control" type="date" name="due_date" required>
                </div>
                <div class="col-sm-12 col-md-12 my-1">
                    <label class="mb-1" for="price">Description</label>
                    <textarea class="form-control" name="description" rows="10"
                        placeholder="Type description..." required></textarea>
                </div>
                <div class="col-sm-12 col-md-12 my-1">
                    <label class="mb-1" for="image">Upload (Optional)</label>
                    <input class="form-control" type="file" name="image">
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button class="btn btn-sm btn-success my-1" type="submit"><i class="fas fa-plus me-1"></i> Add
                    Task</button>
            </div>
        </form>
    </div>
</div>

@endsection


@section('custom_js')
@if ($errors->any())
<script>
    let errors = {!! json_encode($errors->all()) !!};
    $.each(errors, function (index, item) {
        setTimeout(function () {
            notyf.error(item);
        }, index * 1500);
    });
</script>
@endif
@endsection
