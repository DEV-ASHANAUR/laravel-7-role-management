@extends('backend.layouts.master')
@section('title')
    Manage Admin - Admin Panel
@endsection
@section('style')
    <style>
        td.action {
            display: inline-flex;
        }
    </style>
@endsection
@section('admin')
    in
@endsection
@section('all-admin')
    active
@endsection
@section('main-content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Admin List</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li><span>Admin List</span></li>
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
                        <h4 class="header-title float-left">Admin List</h4>
                        @if (Auth::guard('admin')->user()->can('admin.create'))
                        <p class="float-right mb-3">
                            <a class="btn btn-sm btn-success" href="{{ route('admin.admins.create') }}">Add New</a>
                        </p>
                        @endif
                        <div class="clearfix"></div>
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th width="10%">SL No</th>
                                        <th width="20%">Name</th>
                                        <th width="10%">Email</th>
                                        <th width="40%">Roles</th>
                                        @if (Auth::guard('admin')->user()->can('admin.edit') || Auth::guard('admin')->user()->can('admin.delete'))
                                        <th width="20%">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $key => $admin)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td class="text-uppercase">{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>
                                            @foreach ($admin->roles as $item)
                                                <span class="badge badge-info mr-1">
                                                    {{ $item->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        @if (Auth::guard('admin')->user()->can('admin.edit') || Auth::guard('admin')->user()->can('admin.delete'))
                                        <td class="action">
                                            @if (Auth::guard('admin')->user()->can('admin.edit'))
                                            <a href="{{ route('admin.admins.edit',$admin->id) }}" class="btn btn-sm btn-success mb-2 mr-2" title="Edit"><i class="fa fa-edit"></i></a>
                                            @endif

                                            @if (Auth::guard('admin')->user()->can('admin.delete'))
                                            <form action="{{ route('admin.admins.destroy',$admin->id) }}" method="POST" >
                                            @csrf
                                            @method('DELETE')
                                    
                                             <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure, You Want To Delete?')"><i class="fa fa-trash"></i></button>
                                             </form>
                                            @endif 
                                        </td>
                                        @endif
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
@section('script')

@endsection