@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main-container">

            @include('layouts.alert')

            <div class="page-header">
                <h2><i style="color: #cb2027" class="fa fa-pinterest"></i> Pinterest API</h2>
            </div>

            <div class="btn-group btn-group-justified">
                <a href="https://developers.pinterest.com/docs/getting-started/introduction/" target="_blank" class="btn btn-primary">
                    <i class="fa fa-check-square-o"></i> Getting Started
                </a>
                <a href="https://developers.pinterest.com/tools/api-explorer/" target="_blank" class="btn btn-primary">
                    <i class="fa fa-pinterest"></i> API Explorer
                </a>
                <a href="https://developers.pinterest.com/docs/api/overview/" target="_blank" class="btn btn-primary">
                    <i class="fa fa-code-fork"></i> API Overview
                </a>
            </div>

            @if(isset($notSecure))
                <h3 align="center">Application Must Use https </h3>
            @else
                <h3>Create a Pin </h3>

                <form role="form" method="POST" action="{{url('/api/pinterest/pin/new')}}">
                    {!! csrf_field() !!}
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label>Board</label>
                            <select name="board" class="form-control">
                                @foreach($boards as $board)
                                    <option value="{{ $board->id }}">{{ $board->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('board'))
                                <span class="help-block">{{ $errors->first('board') }}</span>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <label>Note</label>
                            <input name="note" placeholder="The Pin's description." class="form-control"/>
                            @if ($errors->has('note'))
                                <span class="help-block">{{ $errors->first('note') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label>Link</label>
                            <input name="link" placeholder="The URL the Pin will link to when you click through." class="form-control"/>
                            @if ($errors->has('link'))
                                <span class="help-block">{{ $errors->first('link') }}</span>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <label>Image URL</label>
                            <input name="image_url" placeholder="The link to the image that you want to Pin." class="form-control"/>
                            @if ($errors->has('image_url'))
                                <span class="help-block">{{ $errors->first('image_url') }}</span>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-pinterest"></i> Pin It</button>
                </form>
            @endif
            <br>
        </div>
    </div>
@endsection
