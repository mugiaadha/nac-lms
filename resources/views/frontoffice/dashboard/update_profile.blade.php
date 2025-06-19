@extends('frontoffice.dashboard.layouts.inner_app_layout')

@section('content')
<div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
    <div class="setting-body">
        <h3 class="fs-17 font-weight-semi-bold pb-4">Edit Profile</h3>
        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="input-box col-lg-12 py-3">
                    <div class="media media-card align-items-center">
                        <div class="media-img media-img-lg mr-4 bg-gray">
                            <img class="mr-3" src="{{ !empty(auth()->user()->photo) ? asset('storage/'.auth()->user()->photo) : asset('backoffice/images/avatars/no-image.png') }}" alt="avatar image" width="110" height="110">
                        </div>
                        <div class="media-body">
                            <div class="file-upload-wrap file-upload-wrap-2">
                                <input type="file" name="photo" class="multi file-upload-input with-preview" multiple>
                                <span class="file-upload-text"><i class="la la-photo mr-2"></i>Upload a Photo</span>
                            </div><!-- file-upload-wrap -->
                        </div>
                    </div><!-- end media -->
                </div>
                <div class="input-box col-lg-6">
                    <label class="label-text">Username</label>
                    <div class="form-group">
                        <input class="form-control form--control @error('username') is-invalid @enderror" type="text" name="username" value="{{ auth()->user()->username }}">
                        <span class="la la-user input-icon"></span>
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">Name</label>
                    <div class="form-group">
                        <input class="form-control form--control @error('name') is-invalid @enderror" type="text" name="name" value="{{ auth()->user()->name }}">
                        <span class="la la-user input-icon"></span>
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">Email Address</label>
                    <div class="form-group">
                        <input class="form-control form--control @error('email') is-invalid @enderror" type="email" name="email" value="{{ auth()->user()->email }}">
                        <span class="la la-envelope input-icon"></span>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-6">
                    <label class="label-text">Phone</label>
                    <div class="form-group">
                        <input class="form-control form--control @error('phone') is-invalid @enderror" type="text" name="phone" value="{{ auth()->user()->phone }}">
                        <span class="la la-phone input-icon"></span>
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div><!-- end input-box -->
                <div class="input-box col-lg-12">
                    <label class="label-text">Address</label>
                    <div class="form-group">
                        <input class="form-control form--control @error('address') is-invalid @enderror" type="text" name="address" value="{{ auth()->user()->address }}">
                        <span class="la la-map-marker input-icon"></span>
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="input-box col-lg-12 py-2">
                    <button class="btn theme-btn">Save Changes</button>
                </div><!-- end input-box -->
            </div>
        </form>
    </div><!-- end setting-body -->
</div><!-- end tab-pane -->
@endsection