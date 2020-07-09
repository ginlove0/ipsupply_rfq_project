@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register successful') }}</div>

                    <div class="card-body">

                        {{ __('Your account need to active by admin. We gonna contact you via email in short. Please patient!')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
