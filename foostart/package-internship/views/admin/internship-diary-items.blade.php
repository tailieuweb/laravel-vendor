@extends('package-acl::admin.layouts.base-2cols')

@section('title')
    {{ trans($plang_admin.'.pages.title-course') }}
@stop

@section('content')

    <div class="row">

            <!--LIST OF ITEMS-->
            <div class="col-md-9">

                <div class="panel panel-info">

                    <!--HEADING-->
                    <div class="panel-heading">
                        <h3 class="panel-title bariol-thin"><i class="fa fa-list-ul" aria-hidden="true"></i>
                            {!! $request->all() ? trans($plang_admin.'.pages.title-list-search-diary') : trans($plang_admin.'.pages.internship-title-diary') !!}
                        </h3>
                    </div>


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
                        <div class='row'>
                            <div class="col-md-12">
                            <a href="{!! URL::route('internship.diary.edit',['course_id' => $course_id, 'internship_id' => $internship_id, '_token' => csrf_token()]) !!}"
                               class="btn btn-success pull-left margin-left-5 restore">
                                {!! trans($plang_admin.'.buttons.diary_add') !!}
                            </a>
                            </div>
                        </div>
                        {!! Form::open(['route'=>['company.delete', 'id' => @$item->id], 'method' => 'get'])  !!}

                            @include('package-internship::admin.internship-diary-item')

                            {!! csrf_field(); !!}

                        {!! Form::close() !!}
                    </div>
                    <!--/BODY-->

                </div>
            </div>
            <!--/LIST OF ITEMS-->

            <!--SEARCH-->
            <div class="col-md-3">
                @include('package-internship::admin.internship-search')
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
