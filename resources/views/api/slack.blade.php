@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main-container">

            @include('layouts.alert')

            <div class="page-header">
                <h2><i style="color: #f00" class="fa fa-slack"></i> Slack API</h2>
            </div>

            <div class="btn-group btn-group-justified">
                <a href="https://github.com/vluzrmos/laravel-slack-api" target="_blank" class="btn btn-primary">
                    <i class="fa fa-check-square-o"></i>  Laravel Slack
                </a>
                <a href="https://api.slack.com/" target="_blank" class="btn btn-primary">
                    <i class="fa fa-code-fork"></i> REST API
                </a>
            </div>
            <br/>

            <h3> Get All Users On Your Team (RED-CREEK)</h3>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Picture</th>
                        <th>Full Name</th>
                        <th>Slack Handle</th>
                    </tr>
                </thead>
                <tbody>
                <?php $count = 1 ?>
                @foreach($team as $member)
                    <tr>
                        <td>{{ $count }}</td>
                        <td><img src="{!!  $member->profile->image_72 !!}"></td>
                        <td>{{ $member->profile->real_name  }}</td>
                        <td>{{ $member->name }}</td>
                    </tr>
                    <?php $count++ ?>
                @endforeach
                </tbody>
            </table>
            <br>
            <h3> Send Message to a Slack Channel Or Group</h3>
            <div class="row">
                <div class="col-sm-6">
                    <form role="form" method="POST" action="{{ url('/api/slack/sendmessage') }}">
                        {!! csrf_field() !!}
                        <div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">
                            <label class="control-label">Message</label>
                            <input type="text" name="message" class="form-control">
                            @if ($errors->has('message'))
                                <span class="help-block">{{ $errors->first('message') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-location-arrow"></i> Send
                        </button>
                    </form>
                </div>
            </div>
            <br>
        </div>
    </div>
@endsection
