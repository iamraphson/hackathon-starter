@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main-container">

            <div class="page-header">
                <h2><i style="color: #db1302" class="fa fa-play-circle-o"></i>Last.fm API</h2>
            </div>

            <div class="btn-group btn-group-justified">
                <a href="https://github.com/dandelionmood/php-lastfm" target="_blank" class="btn btn-primary">
                    <i class="fa fa-check-square-o"></i> Last.fm Laravel Docs
                </a>
                <a href="http://www.last.fm/api/account/create" target="_blank" class="btn btn-primary">
                    <i class="fa fa-laptop"></i> Create API Account
                </a>
                <a href="http://www.last.fm/api" target="_blank" class="btn btn-primary">
                    <i class="fa fa-code-fork"></i> API Endpoints
                </a>
            </div>

            <h3> {{ $artist['name'] }}</h3>
            <img src="{!! $artist['image'] !!}" class="thumbnail"/>

            <h3>Tags</h3>
            @foreach($artist['tags'] as $tag)
                <span class="label label-primary"><i class="fa fa-tag"></i> &nbsp{{ $tag->name }}</span>
            @endforeach

            <h3>Biography</h3>
            <p>{!!  $artist['bio'] !!}</p>

            <h3>Top Albums</h3>
            @foreach($artist['topAlbums'] as $topAlbum)
                <img src="{!!  $topAlbum->image[3]->{'#text'} !!} " title="{{ $topAlbum->name }}" width="150" height="150"/>&nbsp;
            @endforeach

            <h3>Top Tracks</h3>
            <ol>
                @foreach($artist['topTracks'] as $topTrack)
                    <li><a target="_blank" href="{!! $topTrack->url  !!}">{{ $topTrack->name }}</a></li>
                @endforeach
            </ol>

            <h3>Similar Artists</h3>
            <ul class="list-unstyled list-inline">
                @foreach($artist['similar'] as $similar)
                    <li><a href="{!! $similar->url  !!}"> {{ $similar->name }}</a></li>
                @endforeach
            </ul>

            <br>
        </div>
    </div>
@endsection
