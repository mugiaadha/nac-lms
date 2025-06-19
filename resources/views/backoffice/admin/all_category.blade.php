@extends('backoffice.admin.layouts.inner_app_layout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Category</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Category</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('category.add') }}" class="btn btn-primary px-5">Add Category</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" style="width:100%" data-table>
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>Slug</th>
                                <th>Category Image</th>
                                <th>Category Name</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->category_slug }}</td>
                                <td><img src="{{ !empty($item->category_image) ? asset('storage/'.$item->category_image) : asset('backoffice/images/avatars/no-image.png') }}" alt=""></td>
                                <td>{{ $item->category_name }}</td>
                                <td>
                                    <a href="" class=" btn btn-primary px-5">Edit</a>
                                    <a href="" class="btn btn-danger px-5">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Start date</th>
                                <th>Salary</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection