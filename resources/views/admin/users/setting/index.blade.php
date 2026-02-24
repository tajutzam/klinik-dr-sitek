@extends('layouts.admin.app')

@section('content')
    <div class="container-xxl" id="kt_content_container">
        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-9 pb-0">
                <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <a href="#"
                                        class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{ Auth::user()->name }}</a>
                                </div>
                                <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                    <span class="d-flex align-items-center text-gray-400 me-5 mb-2">
                                        <i class="ki-duotone ki-sms fs-4 me-1"><span class="path1"></span><span
                                                class="path2"></span></i>
                                        {{ Auth::user()->email }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0">
                <div class="card-title m-0">
                    <h3 class="fw-bolder m-0">Profile Details</h3>
                </div>
            </div>
            <div id="kt_account_settings_profile_details" class="collapse show">
                <form action="{{ route('admin.profile.update') }}" method="POST" class="form">
                    @csrf
                    @method('PUT')
                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Full Name</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name" class="form-control form-control-lg form-control-solid"
                                    placeholder="Full name" value="{{ old('name', Auth::user()->name) }}" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Email Address</label>
                            <div class="col-lg-8 fv-row">
                                <input type="email" name="email" class="form-control form-control-lg form-control-solid"
                                    placeholder="Email address" value="{{ old('email', Auth::user()->email) }}" />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                        <button type="submit" class="btn btn-secondary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0">
                <div class="card-title m-0">
                    <h3 class="fw-bolder m-0">Sign-in Method</h3>
                </div>
            </div>
            <div class="card-body border-top p-9">
                <form action="{{ route('admin.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-6">
                        <div class="col-lg-4">
                            <div class="fs-6 fw-bold mt-2 mb-3">Current Password</div>
                        </div>
                        <div class="col-lg-8 fv-row">
                            <input type="password" name="current_password"
                                class="form-control form-control-lg form-control-solid" placeholder="Current Password" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <div class="col-lg-4">
                            <div class="fs-6 fw-bold mt-2 mb-3">New Password</div>
                        </div>
                        <div class="col-lg-8 fv-row">
                            <input type="password" name="password" class="form-control form-control-lg form-control-solid"
                                placeholder="New Password" />
                        </div>
                    </div>
                    <div class="row mb-6">
                        <div class="col-lg-4">
                            <div class="fs-6 fw-bold mt-2 mb-3">Confirm New Password</div>
                        </div>
                        <div class="col-lg-8 fv-row">
                            <input type="password" name="password_confirmation"
                                class="form-control form-control-lg form-control-solid" placeholder="Confirm Password" />
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end py-6 px-0">
                        <button type="submit" class="btn btn-secondary">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection