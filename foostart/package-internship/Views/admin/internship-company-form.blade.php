<!------------------------------------------------------------------------------
| List of elements in company form
|------------------------------------------------------------------------------->
@if (!empty($student_id) && !empty($teacher_id))
{!! Form::open(['route'=>['internship.post_company', 'course_id' => $course_id,
                                                    'student_id' => $student_id,
                                                    'teacher_id' => $teacher_id,
                            ],  'files'=>true, 'method' => 'post'])  !!}
@else
    {!! Form::open(['route'=>['internship.post_company', 'course_id' => $course_id],  'files'=>true, 'method' => 'post'])  !!}
@endif

    <!--BUTTONS-->
    <div class='btn-form'>
        <!-- SAVE BUTTON -->
            {!! Form::submit(trans($plang_admin.'.buttons.save'), array("class"=>"btn btn-info pull-right ")) !!}
        <!-- /SAVE BUTTON -->
    </div>
    <!--/BUTTONS-->

    <!--TAB MENU-->
    <ul class="nav nav-tabs">
        <!--MENU 1-->
        <li class="active">
            <a data-toggle="tab" href="#menu_1_company_require">
                {!! trans($plang_admin.'.tabs.menu_1_company_require') !!}
            </a>
        </li>
        <!--OTHER-->
        <li>
            <a data-toggle="tab" href="#menu_2_company_other">
                {!! trans($plang_admin.'.tabs.menu_2_company_other') !!}
            </a>
        </li>
    </ul>
    <!--/TAB MENU-->

    <!--TAB CONTENT-->
    <div class="tab-content">

        <!--MENU 1-->
        <div id="menu_1_company_require" class="tab-pane fade in active">


            <div class="row">
                <div class="col-md-6">
                    <!--STUDENT CLASS-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'student_class',
                        'label' => trans($plang_admin.'.labels.student_class'),
                        'value' => @$item->student_class,
                        'description' => trans($plang_admin.'.descriptions.student_class'),
                        'errors' => $errors,
                    ])
                    <!--/NAME-->
                </div>
                <div class="col-md-6">
                    <!--STUDENT PHONE-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'student_phone',
                        'label' => trans($plang_admin.'.labels.student_phone'),
                        'value' => @$item->student_phone,
                        'description' => trans($plang_admin.'.descriptions.student_phone'),
                        'errors' => $errors,
                    ])
                    <!--/NAME-->
                </div>
            </div>


            <!--NAME-->
            @include('package-category::admin.partials.input_text', [
                'name' => 'company_name',
                'label' => trans($plang_admin.'.labels.internship_company_name'),
                'value' => @$item->company_name,
                'description' => trans($plang_admin.'.descriptions.internship_company_name'),
                'errors' => $errors,
            ])
            <!--/NAME-->

            <!--SITE SLUG-->
            @include('package-category::admin.partials.input_slug', [
                'name' => 'company_slug',
                'id' => 'company_slug',
                'ref' => 'company_name',
                'label' => trans($plang_admin.'.labels.slug'),
                'value' => @$item->company_slug,
                'description' => trans($plang_admin.'.descriptions.slug'),
                'errors' => $errors,
                'hidden' => true,
            ])
            <!--/SITE SLUG-->

            <!--SITE SLUG-->
                @include('package-category::admin.partials.input_slug', [
                    'name' => 'course_id',
                    'id' => 'course_id',
                    'value' => @$item->course_id,
                    'hidden' => true,
                ])
                <!--/SITE SLUG-->

            <!--ADDRESS-->
            @include('package-category::admin.partials.input_text', [
                'name' => 'company_address',
                'label' => trans($plang_admin.'.labels.internship_company_address'),
                'value' => @$item->company_address,
                'description' => trans($plang_admin.'.descriptions.internship_company_address'),
                'errors' => $errors,
            ])
            <!-- /ADDRESS-->

            <div class="row">
                <div class='col-md-6'>
                    <!--CATEGORY ID-->
                    @include('package-category::admin.partials.select_single', [
                        'name' => 'category_id',
                        'label' => trans($plang_admin.'.labels.internship_category_id'),
                        'value' => @$item->category_id,
                        'items' => $categories,
                        'description' => trans($plang_admin.'.descriptions.internship_category_id'),
                    ])
                    <!--/CATEGORY ID-->
                </div>

                <div class="col-md-6">
                    <!--COMPANY PHONE-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'company_phone',
                        'label' => trans($plang_admin.'.labels.internship_company_phone'),
                        'value' => @$item->company_phone,
                        'description' => trans($plang_admin.'.descriptions.internship_company_phone'),
                        'errors' => $errors,
                    ])
                    <!-- /COMPANY PHONE-->
                </div>
            </div>

            <div class="row">
                <div class='col-md-6'>
                    <!--COMPANY INSTRUCTOR-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'company_instructor',
                        'label' => trans($plang_admin.'.labels.internship_company_instructor'),
                        'value' => @$item->company_instructor,
                        'description' => trans($plang_admin.'.descriptions.internship_company_instructor'),
                        'errors' => $errors,
                    ])
                    <!-- /COMPANY INSTRUCTOR-->
                </div>

                <div class='col-md-6'>
                    <!--COMPANY INSTRUCTOR PHONE-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'company_instructor_phone',
                        'label' => trans($plang_admin.'.labels.internship_company_instructor_phone'),
                        'value' => @$item->company_instructor_phone,
                        'description' => trans($plang_admin.'.descriptions.internship_company_instructor_phone'),
                        'errors' => $errors,
                    ])
                    <!-- /COMPANY INSTRUCTOR-->
                </div>
            </div>



        </div>
        <!--/END MENU1-->
        <!--OTHER-->
        <div id="menu_2_company_other" class="tab-pane fade">

            <div class="row">
                <div class='col-md-6'>
                    <!--WEBSITE-->
                @include('package-category::admin.partials.input_text', [
                    'name' => 'company_website',
                    'label' => trans($plang_admin.'.labels.internship_company_website'),
                    'value' => @$item->company_website,
                    'description' => trans($plang_admin.'.descriptions.internship_company_website'),
                    'errors' => $errors,
                ])
                <!-- /WEBSITE-->
                </div>

                <div class="col-md-6">
                    <!--COMPANY TAX CODE-->
                @include('package-category::admin.partials.input_text', [
                    'name' => 'company_tax_code',
                    'label' => trans($plang_admin.'.labels.internship_company_tax_code'),
                    'value' => @$item->company_tax_code,
                    'description' => trans($plang_admin.'.descriptions.internship_company_tax_code'),
                    'errors' => $errors,
                ])
                <!-- /COMPANY TAX CODE-->
                </div>
            </div>
            <!--DESCRIPTION-->
            @include('package-category::admin.partials.textarea', [
                'name' => 'company_description',
                'label' => trans($plang_admin.'.labels.internship_company_description'),
                'value' => @$item->company_description,
                'description' => trans($plang_admin.'.descriptions.internship_company_description'),
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
| End list of elements in company form
|------------------------------------------------------------------------------>
