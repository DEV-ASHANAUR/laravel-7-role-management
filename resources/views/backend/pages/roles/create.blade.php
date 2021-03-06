@extends('backend.layouts.master')
@section('title')
    Role Create - Admin Panel
@endsection
@section('role')
    in
@endsection
@section('create-role')
    active
@endsection
@section('style')
    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
@endsection
@section('main-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Create Role</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><a href="{{ route('admin.roles.index') }}">All Role</a></li>
                        <li><span>Role Create</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                @include('backend.layouts.partials.logout')
            </div>
        </div>
    </div>
    <!-- page title area end -->
    <div class="main-content-inner">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Create New Role</h4>
                        @include('backend.layouts.partials.message')
                        <form action="{{ route('admin.roles.store') }}" method="POST">
                            @csrf 
                            <div class="form-group">
                                <label for="exampleInputEmail1">Role Name</label>
                                <input type="text" class="form-control" name="name" id="role" aria-describedby="emailHelp" placeholder="Enter Role Name" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Permission</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkpermissionAll" value="1">
                                    <label class="form-check-label" for="checkpermissionAll">All</label>
                                </div>
                                <hr>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($permission_group as $group)
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="{{ $i }}management" value="{{ $group->name }}" onclick="checkPermissionByGroupName('role-{{ $i }}-management-checkbox',this)">
                                            <label class="form-check-label" for="{{ $i }}management">{{ $group->name }}</label>
                                        </div>
                                    </div>
                                    <div class="col-9 role-{{ $i }}-management-checkbox">
                                        @php
                                            $permissions = app\User::getPermissionByGroupName($group->name);
                                            $j = 1;
                                        @endphp
                                        @foreach ($permissions as $permission)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkpermission{{ $permission->id }}" name="permissions[]" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox','{{ $i }}management',{{ count($permissions) }})" value="{{ $permission->name }}">
                                            <label class="form-check-label" for="checkpermission{{ $permission->id }}"> {{ $permission->name }} </label>
                                        </div>
                                        @php
                                            $j++;
                                        @endphp
                                        @endforeach
                                    </div>
                                    
                                </div>
                                <hr>
                                @php
                                    $i++;
                                @endphp
                                @endforeach

                            </div>
                            
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('backend.pages.roles.partials.script')
@endsection