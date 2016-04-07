@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main-container">

            <div class="page-header">
                <h2><i style="color: #ff6600" class="fa fa-hacker-news"></i> Web Scraping</h2>
            </div>

            <div class="btn-group btn-group-justified">
                <a href="https://github.com/FriendsOfPHP/Goutte" target="_blank" class="btn btn-primary">
                    <i class="fa fa-info"></i> Goutte Web Scrapper
                </a>
                <a href="http://symfony.com/doc/current/components/dom_crawler.html?any" target="_blank" class="btn btn-primary">
                    <i class="fa fa-file-text-o"></i> Documentation
                </a>
            </div>

            <h3>Hacker News Frontpage</h3>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Title</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1;?>
                    @foreach($datas as $data)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{!! $data[0] !!}</td>
                        </tr>
                        <?php $count++ ?>
                    @endforeach
                </tbody>
            </table>

            <br>
        </div>
    </div>
@endsection
