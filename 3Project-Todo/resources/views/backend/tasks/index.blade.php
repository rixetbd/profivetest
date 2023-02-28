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
                            <th>Name</th>
                            <th>Start From</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key=>$item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->start_from}}</td>
                            <td>{{$item->due_date}}</td>
                            <td>
                                <select class="form-select form-select-sm" name="status" required id="status_action" data-id="{{$item->id}}">
                                    <option value="">-- Select A Optioin</option>
                                    <option value="1" {{($item->status == 1?'selected':'')}}>Todo</option>
                                    <option value="2" {{($item->status == 2?'selected':'')}}>On Test</option>
                                    <option value="3" {{($item->status == 3?'selected':'')}}>In Progress</option>
                                    <option value="4" {{($item->status == 4?'selected':'')}}>Completed</option>
                                </select>
                            </td>
                            <td>
                                <a href="{{route('tasks.assign', $item->id)}}" class="btn btn-sm btn-primary">Assign</a>
                                <a href="{{route('tasks.destroy', $item->id)}}" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
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
    $('#dataTableget').DataTable();

    $('#status_action').on('change', function(){
        let value = $('#status_action').val();
        let task_id = $('#status_action').data("id");

        $.ajax({
            url:`{{route('tasks.status')}}`,
            method:'POST',
            data:{
                id: task_id,
                status: value,
            },
            success:function(data){
                alert(id);
            }
        });
    });
</script>
@endsection
