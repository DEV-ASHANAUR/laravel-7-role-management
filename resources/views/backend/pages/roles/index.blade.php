@extends('backend.layouts.master')
@section('title')
    Role Page - Admin Panel
@endsection
@section('main-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Role List</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><span>Role List</span></li>
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
                        <h4 class="header-title float-left">Role List</h4>
                        <p class="float-right mb-3">
                            <a class="btn btn-sm btn-success" href="{{ route('admin.roles.create') }}">Add New</a>
                        </p>
                        <div class="clear-fix"></div>
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>SL No</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <a href="{{ route('admin.roles.edit',$role->id) }}" class="btn btn-sm btn-success" title="Edit"><i class="fa fa-edit"></i></a>

                                            <a href="{{ route('admin.roles.destroy',$role->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash" title="Delete"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection