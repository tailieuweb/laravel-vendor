<!------------------------------------------------------------------------------
| List of elements in course form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['course.post', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

    <!--BUTTONS-->
    <div class='btn-form'>
        @if(isset($item) && $item->deleted_at)
            <a href="{!! URL::route('course.restore',['id' => $item->id, '_token' => csrf_token()]) !!}"
               class="btn btn-success pull-right margin-left-5 restore">
                {!! trans($plang_admin.'.buttons.restore') !!}
            </a>
        @elseif (isset($item))
            <a href="{!! URL::route('course.delete',['id' => @$item->id, '_token' => csrf_token()]) !!}"
               class="btn btn-warning pull-right margin-left-5 delete">
                {!! trans($plang_admin.'.buttons.delete') !!}
            </a>
        @endif
        <!-- SAVE BUTTON -->
            {!! Form::submit(trans($plang_admin.'.buttons.save'), array("class"=>"btn btn-info pull-right ")) !!}
        <!-- /SAVE BUTTON -->
    </div>
    <!--/BUTTONS-->

    <!--TAB MENU-->
    <ul class="nav nav-tabs">
        <!--MENU 1-->
        <li class="active">
            <a data-toggle="tab" href="#menu_1">
                {!! trans($plang_admin.'.tabs.menu-1') !!}
            </a>
        </li>
        <!--OTHER-->
        <li>
            <a data-toggle="tab" href="#menu_3">
                {!! trans($plang_admin.'.tabs.other') !!}
            </a>
        </li>
    </ul>
    <!--/TAB MENU-->

    <!--TAB CONTENT-->
    <div class="tab-content">

        <!--MENU 1-->
        <div id="menu_1" class="tab-pane fade in active">

            <!--NAME-->
            @include('package-category::admin.partials.input_text', [
                'name' => 'course_name',
                'label' => trans($plang_admin.'.labels.course_name'),
                'value' => @$item->course_name,
                'description' => trans($plang_admin.'.descriptions.course_name'),
                'errors' => $errors,
            ])
            <!--/NAME-->

            <!--SLUG-->
            @include('package-category::admin.partials.input_slug', [
                'name' => 'course_slug',
                'id' => 'course_slug',
                'ref' => 'course_name',
                'label' => trans($plang_admin.'.labels.slug'),
                'value' => @$item->course_slug,
                'description' => trans($plang_admin.'.descriptions.slug'),
                'errors' => $errors,
            ])
            <!--/SLUG-->

            <!--TEACHER ID-->
            @include('package-category::admin.partials.select_single', [
                'name' => 'teacher_id',
                'label' => trans($plang_admin.'.form.teacher_id'),
                'value' => @$item->teacher_id,
                'items' => $teachers,
                'description' => trans($plang_admin.'.descriptions.teacher_id'),
            ])
            <!--/TEACHER ID-->


            <div class="row">
                <div class='col-md-3'>
                    <!--START DATE-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'course_start_date',
                        'label' => trans($plang_admin.'.labels.course_start_date'),
                        'value' => @$item->course_start_date,
                        'description' => trans($plang_admin.'.descriptions.course_start_date'),
                        'errors' => $errors,
                    ])
                    <!-- /START DATE-->
                </div>
                <div class='col-md-3'>
                    <!--END DATE-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'course_end_date',
                        'label' => trans($plang_admin.'.labels.course_end_date'),
                        'value' => @$item->course_end_date,
                        'description' => trans($plang_admin.'.descriptions.course_end_date'),
                        'errors' => $errors,
                    ])
                    <!-- /END DATE-->
                </div>
                <div class='col-md-3'>
                    <!--CATEGORY ID-->
                    @include('package-category::admin.partials.select_single', [
                        'name' => 'category_id',
                        'label' => trans($plang_admin.'.form.category_id'),
                        'value' => @$item->category_id,
                        'items' => $categories,
                        'description' => trans($plang_admin.'.descriptions.category_id'),
                    ])
                    <!--/CATEGORY ID-->
                </div>

                <div class="col-md-3">
                    <!--STATUS-->
                    @include('package-category::admin.partials.select_single', [
                        'name' => 'status',
                        'label' => trans($plang_admin.'.form.status'),
                        'value' => @$item->status,
                        'items' => $status,
                        'description' => trans($plang_admin.'.descriptions.status'),
                    ])
                    <!--/STATUS-->
                </div>
            </div>

        </div>
        <!--/END MENU1-->
        <!--OTHER-->
        <div id="menu_3" class="tab-pane fade">
            <!--SITE IMAGE-->
            @include('package-category::admin.partials.input_image', [
                'name' => 'course_image',
                'label' => trans($plang_admin.'.labels.course_image'),
                'value' => @$item->course_image,
                'description' => trans($plang_admin.'.descriptions.course_image'),
                'errors' => $errors,
                'lfm_config' => TRUE
            ])
            <!--/SITE IMAGE-->
            <!--DESCRIPTION-->
            @include('package-category::admin.partials.textarea', [
                'name' => 'course_description',
                'label' => trans($plang_admin.'.labels.course_description'),
                'value' => @$item->course_description,
                'description' => trans($plang_admin.'.descriptions.course_description'),
                'rows' => 25,
                'tinymce' => true,
                'errors' => $errors,
            ])
            <!--/DESCRIPTION-->
        </div>

    </div>
    <!--/TAB CONTENT-->

    <!--HIDDEN FIELDS-->
    <div class='hidden-field'>
        {!! Form::hidden('id',@$item->id) !!}
        {!! Form::hidden('context',$request->get('context',null)) !!}
    </div>
    <!--/HIDDEN FIELDS-->

{!! Form::close() !!}
<!------------------------------------------------------------------------------
| End list of elements in course form
|------------------------------------------------------------------------------>
