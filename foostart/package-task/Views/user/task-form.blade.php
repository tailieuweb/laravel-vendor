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
        @include('package-category::admin.partials.input_text', [
            'name' => 'task_name',
            'label' => trans($plang_admin.'.labels.name'),
            'value' => @$item->tasks->task_name,
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
            'value' => @$item->tasks->task_slug,
            'description' => trans($plang_admin.'.descriptions.slug'),
            'errors' => $errors,
            'hidden' => true,
        ])
        <!--/TASK SLUG-->

        <div class="row">
            <div class='col-md-4'>
                <!--START DATE-->
            <?php $task_start_date = null ?>
            @if(isset($item->tasks->task_end_date))
                <?php $task_start_date = date('d-m-Y', strtotime($item->tasks->task_start_date)) ?>
            @endif
            @include('package-category::admin.partials.input_date', [
                'name' => 'task_start_date',
                'id' => 'datepicker_start_date',
                'label' => trans($plang_admin.'.labels.start_date'),
                'value' => $task_start_date,
                'description' => trans($plang_admin.'.descriptions.start_date'),
                'errors' => $errors,
            ])
            <!--/START DATE-->
            </div>
            <div class='col-md-4'>
                <!--END DATE-->
            <?php $task_end_date = null ?>
            @if(isset($item->tasks->task_end_date))
                <?php $task_end_date = date('d-m-Y', strtotime($item->tasks->task_end_date)) ?>
            @endif
            @include('package-category::admin.partials.input_date', [
                'name' => 'task_end_date',
                'id' => 'datepicker_end_date',
                'label' => trans($plang_admin.'.labels.end_date'),
                'value' => $task_end_date,
                'description' => trans($plang_admin.'.descriptions.end_date'),
                'errors' => $errors,
            ])
            <!--/END DATE-->
            </div>
            <div class="col-md-4">
                <!-- LIST OF CATEGORIES -->
            @include('package-category::admin.partials.select_single', [
                'name' => 'category_id',
                'label' => trans($plang_admin.'.labels.category'),
                'items' => $categories,
                'value' => @$item->tasks->category_id,
                'description' => trans($plang_admin.'.descriptions.category', [
                'href' => URL::route('categories.list', ['_key' => $context->context_key])
                ]),
                'errors' => $errors,
            ])
            <!-- /LIST OF CATEGORIES -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <!--SIZE-->
                @include('package-category::admin.partials.select_single', [
                    'name' => 'task_size',
                    'label' => trans($plang_admin.'.form.task_size'),
                    'value' => @$item->tasks->task_size,
                    'items' => $size,
                    'description' => trans($plang_admin.'.descriptions.task_size'),
                ])
            </div>
            <div class="col-md-4">
                <!--PRIORITY-->
                @include('package-category::admin.partials.select_single', [
                    'name' => 'task_priority',
                    'label' => trans($plang_admin.'.form.task_priority'),
                    'value' => @$item->tasks->task_priority,
                    'items' => $priority,
                    'description' => trans($plang_admin.'.descriptions.task_priority'),
                ])
            </div>
            

        </div>

        <!--SAMPLE OVERVIEW-->
        @include('package-category::admin.partials.textarea', [
        'name' => 'task_overview',
        'label' => trans($plang_admin.'.labels.overview'),
        'value' => @$item->tasks->task_overview,
        'description' => trans($plang_admin.'.descriptions.overview'),
        'tinymce' => false,
        'errors' => $errors,
        ])
        <!--/SAMPLE OVERVIEW-->

            <!--SAMPLE DESCRIPTION-->
        @include('package-category::admin.partials.textarea', [
        'name' => 'task_description',
        'label' => trans($plang_admin.'.labels.description'),
        'value' => @$item->tasks->task_description,
        'description' => trans($plang_admin.'.descriptions.description'),
        'rows' => 50,
        'tinymce' => true,
        'errors' => $errors,
        ])
        <!--/SAMPLE DESCRIPTION-->


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
    {!! HTML::script('packages/foostart/js/form-table.js')  !!}
    {!! HTML::script('packages/foostart/js/vendor/moment-with-locales-2.29.1.min.js') !!}
    {!! HTML::script('packages/foostart/js/vendor/bootstrap-datetimepicker-4.17.47.min.js') !!}
    <script type='text/javascript'>
        $(document).ready(function () {
            //https://getdatepicker.com/4/#bootstrap-3-datepicker-v4-docs
            $(function () {
                $('#datepicker_start_date').datetimepicker({
                    format: 'DD-MM-YYYY'
                });
                $('#datepicker_end_date').datetimepicker({
                    useCurrent: false, //Important! See issue #1075
                    format: 'DD-MM-YYYY'
                });
                $("#datepicker_start_date").on("dp.change", function (e) {
                    $('#datepicker_end_date').data("DateTimePicker").minDate(e.date);
                });
                $("#datepicker_end_date").on("dp.change", function (e) {
                    $('#datepicker_start_date').data("DateTimePicker").maxDate(e.date);
                });
            });
        });
    </script>
@endsection
