@extends('layouts.app')

@section("content")
@if ($edit)
<form role="form" method="post" action="{{ route('permission.update', $permission) }}">
{{ method_field('PUT') }}
@else
<form role="form" method="post" action="{{ route('permission.store') }}">
@endif
{{ csrf_field() }}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <h5 class="card-title">
                    @lang('Permission Details')
                </h5>
                <p class="text-muted">
                    @lang('A general permission information.')
                </p>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <label for="name">@lang('Name')</label>
                    <input type="text"
                           class="form-control input-solid"
                           id="name"
                           name="name"
                           placeholder="@lang('Role Name')"
                           value="{{ $edit ? $permission->name : old('name') }}">
                </div>
                <div class="form-group">
                    <label for="guard_name">@lang('Display Name')</label>
                    <input type="text"
                           class="form-control input-solid"
                           id="guard_name"
                           name="guard_name"
                           placeholder="@lang('Display Name')"
                           value="{{ $edit ? $permission->guard_name : old('guard_name') }}">
                </div>
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">
    {{ __($edit ? 'Update Permission' : 'Create Permission') }}
</button>
</form>
@endsection