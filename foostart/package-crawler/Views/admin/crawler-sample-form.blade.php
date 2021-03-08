<!------------------------------------------------------------------------------
| List of elements in crawler form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['crawlers.sample', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

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

            <!--crawler title-->
            @include('package-crawler::admin.partials.input_text', [
            'name' => 'crawler_title',
            'label' => trans($plang_admin.'.labels.title'),
            'value' => @$item->crawler_title,
            'description' => trans($plang_admin.'.descriptions.title'),
            'errors' => $errors,
            ])
            <!--/crawler title-->

            <!--crawler email-->
            @include('package-crawler::admin.partials.textarea', [
            'name' => 'crawler_email',
            'label' => trans($plang_admin.'.labels.email'),
            'value' => @$item->crawler_email,
            'description' => trans($plang_admin.'.descriptions.email'),
            'tinymce' => false,
            'errors' => $errors,
            ])
            <!--/crawler email-->

            <!--crawler phone-->
            @include('package-crawler::admin.partials.input_text', [
            'name' => 'crawler_phone',
            'label' => trans($plang_admin.'.labels.phone'),
            'value' => @$item->crawler_phone,
            'description' => trans($plang_admin.'.descriptions.phone'),
            'errors' => $errors,
            ])
            <!--/crawler title-->

            <!--crawler message-->
            @include('package-crawler::admin.partials.textarea', [
            'name' => 'crawler_message',
            'label' => trans($plang_admin.'.labels.message'),
            'value' => @$item->crawler_message,
            'description' => trans($plang_admin.'.descriptions.message'),
            'rows' => 50,
            'tinymce' => true,
            'errors' => $errors,
            ])
            <!--/crawler message-->

            

        

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
| End list of elements in crawler form
|------------------------------------------------------------------------------>