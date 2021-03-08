<!------------------------------------------------------------------------------
| List of elements in pattern form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['patterns.post', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

    <!--BUTTONS-->
    <div class='btn-form'>
        <!-- DELETE BUTTON -->
        @if($item)
            <a href="{!! URL::route('patterns.delete',['id' => @$item->id, '_token' => csrf_token()]) !!}"
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
    </ul>
    <!--/TAB MENU-->

    <!--TAB CONTENT-->
    <div class="tab-content">

        <!--MENU 1-->
        <div id="menu_1" class="tab-pane fade in active">

            <!--NAME-->
            @include('package-category::admin.partials.input_text', [
                'name' => 'pattern_name',
                'label' => trans($plang_admin.'.labels.pattern_name'),
                'value' => @$item->pattern_name,
                'description' => trans($plang_admin.'.descriptions.pattern_name'),
                'errors' => $errors,
            ])
            <!--/NAME-->

            <div class="row">
                <div class='col-md-6'>
                    <!--URL-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'pattern_url',
                        'label' => trans($plang_admin.'.labels.pattern_url'),
                        'value' => @$item->pattern_name,
                        'description' => trans($plang_admin.'.descriptions.pattern_url'),
                        'errors' => $errors,
                    ])
                    <!-- /URL-->
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

                <div class='col-md-6'>
                    <!--IMAGE-->
                    @include('package-category::admin.partials.input_image', [
                        'name' => 'pattern_image',
                        'label' => trans($plang_admin.'.labels.pattern_image'),
                        'value' => @$item->pattern_image,
                        'description' => trans($plang_admin.'.descriptions.pattern_image'),
                        'errors' => $errors,
                        'lfm_config' => TRUE
                    ])
                    <!-- /IMAGE-->
                </div>
            </div>

             <!--DESCRIPTION-->
            @include('package-category::admin.partials.textarea', [
                'name' => 'pattern_description',
                'label' => trans($plang_admin.'.labels.pattern_description'),
                'value' => @$item->pattern_description,
                'description' => trans($plang_admin.'.descriptions.pattern_description'),
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
| End list of elements in pattern form
|------------------------------------------------------------------------------>
