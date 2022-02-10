@extends('package-acl::admin.layouts.base-2cols')

@section('title')
    {!! trans($plang_admin.'.pages.permission-list') !!}
@stop

@section('content')

    <div class="row">
            <div class="col-md-9">
                {{-- print messages --}}
                <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                    <div class="alert alert-success">{{$message}}</div>
                @endif
                {{-- print errors --}}
                @if($errors && ! $errors->isEmpty() )
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
                @endif
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title bariol-thin"><i class="fa fa-lock"></i> Permissions</h3>
                    </div>
                    <div class="panel-body">
                        <!--BODY-->
                        {!! Form::open(['route'=>['permissions.delete'], 'method' => 'get', 'class'=>'form-responsive'])  !!}
                            @include('package-acl::admin.permission.permission-table')
                            {!! csrf_field(); !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                @include('package-acl::admin.permission.search')
            </div>
    </div>
@stop

@section('footer_scripts')
    <script>
        $(".delete").click(function () {
            return confirm("{!! trans($plang_admin.'.messages.user-delete') !!}");
        });
    </script>
@stop
