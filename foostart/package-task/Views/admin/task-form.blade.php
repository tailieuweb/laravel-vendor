<!------------------------------------------------------------------------------
| List of elements in task form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['task.post', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

<!--BUTTONS-->
<div class='btn-form'>
    <!-- DELETE BUTTON -->
    @if($item)
    <a href="{!! URL::route('task.delete',['id' => @$item->id, '_token' => csrf_token()]) !!}"
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

    <!--MENU 4-->
    <li>
        <a data-toggle="tab" href="#menu_10">
            {!! trans($plang_admin.'.tabs.menu_10') !!}
        </a>
    </li>
</ul>
<!--/TAB MENU-->

<!--TAB CONTENT-->
<div class="tab-content">

    <!--MENU 1-->
    <div id="menu_1" class="tab-pane fade in active">

        <!--TASK NAME-->
        @include('package-category::admin.partials.input_text', [
        'name' => 'task_name',
        'label' => trans($plang_admin.'.labels.name'),
        'value' => @$item->task_name,
        'description' => trans($plang_admin.'.descriptions.name'),
        'errors' => $errors,
        ])
        <!--/TASK NAME-->

        <!--TASK SLUG-->
        @include('package-category::admin.partials.input_slug', [
            'name' => 'task_slug',
            'id' => 'task_slug',
            'ref' => 'task_name',
            'label' => trans($plang_admin.'.labels.slug'),
            'value' => @$item->task_slug,
            'description' => trans($plang_admin.'.descriptions.slug'),
            'errors' => $errors,
            'hidden' => true,
        ])
        <!--/TASK SLUG-->

        <!-- LIST OF CATEGORIES -->
        @include('package-category::admin.partials.select_single', [
        'name' => 'category_id',
        'label' => trans($plang_admin.'.labels.category'),
        'items' => $categories,
        'value' => @$itemds->category_id,
        'description' => trans($plang_admin.'.descriptions.category', [
        'href' => URL::route('categories.list', ['_key' => $context->context_key])
        ]),
        'errors' => $errors,
        ])
        <!-- /LIST OF CATEGORIES -->
    </div>

    <!--MENU 2-->
    <div id="menu_2" class="tab-pane fade">
        <!--SAMPLE OVERVIEW-->
        @include('package-category::admin.partials.textarea', [
        'name' => 'task_overview',
        'label' => trans($plang_admin.'.labels.overview'),
        'value' => @$item->task_overview,
        'description' => trans($plang_admin.'.descriptions.overview'),
        'tinymce' => false,
        'errors' => $errors,
        ])
        <!--/SAMPLE OVERVIEW-->

        <!--SAMPLE DESCRIPTION-->
        @include('package-category::admin.partials.textarea', [
        'name' => 'task_description',
        'label' => trans($plang_admin.'.labels.description'),
        'value' => @$item->task_description,
        'description' => trans($plang_admin.'.descriptions.description'),
        'rows' => 50,
        'tinymce' => true,
        'errors' => $errors,
        ])
        <!--/SAMPLE DESCRIPTION-->
    </div>

    <!--MENU 3-->
    <div id="menu_3" class="tab-pane fade">
        <!--SAMPLE IMAGE-->
        @include('package-category::admin.partials.input_image', [
        'name' => 'task_image',
        'label' => trans($plang_admin.'.labels.image'),
        'value' => @$item->task_image,
        'description' => trans($plang_admin.'.descriptions.image'),
        'errors' => $errors,
        ])
        <!--/SAMPLE IMAGE-->

        <!--SAMPLE FILES-->
        @include('package-category::admin.partials.input_files', [
        'name' => 'files',
        'label' => trans($plang_admin.'.labels.files'),
        'value' => @$item->task_files,
        'description' => trans($plang_admin.'.descriptions.files'),
        'errors' => $errors,
        ])
        <!--/SAMPLE FILES-->
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
| End list of elements in task form
|------------------------------------------------------------------------------>
