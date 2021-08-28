@extends('layouts.app')

@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">2FA Setting</div>
                <div class="card-body">
                    <form role="form" method="post" action="{{ route('enable_2fa_setting') }}">
                        {{ csrf_field() }}
                        <h2>Scan barcode</h2>
                        <p class="text-muted">
                            Scan the image above with the two-factor authentication app on your phone.
                        </p>
                        <p class="text-center">
                            <img src="{{ $qrCodeUrl }}" />
                        </p>
                        <h5>Enter the six-digit code from the application</h5>
                        <p class="text-muted">
                            After scanning the barcode image, the app will display a six-digit code that you can enter below.
                        </p>
                        <div class="form-group">
                            <input type="text" name="code" class="form-control" placeholder="123456">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">Enable</button>
                            <a href="{{ route('home') }}" class="btn btn-secondary float-right">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection