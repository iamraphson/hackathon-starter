@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>API Examples</h2>
        <hr/>
        <div class="row">
            <div class="col-sm-4">
                <a href="/api/github" style="color: #fff">
                    <div style="background-color: #000" class="panel panel-default">
                        <div class="panel-body"><img src="http://i.imgur.com/2AaBlpf.png" height="40"> GitHub</div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="/api/twitter" style="color: #fff">
                    <div style="background-color: #00abf0" class="panel panel-default">
                        <div class="panel-body"><img src="http://i.imgur.com/EYA2FO1.png" height="40"> Twitter</div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="/api/facebook" style="color: #fff">
                    <div style="background-color: #3b5998" class="panel panel-default">
                        <div class="panel-body">
                            <img src="http://i.imgur.com/jiztYCH.png" height="40"> Facebook
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="/api/foursquare" style="color: #fff">
                    <div style="background-color: #1cafec" class="panel panel-default">
                        <div class="panel-body">
                            <img src="http://i.imgur.com/PixH9li.png" height="40"> Foursquare
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
