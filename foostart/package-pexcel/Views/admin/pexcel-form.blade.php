<!------------------------------------------------------------------------------
| List of elements in pexcel form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['pexcel.post', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

    <!--BUTTONS-->
    <div class='btn-form'>
        <!-- DELETE BUTTON -->
        @if($item)
            <a href="{!! URL::route('pexcel.delete',['id' => @$item->id, '_token' => csrf_token()]) !!}"
            class="btn btn-danger pull-right margin-left-5 delete">
                {!! trans($plang_admin.'.buttons.delete') !!}
            </a>
        @endif
        <!-- DELETE BUTTON -->

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
                {!! trans($plang_admin.'.tabs.menu_1') !!}
            </a>
        </li>

        <!--MENU 2-->
        <li>
            <a data-toggle="tab" href="#menu_2">
                {!! trans($plang_admin.'.tabs.menu_2') !!}
            </a>
        </li>

        <!--MENU 3-->
        <li>
            <a data-toggle="tab" href="#menu_3">
                {!! trans($plang_admin.'.tabs.menu_3') !!}
            </a>
        </li>
    </ul>
    <!--/TAB MENU-->

    <!--TAB CONTENT-->
    <div class="tab-content">

        <!--MENU 1-->
        <div id="menu_1" class="tab-pane fade in active">

            <!--PEXCEL NAME-->
            @include('package-category::admin.partials.input_text', [
                'name' => 'pexcel_name',
                'label' => trans($plang_admin.'.labels.name'),
                'value' => @$item->pexcel_name,
                'description' => trans($plang_admin.'.descriptions.name'),
                'errors' => $errors,
            ])
            <!--/PEXCEL NAME-->

            <div class="row">
                <div class='col-md-6'>
                    <!-- LIST OF CATEGORIES -->
                    @include('package-category::admin.partials.select_single', [
                        'name' => 'category_id',
                        'label' => trans($plang_admin.'.labels.category'),
                        'items' => $categories,
                        'value' => @$item->category_id,
                        'description' => trans($plang_admin.'.descriptions.category', [
                                            'href' => URL::route('categories.list', ['_key' => $context->context_key])
                                            ]),
                        'errors' => $errors,
                    ])
                    <!-- /LIST OF CATEGORIES -->
                </div>

                <div class='col-md-6'>
                    <!--STATUS-->
                    @include('package-category::admin.partials.radio', [
                        'name' => 'pexcel_status',
                        'label' => trans($plang_admin.'.labels.pexcel-status'),
                        'value' => @$item->pexcel_status,
                        'description' => trans($plang_admin.'.descriptions.pexcel-status'),
                        'items' => $statuses,
                    ])
                    <!--/STATUS-->
                </div>
            </div>
             <!--PEXCEL FILES-->
            @include('package-category::admin.partials.input_files', [
                'name' => 'files',
                'label' => trans($plang_admin.'.labels.files'),
                'value' => @$item->pexcel_files,
                'description' => trans($plang_admin.'.descriptions.files'),
                'errors' => $errors,
            ])
            <!--/PEXCEL FILES-->
        </div>

        <!--MENU 2-->
        <div id="menu_2" class="tab-pane fade">
            <div class="row">
            <!--PEXCEL OVERVIEW-->
            @include('package-category::admin.partials.textarea', [
                'name' => 'pexcel_overview',
                'label' => trans($plang_admin.'.labels.overview'),
                'value' => @$item->pexcel_overview,
                'description' => trans($plang_admin.'.descriptions.overview'),
                'tinymce' => false,
                'errors' => $errors,
            ])
            <!--/PEXCEL OVERVIEW-->

            <!--PEXCEL DESCRIPTION-->
            @include('package-category::admin.partials.textarea', [
                'name' => 'pexcel_description',
                'label' => trans($plang_admin.'.labels.description'),
                'value' => @$item->pexcel_description,
                'description' => trans($plang_admin.'.descriptions.description'),
                'rows' => 50,
                'tinymce' => true,
                'errors' => $errors,
            ])
            <!--/PEXCEL DESCRIPTION-->
            </div>
        </div>

        <!--MENU 3-->
        <div id="menu_3" class="tab-pane fade">
            <div class="row">
            <!--PEXCEL IMAGE-->
            @include('package-category::admin.partials.input_image', [
                'name' => 'pexcel_image',
                'label' => trans($plang_admin.'.labels.image'),
                'value' => @$item->pexcel_image,
                'description' => trans($plang_admin.'.descriptions.image'),
                'errors' => $errors,
                'lfm_config' => false,
            ])
            <!--/PEXCEL IMAGE-->
            </div>
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
| End list of elements in pexcel form
|------------------------------------------------------------------------------>
