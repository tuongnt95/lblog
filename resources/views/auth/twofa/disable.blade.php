@extends('layouts.app')

@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">2FA Setting</div>
                <div class="card-body">
                    <form role="form" method="post" action="{{ route('disable_2fa_setting') }}">
                        {{ csrf_field() }}
                        <h5>Enter the six-digit code from the application</h5>
                        <div class="form-group">
                            <input type="text" name="code" class="form-control" placeholder="123456">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-danger">Disable</button>
                            <a href="{{ route('home') }}" class="btn btn-secondary float-right">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection