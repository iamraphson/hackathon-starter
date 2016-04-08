@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main-container">

            @include('layouts.alert')

            <div class="page-header">
                <h2><i style="color: #f00" class="fa fa-phone"></i> Twilio API</h2>
            </div>

            <div class="btn-group btn-group-justified">
                <a href="https://github.com/aloha/laravel-twilio" target="_blank" class="btn btn-primary">
                    <i class="fa fa-check-square-o"></i> Twilio Laravel
                </a>
                <a href="https://apigee.com/console/twilio" target="_blank" class="btn btn-primary">
                    <i class="fa fa-laptop"></i> API Console
                </a>
                <a href="https://www.twilio.com/docs/api/rest" target="_blank" class="btn btn-primary">
                    <i class="fa fa-code-fork"></i> REST API
                </a>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-6">
                    <form role="form" method="POST" action="{{ url('/api/twilio') }}">
                        {!! csrf_field() !!}
                        <div class="form-group {{ $errors->has('number') ? ' has-error' : '' }}">
                            <label class="control-label">Number to text</label>
                            <input type="text" name="number" autofocus="autofocus" placeholder="+2348091167643" class="form-control"/>
                            @if ($errors->has('number'))
                                <span class="help-block">{{ $errors->first('number') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">
                            <label class="control-label">Message</label>
                            <input type="text" name="message" class="form-control"/>
                            @if ($errors->has('message'))
                                <span class="help-block">{{ $errors->first('message') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-default"><i class="fa fa-location-arrow"></i> Send</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
