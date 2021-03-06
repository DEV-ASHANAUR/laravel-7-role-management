@extends('backend.layouts.master')
@section('title')
    Role Page - Admin Panel
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
                        <p class="float-right mb-3">
                            <a class="btn btn-sm btn-success" href="{{ route('admin.roles.create') }}">Add New</a>
                        </p>
                        <div class="clearfix"></div>
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th width="5%">SL No</th>
                                        <th width="10%">Name</th>
                                        <th width="60%">Permissions</th>
                                        <th width="20%">Action</th>
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
                                        <td>
                                            <a href="{{ route('admin.roles.edit',$role->id) }}" class="btn btn-sm btn-success mb-2" title="Edit"><i class="fa fa-edit"></i></a>

                                            <form action="{{ route('admin.roles.destroy',$role->id) }}" method="POST" >
                                            @csrf
                                            @method('DELETE')
                                    
                                             <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are You Sure, You Want To Delete?')"><i class="fa fa-trash"></i></button>
                                             </form>
                                               
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
@section('script')

@endsection