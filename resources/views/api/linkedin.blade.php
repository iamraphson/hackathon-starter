@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main-container">

            <div class="page-header">
                <h3><i style="color: #335397" class="fa fa-linkedin-square"></i> LinkedIn API</h3>
            </div>

            <div class="btn-group btn-group-justified">
                <a href="https://github.com/Happyr/LinkedIn-API-client" target="_blank" class="btn btn-primary">
                    <i class="fa fa-book"></i> Laravel LinkedLn Docs
                </a>
                <a href="http://developer.linkedin.com/documents/authentication" target="_blank" class="btn btn-primary">
                    <i class="fa fa-check-square-o"></i> Getting Started
                </a>
                <a href="http://developer.linkedin.com/apis" target="_blank" class="btn btn-primary">
                    <i class="fa fa-code-fork"></i> API Endpoints
                </a>
            </div>

            <h3> My LinkedIn Profile</h3>

            <div class="well well-sm">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-2"><br><img src="" class="thumbnail"></div>
                        <div class="col-sm-10">
                            <h3>{{ $user['firstName'] }} {{ $user['lastName'] }}</h3>
                            <h4>{{ $user['positions']['values'][0]['title'] }} at {{ $user['positions']['values'][0]['company']['name'] }}</h4>
                            <span class="text-muted">{{ $user['location']['name'] }} | {{ $user['industry'] }}</span>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <dl class="dl-horizontal">
                            <dt class="text-muted">Current</dt>
                            <dd><strong>{{ $user['positions']['values'][0]['title'] }}</strong> at<strong> {{ $user['positions']['values'][0]['company']['name'] }}</strong></dd>
                            <dt class="text-muted">Email</dt>
                            <dd><strong>{{ $user['emailAddress'] }}</strong></dd>
                            <dt class="text-muted">Connections</dt>
                            <dd><strong>{{ $user['numConnections'] }}</strong> connections</dd>
                        </dl>
                        <div class="text-center"><small class="text-muted">{{ $user['publicProfileUrl'] }}</small></div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
@endsection
