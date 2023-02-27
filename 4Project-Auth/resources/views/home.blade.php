@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in with - ') }} {{Auth::user()->email}}
                </div>
            </div>

            <div class="card my-3">
                <div class="card-header">{{ __('Preview') }}</div>
                <div class="card-body">
                    <video width="100%" controls autoplay>
                        <source src="{{asset('assets/video/presentation.mp4')}}" type="video/mp4">
                        <source src="{{asset('assets/video/presentation.mp4')}}" type="video/ogg">
                      </video>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
