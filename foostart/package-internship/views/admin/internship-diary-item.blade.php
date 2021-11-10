<?php
$withs = [
    'week' => '7%',
    'start_date' => '10%',
    'end_date' => '10%',
    'updated_at' => '25%',
    'operations' => '15%',
];
?>

@if(!empty($diaries))


    <div class="table-responsive">
    <table class="table table-hover">

        <thead>
            <tr style="height: 50px;">

                <!--COUNTER-->
                <th style='width:{{ $withs['week'] }}'>
                    {{ trans($plang_admin.'.columns.week') }}
                </th>

                <!--START DATE-->
                <?php $name = 'start_date' ?>
                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                    {!! trans($plang_admin.'.columns.start_date') !!}
                </th>
                <!--END DATE-->
                <?php $name = 'end_date' ?>
                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                    {!! trans($plang_admin.'.columns.end_date') !!}
                </th>

                <!--OPERATIONS-->
                <th style='width:{{ $withs['operations'] }}'>
                    <span class='lb-delete-all'>
                        {{ trans($plang_admin.'.columns.diary_operations') }}
                    </span>
                </th>
            </tr>

        </thead>

        <tbody>
        <?php $counter =  1;  ?>
            @foreach($diaries as $item)
                <tr>
                    <!--COUNTER-->
                    <td>
                        <?php echo $counter; $counter++ ?>
                    </td>

                    <!--START DATE-->
                    <td>
                        {!! $item['diary_start_date'] !!}
                    </td>

                    <!--END DATE-->
                    <td>
                        {!! $item['diary_end_date'] !!}
                    </td>


                    <!--OPERATOR-->
                    <td>
                        <!--Edit diary-->
                        @if ($request->get('teacher_id'))
                            <a href="{!! URL::route('internship.diary.edit', [   'course_id' => $course_id,
                                                                            'internship_id' => $internship_id,
                                                                            'internship_diary_id' => $item['internship_diary_id'],
                                                                            'student_id' => $request->get('student_id'),
                                                                            'teacher_id' => $request->get('teacher_id'),
                                                                    '_token' => csrf_token()
                                                                ])
                                !!}">
                                <i class="fa fa-edit f-tb-icon"></i>
                            </a>
                        @else
                            <a href="{!! URL::route('internship.diary.edit', [   'course_id' => $course_id,
                                                                            'internship_id' => $internship_id,
                                                                            'internship_diary_id' => $item['internship_diary_id'],
                                                                    '_token' => csrf_token()
                                                                ])
                                !!}">
                                <i class="fa fa-edit f-tb-icon"></i>
                            </a>
                        @endif


                        <!--Delete diary-->
                        <a href="{!! URL::route('internship.diary.delete', [   'course_id' => $course_id,
                                                                            'internship_id' => $internship_id,
                                                                            'internship_diary_id' => $item['internship_diary_id'],
                                                                    '_token' => csrf_token()
                                                                ])
                                !!}">
                            <i class="fa fa-trash-o f-tb-icon"></i>
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
