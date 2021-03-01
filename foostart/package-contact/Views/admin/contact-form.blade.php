<!------------------------------------------------------------------------------
| List of elements in contact form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['contacts.post', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

    <!--BUTTONS-->
    <div class='btn-form'>
        <!-- DELETE BUTTON -->
        @if($item)
            <a href="{!! URL::route('contacts.delete',['id' => @$item->id, '_token' => csrf_token()]) !!}"
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

        <!--MENU 5-->
        <li>
            <a data-toggle="tab" href="#menu_5">
                {!! trans($plang_admin.'.tabs.menu-5') !!}
            </a>
        </li>
    </ul>
    <!--/TAB MENU-->

    <!--TAB CONTENT-->
    <div class="tab-content">

        <!--MENU 1-->
        <div id="menu_1" class="tab-pane fade in active">

            <!--contact NAME-->
            @include('package-category::admin.partials.input_text', [
            'name' => 'contact_name',
            'label' => trans($plang_admin.'.labels.name'),
            'value' => @$item->contact_name,
            'description' => trans($plang_admin.'.descriptions.name'),
            'errors' => $errors,
            ])
            <!--/contact NAME-->

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

            <!--STATUS-->
            @include('package-category::admin.partials.radio', [
                'name' => 'contact_status',
                'label' => trans($plang_admin.'.labels.contact-status'),
                'value' => @$item->contact_status,
                'description' => trans($plang_admin.'.descriptions.contact-status'),
                'items' => $statuses
            ])
        </div>

        <!--MENU 2-->
        <div id="menu_2" class="tab-pane fade">
            <!--contact OVERVIEW-->
            @include('package-category::admin.partials.textarea', [
            'name' => 'contact_overview',
            'label' => trans($plang_admin.'.labels.overview'),
            'value' => @$item->contact_overview,
            'description' => trans($plang_admin.'.descriptions.overview'),
            'tinymce' => false,
            'errors' => $errors,
            ])
            <!--/contact OVERVIEW-->

            <!--contact DESCRIPTION-->
            @include('package-category::admin.partials.textarea', [
            'name' => 'contact_description',
            'label' => trans($plang_admin.'.labels.description'),
            'value' => @$item->contact_description,
            'description' => trans($plang_admin.'.descriptions.description'),
            'rows' => 50,
            'tinymce' => true,
            'errors' => $errors,
            ])
            <!--/contact DESCRIPTION-->
        </div>

        <!--MENU 3-->
        <div id="menu_3" class="tab-pane fade">
            <!--contact IMAGE-->
            @include('package-category::admin.partials.input_image', [
            'name' => 'contact_image',
            'label' => trans($plang_admin.'.labels.image'),
            'value' => @$item->contact_image,
            'description' => trans($plang_admin.'.descriptions.image'),
            'errors' => $errors,
            ])
            <!--/contact IMAGE-->

            <!--contact FILES-->
            @include('package-category::admin.partials.input_files', [
                'name' => 'files',
                'label' => trans($plang_admin.'.labels.files'),
                'value' => @$item->contact_files,
                'description' => trans($plang_admin.'.descriptions.files'),
                'errors' => $errors,
            ])
            <!--/contact FILES-->
        </div>

        <!--MENU 4-->
        <div id="menu_4" class="tab-pane fade in active">

            <!--contact SEARCH-->
            @include('package-contact::admin.partials.search')
            <!--/contact SEARCH-->

            
        </div>

        <!--MENU 5-->
        <div id="menu_5" class="tab-pane fade">

            <!--contact DESCRIPTION-->
            @include('package-category::admin.partials.textarea', [
            'name' => 'contact_answer',
            'label' => trans($plang_admin.'.labels.answer'),
            'value' => @$item->contact_answer,
            'description' => trans($plang_admin.'.descriptions.answer'),
            'rows' => 50,
            'tinymce' => true,
            'errors' => $errors,
            ])
            <!--/contact DESCRIPTION-->
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
| End list of elements in contact form
|------------------------------------------------------------------------------>