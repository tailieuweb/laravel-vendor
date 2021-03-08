<!------------------------------------------------------------------------------
| List of elements in module form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['modules.sample', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

    <!--BUTTONS-->
    <div class='btn-form'>
    

        <!-- SAVE BUTTON -->
        {!! Form::submit(trans($plang_admin.'.buttons.sent'), array("class"=>"btn btn-info pull-right ")) !!}
        <!-- /SAVE BUTTON -->
    </div>
    <!--/BUTTONS-->


    <!--TAB CONTENT-->
    <div class="tab-content">

        <!--MENU 1-->
        <div id="menu_1" class="tab-pane fade in active">

            <!--module title-->
            @include('package-module::admin.partials.input_text', [
            'name' => 'module_title',
            'label' => trans($plang_admin.'.labels.title'),
            'value' => @$item->module_title,
            'description' => trans($plang_admin.'.descriptions.title'),
            'errors' => $errors,
            ])
            <!--/module title-->

            <!--module email-->
            @include('package-module::admin.partials.textarea', [
            'name' => 'module_email',
            'label' => trans($plang_admin.'.labels.email'),
            'value' => @$item->module_email,
            'description' => trans($plang_admin.'.descriptions.email'),
            'tinymce' => false,
            'errors' => $errors,
            ])
            <!--/module email-->

            <!--module phone-->
            @include('package-module::admin.partials.input_text', [
            'name' => 'module_phone',
            'label' => trans($plang_admin.'.labels.phone'),
            'value' => @$item->module_phone,
            'description' => trans($plang_admin.'.descriptions.phone'),
            'errors' => $errors,
            ])
            <!--/module title-->

            <!--module message-->
            @include('package-module::admin.partials.textarea', [
            'name' => 'module_message',
            'label' => trans($plang_admin.'.labels.message'),
            'value' => @$item->module_message,
            'description' => trans($plang_admin.'.descriptions.message'),
            'rows' => 50,
            'tinymce' => true,
            'errors' => $errors,
            ])
            <!--/module message-->

            

        

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