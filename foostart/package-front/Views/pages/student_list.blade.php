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
    
    <div class="container">
        
        <div class="col-md-8">
            @include('package-front::blocks.143-content')
            @include('package-front::blocks.144-content')
        </div>
        <div class="col-md-4">
            @include('package-front::blocks.153-content')
            @include('package-front::blocks.154-content')
            @include('package-front::blocks.137-content')
            @include('package-front::blocks.155-content')
        </div>
        
        
    </div>
    
    @include('package-front::blocks.177-content')
@stop