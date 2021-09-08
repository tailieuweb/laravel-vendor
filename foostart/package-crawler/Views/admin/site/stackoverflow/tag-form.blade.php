<!------------------------------------------------------------------------------
| List of elements in site form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['crawler.site.stackoverflow.tag.post', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

    <!--BUTTONS-->
    <div class='btn-form'>
        <!-- DELETE BUTTON -->
        @if($item)
            <a href="{!! URL::route('crawler.site.stackoverflow.tag.delete',['id' => @$item->id, '_token' => csrf_token()]) !!}"
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
                'name' => 'tag_name',
                'label' => trans($plang_admin.'.labels.tag_name'),
                'value' => @$item->tag_name,
                'description' => trans($plang_admin.'.descriptions.tag_name'),
                'errors' => $errors,
            ])
            <!--/NAME-->

            <!--URL-->
            @include('package-category::admin.partials.input_text', [
                'name' => 'tag_url',
                'label' => trans($plang_admin.'.labels.tag_url'),
                'value' => @$item->tag_url,
                'description' => trans($plang_admin.'.descriptions.site_url'),
                'errors' => $errors,
            ])
            <!-- /URL-->

            <div class="row">
                <div class="col-md-6">
                    <!--NUM QUESTIONS-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'tag_num_questions',
                        'label' => trans($plang_admin.'.labels.tag_num_questions'),
                        'value' => @$item->tag_num_questions,
                        'items' => $status,
                        'description' => trans($plang_admin.'.descriptions.tag_num_questions'),
                    ])
                    <!--/NUM QUESTIONS-->
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
            <!--OTHER-->
            @include('package-category::admin.partials.textarea', [
            'name' => 'tag_other',
            'label' => trans($plang_admin.'.labels.tag_other'),
            'value' => @$item->tag_other,
            'description' => trans($plang_admin.'.descriptions.tag_other'),
            'tinymce' => false,
            'errors' => $errors,
            ])
            <!--/OTHER-->

             <!--DESCRIPTION-->
            @include('package-category::admin.partials.textarea', [
                'name' => 'tag_overview',
                'label' => trans($plang_admin.'.labels.tag_overview'),
                'value' => @$item->tag_overview,
                'description' => trans($plang_admin.'.descriptions.tag_overview'),
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
| End list of elements in site form
|------------------------------------------------------------------------------>
