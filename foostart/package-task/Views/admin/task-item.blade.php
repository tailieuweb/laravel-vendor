@if(!empty($items) && (!$items->isEmpty()) )
    <?php
        $withs = [
            'order' => '5%',
            'name' => '30%',
            'status' => '10%',
            'task_start_date' => '10%',
            'task_end_date' => '10%',
            'updated_at' => '10%',
            'operations' => '10%',
        ];

        global $counter;
        $nav = $items->toArray();
        $counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
    ?>

    <div class="btn-delete-top">
        <div>
            @if($nav['total'] == 1)
            {!! trans($plang_admin.'.description.counter', ['number' => $nav['total']]) !!}
            @else
            {!! trans($plang_admin.'.description.counters', ['number' => $nav['total']]) !!}
            @endif
        </div>
        {!! Form::submit(trans($plang_admin.'.buttons.del-trash'), array(
                                    "class"=>"btn btn-danger delete btn-delete-all del-trash",
                                    'name'=>'del-trash'))
                                    !!}
        {!! Form::submit(trans($plang_admin.'.buttons.del-forever'), array(
                                    "class"=>"btn btn-warning delete btn-delete-all del-forever",
                                    'name'=>'del-forever'))
                                    !!}
    </div>

    <table class="table table-hover" id="tbTask">

        <thead>
            <tr style="height: 50px;">

                <!--ORDER-->
                <th style='width:{{ $withs['order'] }}'>
                    {{ trans($plang_admin.'.columns.order') }}
                    <span class="del-checkbox pull-right">
                        <input type="checkbox" id="selecctall"/>
                        <label for="del-checkbox"></label>
                    </span>
                </th>

                <!-- NAME -->
                <?php $name = 'task_name' ?>
                <th class="hidden-xs" style='width:{{ $withs['name'] }}'>
                    {!! trans($plang_admin.'.columns.name') !!}
                    <a href='{!! $sorting["url"][$name] !!}' class='tb-id' data-order='asc'>
                        @if($sorting['items'][$name] == 'asc')
                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>
                        @elseif($sorting['items'][$name] == 'desc')
                            <i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                        @endif
                    </a>
                </th>

                <!-- STATUS -->
                <?php $name = 'status' ?>
                <th class="hidden-xs" style='width:{{ $withs[$name] }}; text-align: center;'>
                    {!! trans($plang_admin.'.columns.status') !!}
                    <a href='{!! $sorting["url"][$name] !!}' class='tb-id' data-order='asc'>
                        @if($sorting['items'][$name] == 'asc')
                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>
                        @elseif($sorting['items'][$name] == 'desc')
                            <i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                        @endif
                    </a>
                </th>

                <!-- START DATE -->
                <?php $name = 'task_start_date' ?>
                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                    Ngày bắt đầu
                    <a href='{!! $sorting["url"][$name] !!}' class='tb-id' data-order='asc'>
                        @if($sorting['items'][$name] == 'asc')
                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>
                        @elseif($sorting['items'][$name] == 'desc')
                            <i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                        @endif
                    </a>
                </th>

                <!-- END DATE -->
                <?php $name = 'task_end_date' ?>
                <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                    Ngày kết thúc
                    <a href='{!! $sorting["url"][$name] !!}' class='tb-id' data-order='asc'>
                        @if($sorting['items'][$name] == 'asc')
                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>
                        @elseif($sorting['items'][$name] == 'desc')
                            <i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                        @endif
                    </a>
                </th>

                <!-- UPDATED AT -->
                <?php $name = 'updated_at' ?>
                <th class="hidden-xs" style='width:{{ $withs['updated_at'] }}'>{!! trans($plang_admin.'.columns.updated_at') !!}
                    <a href='{!! $sorting["url"][$name] !!}' class='tb-id' data-order='asc'>
                        @if($sorting['items'][$name] == 'asc')
                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>
                        @elseif($sorting['items'][$name] == 'desc')
                            <i class="fa fa-sort-alpha-desc" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                        @endif
                    </a>
                </th>

                <!--OPERATIONS-->
                <th style='width:{{ $withs['operations'] }};'>
                    <span class='lb-delete-all'>
                        {{ trans($plang_admin.'.columns.operations') }}
                    </span>
                </th>

            </tr>
        </thead>

    <tbody>
        @foreach($items as $item)
        <tr>
            <!--COUNTER-->
            <td>
                <?php echo $counter; $counter++  ?>
                <span class='box-item pull-right'>
                    <input type="checkbox" id="<?php echo $item->id ?>" name="ids[]" value="{!! $item->id !!}">
                    <label for="box-item"></label>
                </span>
            </td>

            <!--NAME-->
            <td> {!! $item->task_name !!} </td>

            <!--STATUS-->
            <td style="text-align: center;">
                @if($item->status && (isset($config_status['list'][$item->status])))
                    <i class="fa fa-circle" style="color:{!! $config_status['color'][$item->status] !!}"
                       title='{!! $config_status["list"][$item->status] !!}'></i>
                @else
                    <i class="fa fa-circle-o red" title='{!! trans($plang_admin.".labels.unknown") !!}'></i>
                @endif
            </td>

            <!--START DATE-->
            <td> {!! $item->task_start_date !!} </td>

            <!--END DATE-->
            <td> {!! $item->task_end_date !!} </td>

            <!--UPDATED AT-->
            <td> {!! $item->updated_at !!} </td>

            <!--OPERATOR-->
            <td>
                <!--edit-->
                <a href="{!! URL::route('task.edit', [   'id' => $item->id,
                   '_token' => csrf_token()
                   ])
                   !!}">
                    <i class="fa fa-edit f-tb-icon"></i>
                </a>

                <!--copy-->
                <a href="{!! URL::route('task.copy',[    'cid' => $item->id,
                   '_token' => csrf_token(),
                   ])
                   !!}"
                   class="margin-left-5">
                    <i class="fa fa-files-o f-tb-icon" aria-hidden="true"></i>
                </a>

                <!--delete-->
                <a href="{!! URL::route('task.delete',[  'id' => $item->id,
                   '_token' => csrf_token(),
                   ])
                   !!}"
                   class="margin-left-5 delete">
                    <i class="fa fa-trash-o f-tb-icon"></i>
                </a>

            </td>

        </tr>
        @endforeach

    </tbody>

</table>

<div class="paginator">
    {!! $items->appends($request->except(['page']) )->render() !!}
</div>
@else
<!--SEARCH RESULT MESSAGE-->
<span class="text-warning">
    <h5>
        {{ trans($plang_admin.'.description.not-found') }}
    </h5>
</span>
<!--/SEARCH RESULT MESSAGE-->
@endif

@section('footer_scripts')
@parent
{!! HTML::script('packages/foostart/package-task/js/form-table.js')  !!}
@stop

@section('footer_scripts')
    @parent
    {!! HTML::script('packages/foostart/js/form-table.js')  !!}
@stop
