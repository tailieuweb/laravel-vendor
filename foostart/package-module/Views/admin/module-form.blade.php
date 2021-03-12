<!------------------------------------------------------------------------------
| List of elements in module form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['modules.post', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

    <!--BUTTONS-->
    <div class='btn-form'>
        <!-- DELETE BUTTON -->
        @if($item)
            <a href="{!! URL::route('modules.delete',['id' => @$item->id, '_token' => csrf_token()]) !!}"
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
                {!! trans($plang_admin.'.tabs.menu-1') !!}
            </a>
        </li>

        <!--MENU 2-->
        <li>
            <a data-toggle="tab" href="#menu_2">
                {!! trans($plang_admin.'.tabs.menu-2') !!}
            </a>
        </li>

        <!--MENU 3-->
        <li>
            <a data-toggle="tab" href="#menu_3">
                {!! trans($plang_admin.'.tabs.menu-3') !!}
            </a>
        </li>

        <!--MENU 4-->
        <li>
            <a data-toggle="tab" href="#menu_4">
                {!! trans($plang_admin.'.tabs.menu-4') !!}
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
                'name' => 'module_name',
                'label' => trans($plang_admin.'.labels.module_name'),
                'value' => @$item->module_name,
                'description' => trans($plang_admin.'.descriptions.module_name'),
                'errors' => $errors,
            ])


            <div class="row">
                <div class='col-md-6'>
                    <!--MODULE SLUG-->
                        @include('package-category::admin.partials.input_slug', [
                            'name' => 'module_slug',
                            'id' => 'module_slug',
                            'ref' => 'module_name',
                            'label' => trans($plang_admin.'.labels.module_slug'),
                            'value' => @$item->module_slug,
                            'description' => trans($plang_admin.'.descriptions.module_slug'),
                            'errors' => $errors,
                        ])
                    <!--/MODULE SLUG-->
                </div>
                
                <div class="col-md-6">
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
                'name' => 'module_description',
                'label' => trans($plang_admin.'.labels.module_description'),
                'value' => @$item->module_description,
                'description' => trans($plang_admin.'.descriptions.module_description'),
                'rows' => 25,
                'tinymce' => true,
                'errors' => $errors,
            ])
            <!--/DESCRIPTION-->
        </div>

        <!--MENU 2-->
        <div id="menu_2" class="tab-pane fade">
            <!--MODULE HTML-->
            @include('package-category::admin.partials.textarea', [
            'name' => 'module_html',
            'label' => trans($plang_admin.'.labels.module_html'),
            'value' => @$item->module_html,
            'description' => trans($plang_admin.'.descriptions.module_html'),
            'tinymce' => false,
            'rows' => 30,
            'errors' => $errors,
            ])
            <!--/MODULE OVERVIEW-->
        </div>

        <!--MENU 3-->
        <div id="menu_3" class="tab-pane fade">
            <!--MODULE CSS-->
            @include('package-category::admin.partials.textarea', [
            'name' => 'module_css',
            'label' => trans($plang_admin.'.labels.module_css'),
            'value' => @$item->module_css,
            'description' => trans($plang_admin.'.descriptions.module_css'),
            'tinymce' => false,
            'rows' => 30,
            'errors' => $errors,
            ])
            <!--/MODULE CSS-->
        </div>

        <!--MENU 4-->
        <div id="menu_4" class="tab-pane fade">
            <!--MODULE JavaScript-->
            @include('package-category::admin.partials.textarea', [
            'name' => 'module_javascript',
            'label' => trans($plang_admin.'.labels.module_javascript'),
            'value' => @$item->module_javascript,
            'description' => trans($plang_admin.'.descriptions.module_javascript'),
            'tinymce' => false,
            'rows' => 20,
            'errors' => $errors,
            ])
            <!--/MODULE JavaScript-->
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
| End list of elements in module form
|------------------------------------------------------------------------------>