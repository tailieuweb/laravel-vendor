<?php
$withs = [
    'counter' => '7%',
    'id' => '8%',
    'course_name' => '35%',
    'status' => '10%',
    'updated_at' => '25%',
    'operations' => '15%',
];
?>

@if(!empty($classes))
    <div style="min-height: 50px;">
        <div>
            @if(count($classes) == 1)
                {!! trans($plang_admin.'.descriptions.counter', ['number' => 1]) !!}
            @else
                {!! trans($plang_admin.'.descriptions.counters', ['number' => count($classes)]) !!}
            @endif
        </div>

        {!! Form::submit(trans($plang_admin.'.buttons.delete-in-trash'), array(
                                                                            "class"=>"btn btn-warning delete btn-delete-all",
                                                                            "title"=> trans($plang_admin.'.hint.delete-in-trash'),
                                                                            'name'=>'del-trash'))
        !!}
        {!! Form::submit(trans($plang_admin.'.buttons.delete-forever'), array(
                                                                            "class"=>"btn btn-danger delete btn-delete-all",
                                                                            "title"=> trans($plang_admin.'.hint.delete-forever'),
                                                                            'name'=>'del-forever'))
        !!}
    </div>

    <div class="table-responsive">
    <table class="table table-hover">

        <thead>
            <tr style="height: 50px;">

                <!--COUNTER-->
                <th style='width:{{ $withs['counter'] }}'>
                    {{ trans($plang_admin.'.columns.counter') }}
                </th>

                <!--NAME-->
                <?php $name = 'course_name' ?>
                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                    {!! trans($plang_admin.'.columns.course_name') !!}
                </th>

                <!--OPERATIONS-->
                <th style='width:{{ $withs['operations'] }}'>
                    <span class='lb-delete-all'>
                        {{ trans($plang_admin.'.columns.operations') }}
                    </span>
                </th>
            </tr>

        </thead>

        <tbody>
            <?php $counter =  1;  ?>
            @foreach($classes as $item)
                <tr>
                    <!--COUNTER-->
                    <td>
                        <?php echo $counter; $counter++ ?>
                    </td>

                    <!--NAME-->
                    <td>
                        {!! $item['course']['course_name'] !!}
                    </td>


                    <!--OPERATOR-->
                    <td>
                        <!--Edit company-->
                        <a href="{!! URL::route('internship.edit_company', [   'course_id' => $item['course_id'],
                                                                    '_token' => csrf_token()
                                                                ])
                                !!}">
                            <i class="fa fa-edit f-tb-icon"></i>
                        </a>

                        <!--Diary-->
                        <a href="{!! URL::route('internship.diary', ['course_id' => $item['course_id'],
                                                                    '_token' => csrf_token()
                                                                ])
                                !!}">
                            <i class="fa fa-stack-exchange" aria-hidden="true"></i>
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
