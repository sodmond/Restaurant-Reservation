@extends('layouts.admin', ['title' => 'Profile Settings', 'activePage' => 'settings'])

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Profile Settings</h1>
</div>

<div class="row">
    <div class="col">
        @if (count($errors))
            <div class="alert alert-danger">
                <strong>Whoops!</strong> Error validating data.<br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('suc_msg'))
            <div class="alert alert-success" role="alert">{{ session('suc_msg') }}</div>
        @endif
        @if (session('err_msg'))
            <div class="alert alert-danger" role="alert">{{ session('err_msg') }}</div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">Edit Profile</h6>
            </div>
            <div class="card-body row">
                <div class="col-md-12">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                    @endif
                    <form action="{{ route('admin.profile.edit') }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="name" id="name" value="{{ Auth::user()->name }}" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">Email</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-9 offset-md-3">
                                <input type="submit" class="btn btn-mv col" value="Save">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark">Change password</h6>
            </div>
            <div class="card-body row">
                <div class="col-md-12">
                    @if (session('status_password'))
                        <div class="alert alert-success" role="alert">{{ session('status_password') }}</div>
                    @endif
                    <form action="{{ route('admin.profile.password') }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label for="input-current-password" class="col-md-3 col-form-label text-md-right">Current Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="old_password" id="input-current-password" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="input-password" class="col-md-3 col-form-label text-md-right">New Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password" id="input-password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="input-password-confirmation" class="col-md-3 col-form-label text-md-right">Confirm Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password_confirmation" id="input-password-confirmation" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-9 offset-md-3">
                                <input type="submit" class="btn btn-mv col" value="Save">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
