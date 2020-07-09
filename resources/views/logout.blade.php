@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Logout') }}</div>

                    <div class="card-body">

                        {{ __('Click')}}<a href="{{url('/login')}}"> here </a>  {{ __('to login again!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
