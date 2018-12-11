@extends('layouts.master')

@section('content')
    <h2>Upload File Here</h2>


    {!! Form::open(array('url'=> '/handleUpload','files'=>true)) !!}

        {!! Form::file('file') !!}
        {!! Form::token() !!}
        {!! Form::submit('Upload') !!}


    {!! Form::close() !!}

    <h2>Check Number Tool</h2>
    {!! Form::open(array('url'=> '/checkNumber')) !!}

        {!! Form::label('number', 'Mobile Number') !!}
        {!! Form::text('number') !!}
        {!! Form::token() !!}
        {!! Form::submit('Check Number') !!}


    {!! Form::close() !!}

@endsection
