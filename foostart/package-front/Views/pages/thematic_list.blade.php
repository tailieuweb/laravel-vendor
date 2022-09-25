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
    
    @include('package-front::blocks.170-content')
    
    <div class="container">
        <div class="row">
            @include('package-front::blocks.143-content')
            @include('package-front::blocks.143-content')
            @include('package-front::blocks.143-content')
            @include('package-front::blocks.158-content')
        </div>
    </div>
    
    @include('package-front::blocks.177-content')
@stop