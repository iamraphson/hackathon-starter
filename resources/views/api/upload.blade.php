@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="main-container">

            @include('layouts.alert')

            <div class="page-header">
                <h2><i class="fa fa-upload"></i> File Upload</h2>
            </div>

            <div class="btn-group btn-group-justified">
                <a href="https://laravel.com/docs/5.2/filesystem" target="_blank" class="btn btn-success">
                    <i class="fa fa-book"></i> Laravel Documentation
                </a>
                <a href="http://tutsnare.com/upload-files-in-laravel/" target="_blank" class="btn btn-success">
                    <i class="fa fa-laptop"></i>  Upload's Article
                </a>
            </div>
            <br>

            <h3>File Upload Form</h3>
            <div class="row">
                <div class="col-sm-6">
                    <p>All files will be uploaded to "/storage/app/" directory.</p>
                    <form role="form" enctype="multipart/form-data" method="POST" action="{{ url('/api/upload/apply') }}">
                        {!! csrf_field() !!}
                        <div class="form-group {{ $errors->has('myFile') ? ' has-error' : '' }}">
                            <label class="control-label">File Input</label>
                            <input type="file" name="myFile" />
                            @if ($errors->has('myFile'))
                                <span class="help-block">{{ $errors->first('myFile') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
