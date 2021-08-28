@extends('layouts.app')

@section("content")
@if ($edit)
{!! Form::open(['method' => 'POST', 'route' => ['user.update', $user]]) !!}
{{ method_field('PUT') }}
@else
{!! Form::open(['method' => 'POST', 'route' => ['user.store']]) !!}
@endif
{{ csrf_field() }}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <h5 class="card-title">
                    @lang('User Details')
                </h5>
                <p class="text-muted">
                    @lang('A general user information.')
                </p>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <label for="name">@lang('Name')</label>
                    <input type="text"
                           class="form-control input-solid"
                           id="name"
                           name="name"
                           placeholder="@lang('Name')"
                           value="{{ $edit ? $user->name : old('name') }}">
                </div>
                <div class="form-group">
                    <label for="email">@lang('Email')</label>
                    <input type="text"
                           class="form-control input-solid"
                           id="email"
                           name="email"
                           placeholder="@lang('Email')"
                           value="{{ $edit ? $user->email : old('email') }}">
                </div>
                <div class="form-group">
                    <label for="first_name">@lang('Role')</label>
                    {!! Form::select('role', $roles, $edit ? $userRole[0] : '', ['class' => 'form-control input-solid', 'id' => 'role_id']) !!}
                </div>
            </div>
        </div>
    </div>
</div>

<button type="submit" class="btn btn-primary">
    {{ __($edit ? 'Update User' : 'Create User') }}
</button>
{!! Form::close() !!}
@endsection