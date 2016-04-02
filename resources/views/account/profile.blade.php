@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('layouts.alert')
                <div class="page-header"><h3>Profile Information</h3></div>
                <form action="{{ url('/account/profile') }}" method="POST" class="form-horizontal">
                    {!! csrf_field()  !!}
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-7">
                            <input type="email" name="email" id="email" value="{{ $account['email'] }}" class="form-control">
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-7">
                            <input type="text" name="name" id="name" value="{{ $account['name'] }}" class="form-control">
                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Username</label>
                        <div class="col-sm-7">
                            <input type="text" name="username" id="username" value="{{ $account['username'] }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gender" class="col-sm-3 control-label">Gender</label>
                        <div class="col-sm-4">
                            <label class="radio col-sm-4">
                                <input type="radio" checked="" name="gender"
                                       @if($account['gender'] == "M")
                                        {{ 'checked="checked"' }}
                                       @endif
                                       value="M"  data-toggle="radio">
                                <span>Male</span>
                            </label>
                            <label class="radio col-sm-4">
                                <input type="radio" name="gender" value="F"
                                   @if($account['gender'] == "F")
                                   {{ 'checked="checked"' }}
                                   @endif
                                   data-toggle="radio">
                                <span>Female</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location" class="col-sm-3 control-label">Location</label>
                        <div class="col-sm-7">
                            <input type="text" name="location" id="location" value="{{ $account['location'] }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="website" class="col-sm-3 control-label">Website</label>
                        <div class="col-sm-7">
                            <input type="text" name="website" id="website" value="{{ $account['website'] ? $account['website'] : "" }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-4">
                            <button type="submit" class="btn btn btn-primary">
                                <i class="fa fa-pencil"></i> Update Profile
                            </button>
                        </div>
                    </div>
                </form>
                <div class="page-header">
                    <h3>Manage Your Avatar Here</h3>
                </div>
                <form role="form" method="POST" action="{{ url('account/photo') }}" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group">
                        <label for="gravatar" class="col-sm-2 control-label">Gravatar</label>
                        <div class="col-sm-4">
                            <img src="{!! $account->getAvatar() !!}" width="100" height="100" class="profile">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gravatar" class="col-sm-2 control-label"></label>
                        <div class="col-sm-4">
                            <input type="file" name="file_name" id="file_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-8">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Change Avatar</button>
                        </div>
                    </div>
                    {!! csrf_field() !!}
                </form>

                <div class="page-header">
                    <h3>Change Password</h3>
                </div>
                <form action="/account/password" method="POST" class="form-horizontal">
                    {!! csrf_field() !!}
                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-sm-3 control-label">New Password</label>
                        <div class="col-sm-7">
                            <input type="password" name="password" id="password" class="form-control">
                            @if ($errors->has('password'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                    </div>
                    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password_confirmation" class="col-sm-3 control-label">Confirm Password</label>
                        <div class="col-sm-7">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-lock"></i> Change Password
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
