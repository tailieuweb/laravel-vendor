<!------------------------------------------------------------------------------
| List of elements in pattern form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['crawler.pattern.post', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

    <!--BUTTONS-->
    <div class='btn-form'>
        <!-- RESTORE/DELETE BUTTON -->
        @if(isset($item) && $item->deleted_at)
            <a href="{!! URL::route('crawler.pattern.restore',['id' => $item->id, '_token' => csrf_token()]) !!}"
               class="btn btn-success pull-right margin-left-5 restore">
                {!! trans($plang_admin.'.buttons.restore') !!}
            </a>
        @elseif (isset($item))
            <a href="{!! URL::route('crawler.pattern.delete',['id' => @$item->id, '_token' => csrf_token()]) !!}"
               class="btn btn-warning pull-right margin-left-5 delete">
                {!! trans($plang_admin.'.buttons.delete') !!}
            </a>
        @endif
        <!-- RESTORE/DELETE BUTTON -->

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
        <li class="">
            <a data-toggle="tab" href="#menu_2">
                {!! trans($plang_admin.'.tabs.menu-2') !!}
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

            <!--MACHINE NAME-->
            @include('package-category::admin.partials.input_slug', [
                'name' => 'pattern_machine_name',
                'id' => 'pattern_machine_name',
                'ref' => 'pattern_name',
                'label' => trans($plang_admin.'.labels.pattern_machine_name'),
                'value' => @$item->pattern_machine_name,
                'description' => trans($plang_admin.'.descriptions.pattern_machine_name'),
                'errors' => $errors,
            ])
            <!--/MACHINE NAME-->

            <div class="row">
                <div class="col-md-6">
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
                'name' => 'pattern_description',
                'label' => trans($plang_admin.'.labels.pattern_description'),
                'value' => @$item->pattern_description,
                'description' => trans($plang_admin.'.descriptions.pattern_description'),
                'rows' => 15,
                'tinymce' => true,
                'errors' => $errors,
            ])
            <!--/DESCRIPTION-->

        </div>
        <!--MENU 2-->
        <div id="menu_2" class="tab-pane fade">
            <!--REGULAR EXPRESSION-->
            @include('package-category::admin.partials.input_text_add_more', [
                'name' => 'regular_expression',
                '_name' => 'regular_expression[]',
                'label' => trans($plang_admin.'.labels.regular_expression'),
                'description' => trans($plang_admin.'.descriptions.regular_expression'),
                'items' => $regular_expressions,
                'errors' => $errors,
            ])
            <!--/NAME-->
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
