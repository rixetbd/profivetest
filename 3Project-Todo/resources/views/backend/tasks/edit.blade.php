@extends('backend.master')

@section('page_title', 'Edit Task')

@section('custom_css')

@endsection

@section('content')

<div class="container my-5">
    <div class="d-flex justify-content-between py-3">
        <div>
            <h4 class="font_style_one font_30">Edit Task</h4>
        </div>
        <div>
            <a class="btn btn-sm btn-secondary my-1" href="{{route('tasks.index')}}"><i
                class="fas fa-angle-left me-1"></i> Back</a>
        </div>
    </div>

    <div class="shadow-soft px-3 py-4 border_radius_10">
        <form class="custom-form" action="{{route('tasks.update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row py-2">
                <div class="col-sm-12 col-md-6 my-1">
                    <label class="mb-1" for="name">Title</label>
                    <input type="hidden" name="id" value="{{($data->id)}}">
                    <input class="form-control" type="text" name="name" placeholder="Enter a product name"
                        value="{{($data->name)}}">
                </div>

                <div class="col-sm-12 col-md-6 my-1">
                    <label class="mb-1" for="quantity">Status</label>
                    <select class="form-select" name="status" required>
                        <option value="">-- Select A Optioin</option>
                        <option value="Todo" {{($data->status == 'Todo'?'selected':'')}}>Todo</option>
                        <option value="On Test" {{($data->status == 'On Test'?'selected':'')}}>On Test</option>
                        <option value="In Progress" {{($data->status == 'In Progress'?'selected':'')}}>In Progress
                        </option>
                        <option value="Completed" {{($data->status == 'Completed'?'selected':'')}}>Completed</option>
                    </select>
                </div>
                <div class="col-sm-12 col-md-6 my-1">
                    <label class="mb-1" for="start_from">Start From</label>
                    <input class="form-control" type="date" name="start_from" required value="{{($data->start_from)}}">
                </div>
                <div class="col-sm-12 col-md-6 my-1">
                    <label class="mb-1" for="due_date">Due Date</label>
                    <input class="form-control" type="date" name="due_date" required value="{{($data->due_date)}}">
                </div>
                <div class="col-sm-12 col-md-12 my-1">
                    <label class="mb-1" for="price">Description</label>
                    <textarea class="form-control" name="description" rows="10" placeholder="Type description..."
                        required>{{($data->description)}}</textarea>
                </div>
                <div class="col-sm-12 col-md-12 my-1">
                    <label class="mb-1" for="image">Upload Photo</label>
                    <input class="form-control" type="file" name="image">
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button class="btn btn-sm btn-success my-1" type="submit"><i class="fas fa-plus me-1"></i> Update
                    Task</button>
            </div>
        </form>
    </div>
</div>

@endsection


@section('custom_js')
<script>

</script>
@endsection
