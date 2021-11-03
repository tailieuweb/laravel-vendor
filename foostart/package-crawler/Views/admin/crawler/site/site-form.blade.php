<!------------------------------------------------------------------------------
| List of elements in site form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['crawler.site.post', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

    <!--BUTTONS-->
    <div class='btn-form'>
        @if(isset($item) && $item->deleted_at)
            <a href="{!! URL::route('crawler.site.restore',['id' => $item->id, '_token' => csrf_token()]) !!}"
               class="btn btn-success pull-right margin-left-5 restore">
                {!! trans($plang_admin.'.buttons.restore') !!}
            </a>
        @elseif (isset($item))
            <a href="{!! URL::route('crawler.site.delete',['id' => @$item->id, '_token' => csrf_token()]) !!}"
               class="btn btn-warning pull-right margin-left-5 delete">
                {!! trans($plang_admin.'.buttons.delete') !!}
            </a>
        @endif
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
        <!--OTHER-->
        <li>
            <a data-toggle="tab" href="#menu_3">
                {!! trans($plang_admin.'.tabs.other') !!}
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
                'name' => 'site_name',
                'label' => trans($plang_admin.'.labels.site_name'),
                'value' => @$item->site_name,
                'description' => trans($plang_admin.'.descriptions.site_name'),
                'errors' => $errors,
            ])
            <!--/NAME-->

            <!--SITE SLUG-->
            @include('package-category::admin.partials.input_slug', [
                'name' => 'site_slug',
                'id' => 'site_slug',
                'ref' => 'site_name',
                'label' => trans($plang_admin.'.labels.slug'),
                'value' => @$item->site_slug,
                'description' => trans($plang_admin.'.descriptions.slug'),
                'errors' => $errors,
            ])
            <!--/SITE SLUG-->

            <!--URL-->
            @include('package-category::admin.partials.input_text', [
                'name' => 'site_url',
                'label' => trans($plang_admin.'.labels.site_url'),
                'value' => @$item->site_name,
                'description' => trans($plang_admin.'.descriptions.site_url'),
                'errors' => $errors,
            ])
            <!-- /URL-->

            <div class="row">
                <div class='col-md-6'>
                    <!--SITE TYPE-->
                    @include('package-category::admin.partials.select_single', [
                        'name' => 'site_type',
                        'label' => trans($plang_admin.'.form.site_type'),
                        'value' => @$item->site_type,
                        'items' => $siteTypeSelect,
                        'description' => trans($plang_admin.'.descriptions.site_type'),
                    ])
                    <!--/SITE TYPE-->
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
                'name' => 'site_description',
                'label' => trans($plang_admin.'.labels.site_description'),
                'value' => @$item->site_description,
                'description' => trans($plang_admin.'.descriptions.site_description'),
                'rows' => 25,
                'tinymce' => true,
                'errors' => $errors,
            ])
            <!--/DESCRIPTION-->
        </div>
        <!--/END MENU1-->
        <!--OTHER-->
        <div id="menu_3" class="tab-pane fade">
            <!--SITE IMAGE-->
            @include('package-category::admin.partials.input_image', [
                'name' => 'site_image',
                'label' => trans($plang_admin.'.labels.site_image'),
                'value' => @$item->site_image,
                'description' => trans($plang_admin.'.descriptions.site_image'),
                'errors' => $errors,
                'lfm_config' => TRUE
            ])
            <!--/SITE IMAGE-->
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
