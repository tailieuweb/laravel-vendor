<!--
| TITLE
| Update existing post
| Add new post
|
|-------------------------------------------------------------------------------
| REQUIRED
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
    {{ trans($plang_admin.'.pages.title-edit') }}
@stop

@section('content')
    <div class="row">
            <div class="col-md-9">
                <div class="panel panel-info">

                    <!--TITLE BAR-->
                    <div class="panel-heading">
                        <h3 class="panel-title bariol-thin">
                            {!! !empty($item->id)
                                ?
                                '<i class="fa fa-pencil"></i>&nbsp'.trans($plang_admin.'.pages.title-edit')
                                :
                                '<i class="fa fa-pencil"></i>&nbsp'.trans($plang_admin.'.pages.title-add')
                            !!}
                        </h3>
                    </div>

                    <!--DESCRIPTION-->
                    <div class='panel-description'>
                        {!! trans($plang_admin.'.descriptions.form') !!}</h4>
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
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <!--left col-->
                                <ul class="list-group">
                                    <li class="list-group-item text-muted" contenteditable="false">Profile</li>
                                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Joined</strong></span> 2.13.2014</li>
                                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Real name</strong></span> Joseph
                                        Doe</li>
                                    <li class="list-group-item text-right"><span class="pull-left"><strong class="">Role: </strong></span> Pet Sitter

                                    </li>
                                </ul>

                            </div>
                            <!--/col-3-->
                            <div class="col-md-9 col-sm-9" style="" contenteditable="false">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Starfox221's Bio</div>
                                    <div class="panel-body"> A long description about me.
                                    </div>
                                </div>
                            </div>

                            <div id="push"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class='col-md-3'>
                @include('package-forum::admin.forum-search')
            </div>

    </div>
@stop
