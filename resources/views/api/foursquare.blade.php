@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main-container">

            <div class="page-header">
                <h2><i class="fa fa-foursquare"></i>Foursquare API</h2>
            </div>

            <div class="btn-group btn-group-justified">
                <a href="https://developer.foursquare.com/start" target="_blank" class="btn btn-primary">
                    <i class="fa fa-check-square-o"></i> Getting Started
                </a>
                <a href="https://developer.foursquare.com/docs/explore" target="_blank" class="btn btn-primary">
                    <i class="fa fa-laptop"></i> API Console
                </a>
                <a href="https://developer.foursquare.com/docs/" target="_blank" class="btn btn-primary">
                    <i class="fa fa-code-fork"></i> API Endpoints
                </a>
            </div>

            <h3><i class="fa fa-user"></i> List Of Venues Near Lagos, Nigeria (You can specify your location)</h3>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        {{--<th>category</th>--}}
                        <th>Geopoints</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    @foreach($locations as $location)
                        <tr>
                            <td>{{ $count }}</td>
                            <td>{{ $location['name'] }}</td>
                            {{--<td>{{ $cat['name'] }}</td>--}}
                            <td>{{ $location['location']['lat'] }}, {{ $location['location']['lng'] }}</td>
                        </tr>
                        <?php $count++; ?>
                    @endforeach
                </tbody>
            </table>

            <br>
        </div>
    </div>
@endsection
