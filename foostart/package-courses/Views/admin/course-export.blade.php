<?php
$withs = [
    'counter' => '5%',
    'user_name' => '10%',
    'full_name' => '15%',
    'phone' => '10%',
    'class' => '10%',
    'company' => '30%',
    'instructor' => '20%',
];
$plang_admin = 'course-admin';

?>

@if(!empty($items))

        <table>
            <thead>
            <tr>
                <th>Số SV</th>
                <th>Chưa có công ty</th>
                <th>Môn</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{!! count($items) !!}</td>
                    <td>{!! $counterUnCompany !!}</td>
                    <td>{!! $courseName !!}</td>
                </tr>
            </tbody>
        </table>

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

                <!--FULL NAME-->
                <?php $name = 'full_name' ?>
                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                    {!! trans($plang_admin.'.columns.full_name') !!}
                </th>

                <!-- PHONE -->
                <?php $name = 'updated_at' ?>
                <th class="hidden-xs" style='width:{{ $withs['phone'] }}'>
                    {!! trans($plang_admin.'.columns.phone') !!}
                </th>

                <!--CLASS-->
                <?php $name = 'class' ?>
                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                    {!! trans($plang_admin.'.columns.class') !!}
                </th>

                <!--COMPANY-->
                <?php $name = 'company' ?>
                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                    {!! trans($plang_admin.'.columns.company') !!}
                </th>

                <!--INSTRUCTOR-->
                <?php $name = 'instructor' ?>
                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                    {!! trans($plang_admin.'.columns.company') !!}
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

                    <!--USER NAME-->
                    <td>
                        {!! $item['user_name'] !!}
                    </td>

                    <!--FULL NAME-->
                    <td>
                        {!! $item['first_name'] . ' ' . $item['last_name'] !!}
                    </td>

                    <!--PHONE-->
                    <td>
                        {!! @$item['student_phone'] !!}
                    </td>

                    <!--CLASS-->
                    <td>
                        {!! @$item['student_class'] !!}
                    </td>

                    <!--COMPANY-->
                    <td> {!!
                            htmlentities(@$item['company_name']) . "<br><br>" .
                            htmlentities("Địa chỉ: " . @$item['company_address']) . "<br><br>" .
                            htmlentities("Số điện thoại: " . @$item['company_phone'])
                        !!}
                    </td>

                    <!--INSTRUCTOR-->
                    <td> {!!
                            htmlentities(@$item['company_instructor']) . "<br><br>" .
                            htmlentities("Số điện thoại: ". @$item['company_instructor_phone'])

                        !!}
                    </td>

                </tr>
            @endforeach

            </tbody>

        </table>


@else
    <!--SEARCH RESULT MESSAGE-->
    <span class="text-warning">
        <h5>
            {{ trans($plang_admin.'.descriptions.not-found') }}
        </h5>
    </span>
    <!--/SEARCH RESULT MESSAGE-->
@endif
