@extends('package-front::layouts.foostart')

<!--/TITLE-->
@section('title')
    {!! $title !!}
@stop

<!--ASSETS-->
@section('asset_lib')
    @foreach ($assets as $item)
        {!! $item !!}
    @endforeach
@stop

<!--CONTENT-->
@section('content')
    @include('package-front::blocks.133-content')
    @include('package-front::blocks.134-content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                @include('package-front::blocks.136-content')
                @include('package-front::blocks.176-content')
                @include('package-front::blocks.137-content')
                @include('package-front::blocks.138-content')
            </div>
            <div class="col-md-8">
                @include('package-front::blocks.139-content')
                @include('package-front::blocks.178-content')
                @include('package-front::blocks.141-content')
                @include('package-front::blocks.142-content')
            </div>
        </div>
    </div>
    @include('package-front::blocks.177-content')
@stop
