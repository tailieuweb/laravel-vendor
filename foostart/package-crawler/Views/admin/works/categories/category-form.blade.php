<!------------------------------------------------------------------------------
| List of elements in category form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['crawler.work.category.post', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

<!--BUTTON FORM -->
@include('package-category::admin.partials.btn-form-edit', [
    'item' => @$item,
    'routeRestore' => 'crawler.work.category.restore',
    'routeDelete' => 'crawler.work.category.delete',
])
<!--/BUTTON FORM-->

<!--TAB MENU-->
<ul class="nav nav-tabs">
    <!--MENU #1-->
    <li class="active">
        <a data-toggle="tab" href="#menu_1">
            {!! trans($plang_admin.'.tabs.basic') !!}
        </a>
    </li>
    <!--MENU #2-->
    <li>
        <a data-toggle="tab" href="#menu_2">
            {!! trans($plang_admin.'.tabs.advance') !!}
        </a>
    </li>
    <!--MENU #3-->
    <li>
        <a data-toggle="tab" href="#menu_3">
            {!! trans($plang_admin.'.tabs.other') !!}
        </a>
    </li>
</ul>
<!--/TAB MENU-->

<!--TAB CONTENT-->
<div class="tab-content">

    <!--MENU #1-->
    <div id="menu_1" class="tab-pane fade in active">
        <div class="row">
            <div class="col-md-12">
                <!--NAME-->
            @include('package-category::admin.partials.input_text', [
                'name' => 'category_name',
                'label' => trans($plang_admin.'.labels.category_name'),
                'value' => @$item->category_name,
                'description' => trans($plang_admin.'.descriptions.category_name'),
                'errors' => $errors,
            ])
            <!--/NAME-->
            </div>
            <div class="col-md-12">
                <!--URL-->
            @include('package-category::admin.partials.input_text', [
                'name' => 'category_url',
                'label' => trans($plang_admin.'.labels.category_url'),
                'value' => @$item->category_url,
                'description' => trans($plang_admin.'.descriptions.category_url'),
                'errors' => $errors,
            ])
            <!--/URL-->
            </div>

            <div class='col-md-6'>
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
        'name' => 'category_description',
        'label' => trans($plang_admin.'.labels.category_description'),
        'value' => @$item->category_description,
        'description' => trans($plang_admin.'.descriptions.category_description'),
        'rows' => 25,
        'tinymce' => true,
        'errors' => $errors,
    ])
    <!--/DESCRIPTION-->
    </div>
    <!--/MENU #1-->

    <!--MENU #2-->
    <div id="menu_2" class="tab-pane fade">
        <!--category OVERVIEW-->
    @include('package-category::admin.partials.textarea', [
    'name' => 'category_overview',
    'label' => trans($plang_admin.'.labels.category_overview'),
    'value' => @$item->category_overview,
    'description' => trans($plang_admin.'.descriptions.category_overview'),
    'tinymce' => false,
    'errors' => $errors,
    ])
    <!--/category OVERVIEW-->
    </div>
    <!--/MENU #2-->

    <!--MENU #3-->
    <div id="menu_3" class="tab-pane fade">
        <!--category IMAGE-->
    @include('package-category::admin.partials.input_image', [
        'name' => 'category_image',
        'label' => trans($plang_admin.'.labels.image'),
        'value' => @$item->category_image,
        'description' => trans($plang_admin.'.descriptions.category_image'),
        'errors' => $errors,
        'lfm_config' => TRUE
    ])
    <!--/category IMAGE-->
    </div>
    <!--/MENU #3-->

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
| End list of elements in category form
|------------------------------------------------------------------------------>
