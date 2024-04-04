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
    {{ trans($plang_admin.'.pages.title-question-and-answer') }}
@stop

@section('content')
    <div class="row">
            <div class="col-md-9">
                    <div class="row col-md-12">
                        <div class="panel panel-info">

                            <!--TITLE BAR-->
                            <div class="panel-heading">
                                <h3 class="panel-title bariol-thin">
                                    {!! !empty($item->id)
                                        ?
                                        '<i class="fa fa-question" aria-hidden="true"></i>&nbsp'.trans($plang_admin.'.pages.title-question')
                                        :
                                        '<i class="fa fa-question" aria-hidden="true"></i>&nbsp'.trans($plang_admin.'.pages.title-question')
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
                                            <li class="list-group-item text-muted" contenteditable="false">Người đặt câu hỏi</li>
                                            <li class="list-group-item text-right"><span class="pull-left"><strong class="">Họ và tên</strong></span> Admin</li>
                                            <li class="list-group-item text-right"><span class="pull-left"><strong class="">Email</strong></span> admin@admin.com</li>
                                            <li class="list-group-item text-right"><span class="pull-left"><strong class="">Thảo luận</strong></span> 0 bài đăng

                                            </li>
                                        </ul>

                                    </div>
                                    <!--/col-9-->
                                    <div class="col-md-9 col-sm-9" style="" contenteditable="false">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <span>Cần chuẩn bị như thế nào trong buổi phỏng vấn</span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i> 04/04/2024
                                                </span>
                                            </div>
                                            <div class="panel-body">Xin nhờ Thầy/Cô và các bạn chia sẻ giúp 1 số kinh nghiệm khi tham gia phỏng vấn
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-danger">Câu hỏi đã đóng</button>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                            Trả lời
                                        </button>
                                    </div>

                                    <div id="push"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        @include('package-forum::admin.forum-answers')
                    </div>
            </div>

            <div class='col-md-3'>
                @include('package-forum::admin.forum-search')
            </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Đăng câu trả lời</h4>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" rows="3"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary">Trả lời</button>
                </div>
            </div>
        </div>
    </div>
@stop
