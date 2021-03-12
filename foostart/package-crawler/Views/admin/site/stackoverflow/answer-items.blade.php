@extends('package-acl::admin.layouts.base-2cols')

@section('title')
    {{ trans($plang_admin.'.pages.title-answers') }}
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">

            <!--LIST OF ITEMS-->
            <div class="col-md-9">

                <div class="panel panel-info">

                    <!--HEADING-->
                    <div class="panel-heading">
                        <h3 class="panel-title bariol-thin"><i class="fa fa-list-ul" aria-hidden="true"></i>
                            {!! $request->all() ? trans($plang_admin.'.pages.title-list-search-answers') : trans($plang_admin.'.pages.title-answers') !!}
                        </h3>
                    </div>

                    <!--DESCRIPTION-->
                    <div class='panel-info panel-description'>
                        {!! trans($plang_admin.'.descriptions.list') !!}</h4>
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

                        <!--ADD BUTTONS-->
                        <div class='btn-form'>
                            <a href="{!! URL::route('stackoverflow_answer.crawler',['question_id' => $question_id,'_token' => csrf_token()]) !!}"
                               class="btn btn-info">
                                {!! trans($plang_admin.'.buttons.crawl_answer') !!}
                            </a>
                        </div>
                        <!--/ADD BUTTONS-->

                        {!! Form::open(['route'=>['sites.delete', 'id' => @$item->id], 'method' => 'get'])  !!}

                            @include('package-crawler::admin.site.stackoverflow.answer-item')
                            {!! csrf_field(); !!}

                        {!! Form::close() !!}
                    </div>
                    <!--/BODY-->

                </div>
            </div>
            <!--/LIST OF ITEMS-->

            <!--SEARCH-->
            <div class="col-md-3">
                @include('package-crawler::admin.site.stackoverflow.answer-search')
            </div>
            <!--/SEARCH-->

        </div>
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
