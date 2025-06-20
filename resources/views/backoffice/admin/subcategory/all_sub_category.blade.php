@extends('backoffice.admin.layouts.inner_app_layout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Sub Category</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Sub Category</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('sub-category.add') }}" class="btn btn-primary px-5">Add Sub Category</a>
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
                                <th>Category Name</th>
                                <th>Sub Category Name</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subcategory as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->category->category_name }}</td>
                                <td>{{ $item->sub_category_name }}</td>
                                <td>
                                    <a href="{{ route('sub-category.edit', $item->id) }}" class=" btn btn-primary px-5">Edit</a>
                                    <a href="{{ route('sub-category.delete', $item->id) }}" class="btn btn-danger px-5" id="delete">Delete</a>
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
@endsection