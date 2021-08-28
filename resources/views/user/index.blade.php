@extends('layouts.app')

@section("content")

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif
    <div class="card">
        <div class="card-body">
            <div class="row mb-3 pb-3 border-bottom-light">
                <div class="col-lg-12">
                    <div class="float-right">
                        <a href="{{ route('user.create') }}" class="btn btn-primary btn-rounded">
                            <i class="fas fa-plus mr-2"></i>
                            @lang('Add User')
                        </a>
                    </div>
                </div>
            </div>

            <div class="table-responsive" id="users-table-wrapper">
                <table class="table table-striped table-borderless">
                    <thead>
                    <tr>
                        <th class="min-width-100">@lang('Name')</th>
                        <th class="min-width-150">@lang('Email')</th>
                        <th class="min-width-150">@lang('Role')</th>
                        <th class="text-center">@lang('Action')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if (count($data))
                            @foreach ($data as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->roles->pluck('name')->get('0') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('user.edit', $user) }}" class="btn btn-icon"
                                           title="@lang('Edit Role')" data-toggle="tooltip" data-placement="top">
                                           <i class="fas fa-edit"></i>
                                        </a>
                                        @if ($user->removable)
                                            <a href="" class="btn btn-icon"
                                               title="@lang('Delete Role')"
                                               data-toggle="tooltip"
                                               data-placement="top"
                                               data-method="DELETE"
                                               data-confirm-title="@lang('Please Confirm')"
                                               data-confirm-text="@lang('Are you sure that you want to delete this role?')"
                                               data-confirm-delete="@lang('Yes, delete it!')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4"><em>@lang('No records found.')</em></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection