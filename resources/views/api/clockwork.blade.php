@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main-container">

            @include('layouts.alert')

            <div class="page-header">
                <h2><i class="fa fa-phone"></i> Clockwork SMS API</h2>
            </div>

            <div class="btn-group btn-group-justified">
                <a href="https://github.com/mjerwin/clockwork-sms" target="_blank" class="btn btn-primary">
                    <i class="fa fa-check-square-o"></i> Clockwork Laravel
                </a>
                <a href="http://www.clockworksms.com/doc/clever-stuff/xml-interface/send-sms/" target="_blank" class="btn btn-primary">
                    <i class="fa fa-code-fork"></i> XML API
                </a>
            </div>

            <br>

            <h4>Send a text message</h4>
            <div class="row">
                <div class="col-sm-6">
                    <form role="form" method="POST" action="{{ url('/api/clockwork') }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="telephone" placeholder="Phone Number (international format)" class="form-control" />
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-success">Send</button>
                                </span>
                            </div>
                            @if ($errors->has('telephone'))
                                <span class="help-block">{{ $errors->first('telephone') }}</span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
