@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chào mừng bạn đến với evincode.com</div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bạn đã đăng nhập...
                    <p>Các tính năng đang được đội ngũ kỹ thuật phát triển...</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
