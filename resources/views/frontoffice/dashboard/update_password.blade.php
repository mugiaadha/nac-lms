@extends('frontoffice.dashboard.layouts.inner_app_layout')

@section('content')
<div class="tab-pane fade show active" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
    <div class="setting-body">
        <h3 class="fs-17 font-weight-semi-bold pb-4">Change Password</h3>
        <form action="{{ route('profile.update.password') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="input-box col-lg-12">
                    <label class="label-text">Current Password</label>
                    <div class="form-group">
                        <input class="form-control form--control @error('current_password') is-invalid @enderror" type="password" name="current_password" placeholder="Enter your current password">
                        <span class="la la-lock input-icon"></span>
                        @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="input-box col-lg-12">
                    <label class="label-text">New Password</label>
                    <div class="form-group">
                        <input class="form-control form--control @error('new_password') is-invalid @enderror" type="password" name="new_password" placeholder="Enter your new password">
                        <span class="la la-lock input-icon"></span>
                        @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="input-box col-lg-12">
                    <label class="label-text">Confirm Password</label>
                    <div class="form-group">
                        <input class="form-control form--control @error('new_password_confirmation') is-invalid @enderror" type="password" name="new_password_confirmation" placeholder="Confirm your new password">
                        <span class="la la-lock input-icon"></span>
                        @error('new_password_confirmation')
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