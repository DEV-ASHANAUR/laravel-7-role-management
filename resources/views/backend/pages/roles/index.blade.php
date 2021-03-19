@extends('backend.layouts.master')
@section('title')
    Role Page - Admin Panel
@endsection
@section('style')
    <style>
        td.action {
            display: inline-flex;
        }
    </style>
@endsection
@section('role')
    in
@endsection
@section('all-role')
    active
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
                        @if (Auth::guard('admin')->user()->can('role.create'))
                        <p class="float-right mb-3">
                            <a class="btn btn-sm btn-success" href="{{ route('admin.roles.create') }}">Add New</a>
                        </p>
                        @endif
                        <div class="clearfix"></div>
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th width="5%">SL No</th>
                                        <th width="10%">Name</th>
                                        <th width="60%">Permissions</th>
                                        @if (Auth::guard('admin')->user()->can('role.edit') || Auth::guard('admin')->user()->can('role.delete'))
                                        <th width="20%">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td class="text-uppercase">{{ $role->name }}</td>
                                        <td>
                                            @foreach ($role->permissions as $item)
                                                <span class="badge badge-info mr-1">
                                                    {{ $item->name }}
                                                </span>
                                            @endforeach
                                        </td>
                                        @if (Auth::guard('admin')->user()->can('role.edit') || Auth::guard('admin')->user()->can('role.delete'))
                                            
                                        <td>
                                            @if (Auth::guard('admin')->user()->can('role.edit'))
                                                <a href="{{ route('admin.roles.edit',$role->id) }}" class="btn btn-sm btn-success mr-2" title="Edit"><i class="fa fa-edit"></i></a>
                                            @endif
                                            
                                            @if (Auth::guard('admin')->user()->can('role.delete'))
                                            
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete-{{ $role->id }}"><i class="fa fa-trash"></i>
                                            </button>

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
                {{-- --------modal start------------ --}}
                @foreach ($roles as $key => $role)
                <div class="modal fade bd-example-modal-sm" id="delete-{{ $role->id }}">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Role</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Are You Sure ! Delete This Role?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Cancle</button>
                                <button type="button" class="btn btn-danger btn-flat" onclick="event.preventDefault();
                                document.getElementById('deleteRole-{{$role->id}}').submit();">Delete</button>
                                <form action="{{ route('admin.roles.destroy',$role->id) }}" style="display: none" id="deleteRole-{{$role->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- --------modal end------------ --}}
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection