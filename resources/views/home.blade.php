@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-end">
        <create-new-btn :user-id="{{ \Illuminate\Support\Facades\Auth::user() }}"></create-new-btn>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{ __('Vender Portal') }}</div>


                <div class="card-body">

                    <collection-page :user-id="{{ \Illuminate\Support\Facades\Auth::user() }}"></collection-page>
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {{ __('You are logged in!') }}--}}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
<script>
    import CollectionPage from "../js/pages/CollectionPage";
    export default {
        components: {CollectionPage}
    }
</script>
