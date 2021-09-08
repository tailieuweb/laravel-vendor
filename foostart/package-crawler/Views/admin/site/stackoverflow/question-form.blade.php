<!------------------------------------------------------------------------------
| List of elements in site form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['crawler.site.stackoverflow.question.post', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

    <!--BUTTONS-->
    <div class='btn-form'>
        <!-- DELETE BUTTON -->
        @if($item)
            <a href="{!! URL::route('crawler.site.stackoverflow.question.delete',['id' => @$item->id, '_token' => csrf_token()]) !!}"
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
                'name' => 'question_name',
                'label' => trans($plang_admin.'.labels.question_name'),
                'value' => @$item->question_name,
                'description' => trans($plang_admin.'.descriptions.question_name'),
                'errors' => $errors,
            ])
            <!--/NAME-->

            <!--URL-->
            @include('package-category::admin.partials.input_text', [
                'name' => 'question_url',
                'label' => trans($plang_admin.'.labels.question_url'),
                'value' => @$item->question_url,
                'description' => trans($plang_admin.'.descriptions.question_url'),
                'errors' => $errors,
            ])
            <!-- /URL-->

            <div class="row">
                <div class="col-md-6">
                    <!--URL User-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'question_url_user',
                        'label' => trans($plang_admin.'.labels.question_url_user'),
                        'value' => @$item->question_url_user,
                        'items' => $status,
                        'description' => trans($plang_admin.'.descriptions.question_url_user'),
                    ])
                    <!--/URL User-->
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
                'name' => 'question_description',
                'label' => trans($plang_admin.'.labels.question_description'),
                'value' => @$item->question_description,
                'description' => trans($plang_admin.'.descriptions.question_description'),
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
