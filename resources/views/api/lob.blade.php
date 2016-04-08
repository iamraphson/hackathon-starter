@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main-container">

            <div class="page-header">
                <h2><i class="fa fa-envelope"></i> Lob API</h2>
            </div>

            <div class="btn-group btn-group-justified">
                <a href="https://lob.com/docs" target="_blank" class="btn btn-primary">
                    <i class="fa fa-check-square-o"></i> API Documentation
                </a>
                <a href="https://github.com/lob/lob-php" target="_blank" class="btn btn-primary">
                    <i class="fa fa-code"></i> Lob Laravel Docs
                </a>
                <a href="https://dashboard.lob.com/register" target="_blank" class="btn btn-primary">
                    <i class="fa fa-gear"></i> Create API Account
                </a>
            </div>
            <br>

            <h3>Delivery routes in 10007</h3>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Route</th>
                        <th># of Residential Addresses</th>
                        <th># of Business Addresses</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td>{{ $data['route'] }}</td>
                            <td>{{ $data['residential'] }}</td>
                            <td>{{ $data['business'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
