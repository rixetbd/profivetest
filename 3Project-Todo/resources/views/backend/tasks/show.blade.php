@extends('backend.master')

@section('page_title', 'Add Task')

@section('custom_css')

@endsection

@section('content')

<div class="container my-5">
    <div class="d-flex justify-content-between py-3">
        <div>
            <h4 class="font_style_one font_30">Assign Task</h4>
        </div>
        <div>
            <a class="btn btn-sm btn-secondary my-1" href="{{route('tasks.index')}}"><i
                    class="fas fa-angle-left me-1"></i> Back</a>
        </div>
    </div>

    <div class="shadow-soft px-3 py-4 border_radius_10">
        {{$data}}

        <h4>{{$data->name}}</h4>
        <p>{{$data->description}}</p>

        <div class="py-3">
            <form action="{{route('tasks.assignto.users')}}" method="post">
                @csrf
                <h3 class="py-3">Assgin To -</h3>
                <input type="hidden" name="tasks" value="{{$data->id}}">
                @foreach ($user as $item)
                <div class="form-check py-2">
                    <input class="form-check-input" type="checkbox" name="users[]" value="{{$item->id}}" id="flexCheckDefault{{$item->id}}">
                    <label class="form-check-label" for="flexCheckDefault{{$item->id}}">
                        {{$item->name}}
                    </label>
                </div>
                @endforeach

                <button type="submit" class="btn btn-sm btn-success mt-4">Submit</button>
            </form>

            </div>
    </div>
</div>

@endsection
