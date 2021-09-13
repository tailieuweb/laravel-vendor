<!------------------------------------------------------------------------------
| List of elements in job form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['crawler.work.job.post', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

    <!--BUTTON FORM -->
    @include('package-category::admin.partials.btn-form-edit', [
        'item' => @$item,
        'routeRestore' => 'crawler.work.job.restore',
        'routeDelete' => 'crawler.work.job.delete',
    ])
    <!--/BUTTON FORM-->

    <!--TAB MENU-->
    <ul class="nav nav-tabs">
        <!--MENU #1-->
        <li class="active">
            <a data-toggle="tab" href="#menu_1">
                {!! trans($plang_admin.'.tabs.basic') !!}
            </a>
        </li>
        <!--MENU #2-->
        <li>
            <a data-toggle="tab" href="#menu_2">
                {!! trans($plang_admin.'.tabs.advance') !!}
            </a>
        </li>
        <!--MENU #3-->
        <li>
            <a data-toggle="tab" href="#menu_3">
                {!! trans($plang_admin.'.tabs.other') !!}
            </a>
        </li>
    </ul>
    <!--/TAB MENU-->

    <!--TAB CONTENT-->
    <div class="tab-content">

        <!--MENU #1-->
        <div id="menu_1" class="tab-pane fade in active">
            <div class="row">
                <div class="col-md-12">
                    <!--NAME-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'job_name',
                        'label' => trans($plang_admin.'.labels.job_name'),
                        'value' => @$item->job_name,
                        'description' => trans($plang_admin.'.descriptions.job_name'),
                        'errors' => $errors,
                    ])
                    <!--/NAME-->
                </div>
                <div class="col-md-12">
                    <!--URL-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'job_url',
                        'label' => trans($plang_admin.'.labels.job_url'),
                        'value' => @$item->job_url,
                        'description' => trans($plang_admin.'.descriptions.job_url'),
                        'errors' => $errors,
                    ])
                    <!--/URL-->
                </div>

                <div class='col-md-6'>
                    <!--SITE-->
                    @include('package-category::admin.partials.select_single', [
                        'name' => 'site_id',
                        'label' => trans($plang_admin.'.form.site_id'),
                        'value' => @$item->site_id,
                        'items' => $sites,
                        'description' => trans($plang_admin.'.descriptions.site_id'),
                    ])
                <!--/SITE-->
                </div>
                <div class='col-md-6'>
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

            <!--DESCRIPTION-->
            @include('package-category::admin.partials.textarea', [
                'name' => 'job_description',
                'label' => trans($plang_admin.'.labels.job_description'),
                'value' => @$item->job_description,
                'description' => trans($plang_admin.'.descriptions.job_description'),
                'rows' => 15,
                'tinymce' => true,
                'errors' => $errors,
            ])
            <!--/DESCRIPTION-->
            <!--REQUIREMENTS-->
            @include('package-category::admin.partials.textarea', [
                'name' => 'job_requirements',
                'label' => trans($plang_admin.'.labels.job_requirements'),
                'value' => @$item->job_description,
                'description' => trans($plang_admin.'.descriptions.job_requirements'),
                'rows' => 15,
                'tinymce' => true,
                'errors' => $errors,
            ])
            <!--/REQUIREMENTS-->
        </div>
        <!--/MENU #1-->

        <!--MENU #2-->
        <div id="menu_2" class="tab-pane fade">
            <!--JOB OVERVIEW-->
            @include('package-category::admin.partials.textarea', [
            'name' => 'job_overview',
            'label' => trans($plang_admin.'.labels.job_overview'),
            'value' => @$item->job_overview,
            'description' => trans($plang_admin.'.descriptions.job_overview'),
            'tinymce' => false,
            'errors' => $errors,
            ])
            <!--/JOB OVERVIEW-->
        </div>
        <!--/MENU #2-->

        <!--MENU #3-->
        <div id="menu_3" class="tab-pane fade">
            <!--JOB IMAGE-->
            @include('package-category::admin.partials.input_image', [
                'name' => 'job_image',
                'label' => trans($plang_admin.'.labels.image'),
                'value' => @$item->job_image,
                'description' => trans($plang_admin.'.descriptions.job_image'),
                'errors' => $errors,
                'lfm_config' => TRUE
            ])
            <!--/JOB IMAGE-->
        </div>
        <!--/MENU #3-->

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
| End list of elements in job form
|------------------------------------------------------------------------------>
