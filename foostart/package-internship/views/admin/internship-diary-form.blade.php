<!------------------------------------------------------------------------------
| List of elements in company form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['internship.diary.post',
                            'course_id' => $course_id,
                            'internship_id' => $internship_id,
                            'internship_diary_id' => $internship_diary_id,
                            ],  'files'=>true, 'method' => 'post'])  !!}

    <!--BUTTONS-->
    <div class='btn-form'>
        <!-- SAVE BUTTON -->
            {!! Form::submit(trans($plang_admin.'.buttons.save'), array("class"=>"btn btn-info pull-right ")) !!}
        <!-- /SAVE BUTTON -->
    </div>
    <!--/BUTTONS-->

    <!--TAB MENU-->
    <ul class="nav nav-tabs">
        <!--Date-->
        <li class="active">
            <a data-toggle="tab" href="#menu_1_date">
                {!! trans($plang_admin.'.tabs.menu_1_date') !!}
            </a>
        </li>
        <!--Mon-->
        <li>
            <a data-toggle="tab" href="#menu_2_mon">
                {!! trans($plang_admin.'.tabs.menu_2_mon') !!}
            </a>
        </li>
        <!--Tue-->
        <li>
            <a data-toggle="tab" href="#menu_3_tue">
                {!! trans($plang_admin.'.tabs.menu_3_tue') !!}
            </a>
        </li>
        <!--Wed-->
        <li>
            <a data-toggle="tab" href="#menu_4_wed">
                {!! trans($plang_admin.'.tabs.menu_4_wed') !!}
            </a>
        </li>
        <!--Thu-->
        <li>
            <a data-toggle="tab" href="#menu_5_thu">
                {!! trans($plang_admin.'.tabs.menu_5_thu') !!}
            </a>
        </li>
        <!--Fri-->
        <li>
            <a data-toggle="tab" href="#menu_6_fri">
                {!! trans($plang_admin.'.tabs.menu_6_fri') !!}
            </a>
        </li>
        <!--Sat-->
        <li>
            <a data-toggle="tab" href="#menu_7_sat">
                {!! trans($plang_admin.'.tabs.menu_7_sat') !!}
            </a>
        </li>
    </ul>
    <!--/TAB MENU-->

    <!--TAB CONTENT-->
    <div class="tab-content">

        <!--DATE-->
        <div id="menu_1_date" class="tab-pane fade in active">
            <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <!--START DATE-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'diary_start_date',
                        'label' => trans($plang_admin.'.labels.diary_start_date'),
                        'value' => @$diary->diary_start_date,
                        'description' => trans($plang_admin.'.descriptions.diary_start_date'),
                        'errors' => $errors,
                    ])
                    <!--/START DATE-->
                </div>
                <div class="col-md-6">
                    <!--END DATE-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'diary_end_date',
                        'label' => trans($plang_admin.'.labels.diary_end_date'),
                        'value' => @$diary->diary_end_date,
                        'description' => trans($plang_admin.'.descriptions.diary_end_date'),
                        'errors' => $errors,
                    ])
                    <!--/END DATE-->`
                </div>
            </div>
            </div>
        </div>
        <!--/END DATE-->

        <!--MON-->
        <div id="menu_2_mon" class="tab-pane fade">
            @include('package-category::admin.partials.textarea', [
            'name' => 'diary_mon',
            'label' => trans($plang_admin.'.labels.diary_mon'),
            'value' => @$diary->diary_mon,
            'description' => trans($plang_admin.'.descriptions.diary_mon'),
            'tinymce' => false,
            'errors' => $errors,
            'rows' => 20,
            ])
        </div>

        <!--TUE-->
        <div id="menu_3_tue" class="tab-pane fade">
            @include('package-category::admin.partials.textarea', [
            'name' => 'diary_tue',
            'label' => trans($plang_admin.'.labels.diary_tue'),
            'value' => @$diary->diary_tue,
            'description' => trans($plang_admin.'.descriptions.diary_tue'),
            'tinymce' => false,
            'errors' => $errors,
            'rows' => 20,
            ])
        </div>

        <!--WED-->
        <div id="menu_4_wed" class="tab-pane fade">
            @include('package-category::admin.partials.textarea', [
            'name' => 'diary_wed',
            'label' => trans($plang_admin.'.labels.diary_wed'),
            'value' => @$diary->diary_wed,
            'description' => trans($plang_admin.'.descriptions.diary_wed'),
            'tinymce' => false,
            'errors' => $errors,
            'rows' => 20,
            ])

        </div>

        <!--THU-->
        <div id="menu_5_thu" class="tab-pane fade">
            @include('package-category::admin.partials.textarea', [
            'name' => 'diary_thu',
            'label' => trans($plang_admin.'.labels.diary_thu'),
            'value' => @$diary->diary_thu,
            'description' => trans($plang_admin.'.descriptions.diary_thu'),
            'tinymce' => false,
            'errors' => $errors,
            'rows' => 20,
            ])
        </div>

        <!--FRI-->
        <div id="menu_6_fri" class="tab-pane fade">
            @include('package-category::admin.partials.textarea', [
            'name' => 'diary_fri',
            'label' => trans($plang_admin.'.labels.diary_fri'),
            'value' => @$diary->diary_fri,
            'description' => trans($plang_admin.'.descriptions.diary_fri'),
            'tinymce' => false,
            'errors' => $errors,
            'rows' => 20,
            ])
        </div>

        <!--SAT-->
        <div id="menu_7_sat" class="tab-pane fade">
            @include('package-category::admin.partials.textarea', [
            'name' => 'diary_sat',
            'label' => trans($plang_admin.'.labels.diary_sat'),
            'value' => @$diary->diary_sat,
            'description' => trans($plang_admin.'.descriptions.diary_sat'),
            'tinymce' => false,
            'errors' => $errors,
            'rows' => 20,
            ])
        </div>

    </div>
    <!--/TAB CONTENT-->

    <!--HIDDEN FIELDS-->
    <div class='hidden-field'>
        {!! Form::hidden('id',@$item->id) !!}
        {!! Form::hidden('course_id', $course_id) !!}
        {!! Form::hidden('internship_id', $internship_id) !!}
        {!! Form::hidden('context',$request->get('context',null)) !!}
    </div>
    <!--/HIDDEN FIELDS-->

{!! Form::close() !!}
<!------------------------------------------------------------------------------
| End list of elements in company form
|------------------------------------------------------------------------------>
