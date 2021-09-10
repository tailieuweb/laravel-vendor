<!--
| @TITLE
| Update existing crawler
| Add new crawler
|
|-------------------------------------------------------------------------------
| @REQUIRED
| Permission
|
|÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷
| @DESCRIPTION
| 1. Admin
| 2. Manager
| 3. User
|
|_______________________________________________________________________________
-->
@extends('package-acl::admin.layouts.base-2cols')

@section('title')
    {{ trans($plang_admin.'.pages.title-edit-job') }}
@stop

@section('content')
<div class="row">
        <div class="col-md-9">
            <div class="panel panel-info">

                <!--TITLE BAR-->
                <div class="panel-heading">
                    <h3 class="panel-title bariol-thin">
                        {!!
                            '<i class="fa fa-pencil"></i>'.trans($plang_admin.'.pages.title-edit-answer')
                        !!}
                    </h3>
                </div>

                <!--DESCRIPTION-->
                <div class='panel-description'>
                    {!! trans($plang_admin.'.descriptions.answer_form') !!}</h4>
                </div>

                <!-- ERRORS NAME  -->
                @if($errors->count() > 0)
                    <div class='panel-errors'>
                        @include('package-category::admin.partials.errors', ['errors' => $errors])
                    </div>
                @endif
                <!-- /END ERROR NAME -->

                {{-- successful message --}}
                @if(Session::get('message'))
                    <div class='panel-success'>
                        @include('package-category::admin.partials.success', ['message' => Session::get('message')])
                    </div>
                @endif

                <div class="panel-body">
                    @include('package-crawler::admin.works.jobs.job-form')
                </div>
            </div>
        </div>

        <div class='col-md-3'>
            @include('package-crawler::admin.works.jobs.job-search')
        </div>

</div>
@stop
