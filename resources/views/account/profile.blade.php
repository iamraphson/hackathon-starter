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
                        <div class="col-sm-7"><input type="email" name="email" id="email" value="{{ $account['email'] }}" class="form-control"></div>
                        @if ($errors->has('email'))
                            <span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-7"><input type="text" name="name" id="name" value="{{ $account['name'] }}" class="form-control"></div>
                        @if ($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-3 control-label">Username</label>
                        <div class="col-sm-7"><input type="text" name="username" id="username" value="{{ $account['username'] }}" class="form-control"></div>
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
                                <i class="fa fa-pencil"></i>Update Profile
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
