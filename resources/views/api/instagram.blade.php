@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main-container">

            <div class="page-header">
                <h2><i class="fa fa-instagram" style='color: #517fa4'></i> Instagram API</h2>
            </div>

            <div class="btn-group btn-group-justified">
                <a href="http://instagram.com/developer/" target="_blank" class="btn btn-primary">
                    <i class="fa fa-check-square-o"></i> Overview
                </a>
                <a href="https://github.com/larabros/elogram" target="_blank" class="btn btn-primary">
                    <i class="fa fa-laptop"></i> Instagram Docs
                </a>
                <a href="http://instagram.com/developer/endpoints/" target="_blank" class="btn btn-primary">
                    <i class="fa fa-code-fork"></i> API Endpoints
                </a>
            </div>

            <br />
            <p class="lead">Username Search for<strong> iamrapshon</strong></p>
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>Picture</th>
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Bio</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="{!! $username['profile_picture'] !!}" width="75" height="75"/></td>
                        <td>{{ $username['username'] }}</td>
                        <td>{{ $username['full_name'] }}</td>
                        <td>{{ $username['bio'] }}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <hr />
            <p class="lead">User Search for ID<strong> 224366365</strong></p>
            <div class="media">
                <a href="http://instagram.com/{!! $userbyid['username'] !!}" class="pull-left">
                    <img src="{!! $userbyid['profile_picture'] !!}" width="110" height="110" class="thumbnail"/>
                </a>
                <div class="media-body">
                    <h4>{{ $userbyid['full_name'] }}</h4>
                    <p> {{ $userbyid['bio'] }}</p>
                </div>
            </div>
            <br>
            <hr />
            <p class="lead">My Recent<strong> Media</strong></p>
            <div class="row">
                @foreach($recentMedia as $image)
                    <div class="col-xs-3"><a target="_blank" href="{!! $image['link'] !!}" class="thumbnail"><img src="{!! $image['images']['standard_resolution']['url'] !!}}}" height="320px"/></a></div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
