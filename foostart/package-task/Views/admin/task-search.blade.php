<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i>
            <?php echo trans($plang_admin.'.labels.title-search') ?>
        </h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'task.list','method' => 'get']) !!}

            <!--BUTTONS-->
            <div class="form-group">
                <a href="{!! URL::route('task.list', ['context' => @$params['context']]) !!}" class="btn btn-default search-reset">
                    {!! trans($plang_admin.'.buttons.reset') !!}
                </a>
                {!! Form::submit(trans($plang_admin.'.buttons.search').'', ["class" => "btn btn-info", 'id' => 'search-submit']) !!}
            </div>

            <!-- KEYWORD -->
            @include('package-category::admin.partials.input_text', [
                'name' => 'keyword',
                'label' => trans($plang_admin.'.form.keyword'),
                'value' => @$params['keyword'],
            ])

            <!-- START DATE -->
            @include('package-category::admin.partials.input_date', [
                'name' => 'task_start_date',
                'label' => trans($plang_admin.'.form.start_date'),
                'value' => @$params['task_start_date']?$params['task_start_date']:'',
                'id' => 'search_start_date'
            ])

            <!-- END DATE -->
            @include('package-category::admin.partials.input_date', [
                'name' => 'task_end_date',
                'label' => trans($plang_admin.'.form.end_date'),
                'value' => @$params['task_end_date']?$params['task_end_date']:'',
                'id' => 'search_end_date'
            ])
            <!-- STATUS -->
            @include('package-category::admin.partials.select_single', [
                'name' => 'status',
                'label' => trans($plang_admin.'.form.status'),
                'value' => @$params['status']?$params['status']:'99',
                'items' => $status,
            ])
            <!-- SIZE -->
            @include('package-category::admin.partials.select_single', [
                'name' => 'task_size',
                'label' => trans($plang_admin.'.form.task_size'),
                'value' => @$params['task_size']?$params['task_size']:'',
                'items' => $size,
            ])
            <!-- PRIORITY -->
            @include('package-category::admin.partials.select_single', [
                'name' => 'task_priority',
                'label' => trans($plang_admin.'.form.task_priority'),
                'value' => @$params['task_priority']?$params['task_priority']:'',
                'items' => $priority,
            ])

            <!--SORTING-->
            @include('package-category::admin.partials.sorting')

            <div class='hidden-field'>
                {!! Form::hidden('context',@$request->get('context',null)) !!}
                {!! csrf_field() !!}
            </div>

        {!! Form::close() !!}
    </div>
</div>
@section('footer_scripts')
    @parent
    <script type='text/javascript'>
        $(document).ready(function () {
            //https://getdatepicker.com/4/#bootstrap-3-datepicker-v4-docs
            $(function () {
                $('#search_start_date').datetimepicker({
                    format: 'DD-MM-YYYY'
                });
                $('#search_end_date').datetimepicker({
                    useCurrent: false, //Important! See issue #1075
                    format: 'DD-MM-YYYY'
                });
                $("#search_start_date").on("dp.change", function (e) {
                    $('#search_end_date').data("DateTimePicker").minDate(e.date);
                });
                $("#search_end_date").on("dp.change", function (e) {
                    $('#search_end_date').data("DateTimePicker").maxDate(e.date);
                });
            });
        });
    </script>
@endsection
