<!------------------------------------------------------------------------------
| List of elements in task form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['usertask.post', 'id' => @$item->tasks->task_id],  'files'=>true, 'method' => 'post'])  !!}

<!--BUTTONS-->
<div class='btn-form'>

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
            {!! trans($plang_admin.'.tabs.usermenu_1') !!}
        </a>
    </li>

    <!--MENU 2-->
    <li>
        <a data-toggle="tab" href="#menu_2">
            {!! trans($plang_admin.'.tabs.usermenu_2') !!}
        </a>
    </li>


</ul>
<!--/TAB MENU-->

<!--TAB CONTENT-->
<div class="tab-content">

    <!--MENU 1-->
    <div id="menu_1" class="tab-pane fade in active">
        <!--STATUS-->
        @include('package-category::admin.partials.select_single', [
            'name' => 'status',
            'label' => trans($plang_admin.'.form.status'),
            'value' => @$item->status,
            'items' => $status,
            'description' => trans($plang_admin.'.descriptions.status'),
        ])

        <!--Notes->
        @include('package-category::admin.partials.textarea', [
            'name' => 'notes',
            'label' => trans($plang_admin.'.labels.notes'),
            'value' => @$item->notes,
            'description' => trans($plang_admin.'.descriptions.notes'),
            'tinymce' => false,
            'errors' => $errors,
        ])
        <!--/SAMPLE OVERVIEW-->
    </div>

    <!--MENU 2-->
    <div id="menu_2" class="tab-pane fade">
        <!--TASK NAME-->
        <div class="task_name">
            Tên công việc: {{$item->tasks->task_name}}
        </div>
        <!--/TASK NAME-->
        <!--TASK OVERVIEW-->
        <div class="task_name">
            Sơ lược: {{$item->tasks->task_overview}}
        </div>
        <!--/TASK OVERVIEW-->
        <!--TASK DESCRIPTION-->
        <div class="task_name">
            Sơ lược: {{$item->tasks->task_description}}
        </div>
        <!--/TASK DESCRIPTION-->


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

@section('footer_scripts')
    @parent

    <script type='text/javascript'>



    </script>
@endsection
