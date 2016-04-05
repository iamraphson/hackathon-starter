@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main-container">

            <div class="page-header">
                <h2><i class="fa fa-building-o"></i> New York Times API</h2>
            </div>

            <div class="btn-group btn-group-justified">
                <a href="http://developer.nytimes.com/page" target="_blank" class="btn btn-primary">
                    <i class="fa fa-check-square-o"></i> Overview
                </a>
                <a href="http://prototype.nytimes.com/gst/apitool/index.html" target="_blank" class="btn btn-primary">
                    <i class="fa fa-laptop"></i> API Console
                </a>
                <a href="http://developer.nytimes.com/docs" target="_blank" class="btn btn-primary">
                    <i class="fa fa-code-fork"></i> API Endpoints
                </a>
            </div>

            <h4>Young Adult Best Sellers</h4>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Title</th>
                        <th class="hidden-xs">Description</th>
                        <th>Author</th>
                        <th class="hidden-xs">ISBN-13</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book['rank'] }}</td>
                        <td>{{ $book['book_details'][0]['title'] }}</td>
                        <td class="hidden-xs">{{ $book['book_details'][0]['description'] }}</td>
                        <td>{{ $book['book_details'][0]['author'] }}</td>
                        <td class="hidden-xs">{{ $book['book_details'][0]['primary_isbn13'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>
        </div>
    </div>
@endsection
