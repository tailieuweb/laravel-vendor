@extends('package-acl::admin.layouts.base-2cols')

@section('title')
    {{ trans($plang_admin.'.pages.title-list') }}
@stop

@section('content')

    <div class="row">


            <!--LIST OF ITEMS-->
            <div class="col-md-9">

                <div class="panel panel-info">

                    <!--HEADING-->
                    <div class="panel-heading">
                        <h3 class="panel-title bariol-thin"><i class="fa fa-list-ul" aria-hidden="true"></i>
                            {!! $request->all() ? trans($plang_admin.'.pages.title-list-search') : trans($plang_admin.'.pages.title-list') !!}
                        </h3>
                    </div>

                    <!--DESCRIPTION-->
                    <div class='panel-info panel-description'>
                        {!! trans($plang_admin.'.descriptions.list') !!} <br>
                        @if($is_admin)
                            <p>Quản trị viên click <a href="{!! Url::route('forums.list',['user_id' => $user_id]) !!}">click
                                    tại đây</a> để xem các câu hỏi đã tạo
                        @endif
                    </div>
                    <!--/DESCRIPTION-->

                    <!--MESSAGE-->
                    <?php $message = Session::get('message'); ?>
                    @if( isset($message) )
                        <div class="panel-info alert alert-success flash-message">{!! $message !!}</div>
                    @endif
                <!--/MESSAGE-->

                    <!--ERRORS-->
                    @if($errors && ! $errors->isEmpty() )
                        @foreach($errors->all() as $error)

                            <div class="alert alert-danger flash-message">{!! $error !!}</div>

                    @endforeach
                @endif
                <!--/ERRORS-->

                    <!--BODY-->
                    <div class="panel-body">
                        {!! Form::open(['route'=>['forums.delete', 'id' => @$item->id], 'method' => 'get'])  !!}

                        @include('package-forum::member.forum-item')

                        {!! csrf_field(); !!}

                        {!! Form::close() !!}
                    </div>
                    <!--/BODY-->

                </div>
            </div>
            <!--/LIST OF ITEMS-->

            <!--SEARCH-->
            <div class="col-md-3">
                @include('package-forum::member.forum-search')
            </div>
            <!--/SEARCH-->


    </div>
@stop


@section('footer_scripts')
    <!-- DELETE CONFIRM -->
    <script>
        $(".delete").click(function () {
            return confirm("{!! trans($plang_admin.'.confirms.delete') !!}");
        });
    </script>
    <!-- /END DELETE CONFIRM -->
@stop
