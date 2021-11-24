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
