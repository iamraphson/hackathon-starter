@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main-container">

            <div class="page-header">
                <h3><i style="color: #4099ff" class="fa fa-twitter"></i> Twitter API</h3>
            </div>

            <div class="btn-group btn-group-justified">
                <a href="https://github.com/thujohn/twitter" target="_blank" class="btn btn-success">
                    <i class="fa fa-file-text-o"></i>Twit Library Docs
                </a>
                <a href="https://dev.twitter.com/docs" target="_blank" class="btn btn-success">
                    <i class="fa fa-check-square-o"></i>Overview
                </a>
                <a href="https://dev.twitter.com/docs/api/1.1" target="_blank" class="btn btn-success">
                    <i class="fa fa-code-fork"></i>API Endpoints
                </a>
            </div>
            <br />
            <div class="well">
                <h4>Compose new Tweet</h4>
                <form role="form" method="POST" action="{{ url('newtweet/send') }}">
                    {!! csrf_field() !!}
                    <div class="form-group {{ $errors->has('tweet') ? ' has-error' : '' }}">
                        <input type="text" name="tweet" id="tweet" autofocus="" class="form-control">
                        @if ($errors->has('tweet'))
                            <span class="help-block">{{ $errors->first('tweet') }}</span>
                        @endif
                    </div>
                    <p class="help-block">This new Tweet will be posted on your Twitter profile.</p>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-twitter"></i> Tweet
                    </button>
                </form>
            </div>
            <br>
            <div class="lead">Latest<strong> {{ count($tweets) }}</strong> Tweets containing the term<strong> Laravel</strong></div>
            @if(count($tweets) > 0)
                <ul class="media-list">
                    @foreach($tweets as $tweet)
                        <li class="media">
                            <a href="#" class="pull-left">
                                <img src="{{ $tweet->user->profile_image_url }}" style="width: 64px; height: 64px;" class="media-object">
                            </a>
                            <div class="media-body">
                                <strong class="media-heading">{{ $tweet->user->name }}</strong>
                                <span class="text-muted"> {{ '@'. $tweet->user->screen_name }}</span>
                                <p>{{ $tweet->text }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
