@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>{{Auth::user()->name}} - Thông tin cá nhân</h3></div>
                    <div class="card-body text-center">
                        <div>
                            <div id="profile">
                                <user-profile :info="{{json_encode(Auth::user())}}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("js_location")
    <script src="{{asset('js/user-profile.js?t='.Carbon\Carbon::now()->timestamp)}}"></script>
@endsection
