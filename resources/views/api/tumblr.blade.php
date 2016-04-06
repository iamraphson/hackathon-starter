@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main-container">

            <div class="page-header">
                <h2><i class="fa fa-tumblr-square"></i>  Tumblr API</h2>
            </div>

            <div class="btn-group btn-group-justified">
                <a href="http://www.tumblr.com/docs/en/api/v2#overview/" target="_blank" class="btn btn-primary">
                    <i class="fa fa-check-square-o"></i> Overview
                </a>
                <a href="https://api.tumblr.com/console" target="_blank" class="btn btn-primary">
                    <i class="fa fa-laptop"></i> API Console
                </a>
                <a href="http://www.tumblr.com/docs/en/api/v2#blog_methods" target="_blank" class="btn btn-primary">
                    <i class="fa fa-code-fork"></i> API Endpoints
                </a>
            </div>

            <h3 class="text-primary"> {{ $posts['response']->blog->title }}</h3>

            <div class="btn btn-xs btn-primary-outline">
                <i class="fa fa-file-text-o"></i> &nbsp; {{ $posts['response']->blog->total_posts }} Posts
            </div>

           @if ($posts)
                <ul class="media-list">
                    @foreach($posts['response']->posts as $post)
                        <li class="media">
                            <div class="media-body">
                                <strong class="media-heading">
                                    <a target="_blank" href="{{ $post->post_url }}">{!! $post->slug !!} </a>
                                </strong>
                                <span class="text-muted">{!!  isset($post->caption) ? $post->caption : '' !!}</span>
                                <span class="text-muted"> {{ $post->date }}</span>
                                <p>{!! $post->summary !!}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
            <br>
        </div>
    </div>
@endsection
