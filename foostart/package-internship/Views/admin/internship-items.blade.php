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
                            {!! $request->all() ? trans($plang_admin.'.pages.title-list-search-company') : trans($plang_admin.'.pages.title-internship-course') !!}
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
                        <div class="alert alert-warning" role="alert">
                            <h4>Hồ sơ sinh viên thực tập chỉ <b>hợp lệ</b> khi có đủ thông tin sau</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <caption>Thông tin sinh viên</caption>
                                    <ul class="list-group">
                                        <li class="list-group-item">1. Họ và tên</li>
                                        <li class="list-group-item">2. Số điện thoại</li>
                                        <li class="list-group-item">3. Mã số sinh viên (đã được tạo, là tài khoản đăng nhập)</li>
                                        <li class="list-group-item"><b>4. Lớp (cập nhật tại thông tin công ty)</b></li>

                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <caption>Thông tin công ty</caption>
                                    <ul class="list-group">
                                        <li class="list-group-item">1. Tên công ty</li>
                                        <li class="list-group-item">2. Địa chỉ công ty</li>
                                        <li class="list-group-item">3. Số điện thoại</li>
                                        <li class="list-group-item">4. Người hướng dẫn tại công ty</li>
                                        <li class="list-group-item">5. Số điện thoại người hướng dẫn</li>
                                        <li class="list-group-item">6. Lĩnh vực hoạt động</li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        {!! Form::open(['route'=>['company.delete', 'id' => @$item->id], 'method' => 'get'])  !!}

                            @include('package-internship::admin.internship-item')

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
