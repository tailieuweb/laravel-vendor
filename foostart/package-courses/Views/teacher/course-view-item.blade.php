<?php
$withs = [
    'counter' => '5%',
    'user_name' => '10%',
    'first_name' => '15%',
    'last_name' => '10%',
    'phone' => '15%',
    'email' => '15%',
    'status' => '10%',
    'operations' => '15%',
];
?>

@if(!empty($items))
    <div style="min-height: 50px;">
        <div>
            @if(count($items) == 1)
                {!! trans($plang_admin.'.descriptions.student_counter', ['number' => 1]) !!}
            @else
                {!! trans($plang_admin.'.descriptions.student_counter', ['number' => count($items)]) !!}
            @endif
        </div>

    </div>

    <div class="table-responsive">
    <table class="table table-hover">

        <thead>
            <tr style="height: 50px;">

                <!--COUNTER-->
                <th style='width:{{ $withs['counter'] }}'>
                    {{ trans($plang_admin.'.columns.counter') }}
                </th>

                <!--USER NAME-->
                <?php $name = 'user_name' ?>
                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                    {!! trans($plang_admin.'.columns.user_name') !!}
                </th>

                <!--FIRST NAME-->
                <?php $name = 'first_name' ?>
                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                    {!! trans($plang_admin.'.columns.first_name') !!}
                </th>

                <!--LAST NAME-->
                <?php $name = 'last_name' ?>
                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                    {!! trans($plang_admin.'.columns.last_name') !!}
                </th>

                <!--Email-->
                <?php $name = 'email' ?>
                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                    {!! trans($plang_admin.'.columns.email') !!}
                </th>

                <!-- PHONE -->
                <?php $name = 'updated_at' ?>
                <th class="hidden-xs" style='width:{{ $withs['phone'] }}'>
                    {!! trans($plang_admin.'.columns.phone') !!}
                </th>

                <!--STATUS-->
                <?php $name = 'status' ?>
                <th class="hidden-xs text-center" style='width:{{ $withs['status'] }}'>
                    {!! trans($plang_admin.'.columns.status') !!}

                </th>

                <!--OPERATIONS-->
                <th style='width:{{ $withs['operations'] }}'>
                    <span class='lb-delete-all'>
                        {{ trans($plang_admin.'.columns.teacher_view_student') }}
                    </span>
                </th>
            </tr>

        </thead>

        <tbody>
            <?php $counter =  1;  ?>
            @foreach($items as $item)
                <tr>
                    <!--COUNTER-->
                    <td>
                        <?php echo $counter; $counter++ ?>
                    </td>

                    <!--NAME-->
                    <td>
                        {!! $item['user_name'] !!}
                    </td>

                    <!--FIRST NAME-->
                    <td>
                        {!! $item['first_name'] !!}
                    </td>

                    <!--LAST NAME-->
                    <td>
                        {!! $item['last_name'] !!}
                    </td>

                    <!--Email-->
                    <td>
                        {!! $item['email'] !!}
                    </td>

                    <!--PHONE-->
                    <td> {!! $item['phone'] !!} </td>

                    <!--STATUS-->
                    <td style="text-align: center;">

                        @if(isset($item['company_name']) && (isset($config_status['list'][99])))
                            <i class="fa fa-circle" style="color:{!! $config_status['color'][99] !!}" title='{!! $config_status["list"][99] !!}'></i>
                        @else
                            <i class="fa fa-circle-o red" title='{!! trans($plang_admin.".labels.unknown") !!}'></i>
                        @endif
                    </td>

                    <!--OPERATOR-->
                    <td>


                        <!--View company-->
                        <a href="{!! URL::route('internship.edit_company', [
                                                        'course_id' => $item['course_id'],
                                                        'student_id' => $item['user_id'],
                                                        'teacher_id' => $item['course']['teacher_id'],
                                                        '_token' => csrf_token()
                                                        ])
                                !!}">
                            <i class="fa fa-address-card" aria-hidden="true"></i>
                        </a>

                        <!--View diary-->
                        <a href="{!! URL::route('internship.diary', [
                                                         'course_id' => $item['course_id'],
                                                        'student_id' => $item['user_id'],
                                                        'teacher_id' => $item['course']['teacher_id'],
                                                        '_token' => csrf_token()
                                                        ])
                                !!}">
                            <i class="fa fa-th-list" aria-hidden="true"></i>
                        </a>



                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>
    </div>

@else
    <!--SEARCH RESULT MESSAGE-->
    <span class="text-warning">
        <h5>
            {{ trans($plang_admin.'.descriptions.not-found') }}
        </h5>
    </span>
    <!--/SEARCH RESULT MESSAGE-->
@endif

@section('footer_scripts')
    @parent
    {!! HTML::script('packages/foostart/js/form-table.js')  !!}
@stop
