<?php
$withs = [
    'counter' => '5%',
    'id' => '10%',
    'job_name' => '40%',
    'status' => '10%',
    'updated_at' => '20%'
];
?>
@if(!empty($items) && (!$items->isEmpty()) )
    <div style="min-height: 50px;">
        <div>
            @if($items->total() == 1)
                {!! trans($plang_admin.'.descriptions.counter', ['number' => 1]) !!}
            @else
                {!! trans($plang_admin.'.descriptions.counters', ['number' => $items->total()]) !!}
            @endif
        </div>

        {!! Form::submit(trans($plang_admin.'.buttons.delete-in-trash'), array(
                                                                            "class"=>"btn btn-warning delete btn-delete-all",
                                                                            "title"=> trans($plang_admin.'.hint.delete-in-trash'),
                                                                            'name'=>'del-trash'))
        !!}
        {!! Form::submit(trans($plang_admin.'.buttons.delete-forever'), array(
                                                                            "class"=>"btn btn-danger delete btn-delete-all",
                                                                            "title"=> trans($plang_admin.'.hint.delete-forever'),
                                                                            'name'=>'del-forever'))
        !!}
    </div>
<div class="table-responsive">
<table class="table table-hover">

    <thead>
        <tr style="height: 50px;">

            <!--COUNTER-->
            <th style='width:{{ $withs['counter'] }}'>
                {{ trans($plang_admin.'.columns.counter') }}
                <span class="del-checkbox pull-right">
                    <input type="checkbox" id="selecctall" />
                    <label for="del-checkbox"></label>
                </span>
            </th>

            <!-- ID -->
            <?php $name = 'id' ?>
            <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                {!! trans($plang_admin.'.labels.'.$name) !!}
                <a href='{!! $sorting["url"][$name] !!}' class='tb-email' data-order='asc'>
                    @if($sorting['items'][$name] == 'asc')
                        <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                    @elseif($sorting['items'][$name] == 'desc')
                        <i class="fa fa-sort-amount-desc" aria-hidden="true"></i>
                    @else
                        <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                    @endif
                </a>
            </th>

            <!--NAME-->
            <?php $name = 'job_name' ?>
            <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                {!! trans($plang_admin.'.columns.job_name') !!}
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

            <!--STATUS-->
            <?php $name = 'status' ?>
            <th class="hidden-xs text-center" style='width:{{ $withs[$name] }}'>{!! trans($plang_admin.'.columns.status') !!}
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
            <th class="hidden-xs" style='width:{{ $withs[$name] }}'>{!! trans($plang_admin.'.columns.updated_at') !!}
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

        </tr>

    </thead>

    <tbody>
        <?php $counter = $items->perPage() * ($items->currentPage() - 1) + 1;  ?>
        @foreach($items as $item)
            <tr>
                <!--COUNTER-->
                <td>
                    <?php echo $counter; $counter++ ?>
                    <span class='box-item pull-right'>
                        <input type="checkbox" id="<?php echo $item->id ?>" name="ids[]" value="{!! $item->id !!}">
                        <label for="box-item"></label>
                    </span>
                </td>

                <td>
                    <a href="{!! URL::route('crawler.work.job.edit', ['id' => $item->id]) !!}">
                        {!! $item->id !!}
                    </a>
                </td>

                <!--NAME-->
                <td>
                    {!! $item->job_name !!}
                </td>

                <!--STATUS-->
                <td class="text-center">
                    @if($item->status && (isset($config_status['list'][$item->status])))
                        <i class="fa fa-circle" style="color:{!! $config_status['color'][$item->status] !!}" title='{!! $config_status["list"][$item->status] !!}'></i>
                    @else
                    <i class="fa fa-circle-o red" title='{!! trans($plang_admin.".labels.unknown") !!}'></i>
                    @endif
                </td>

                <!--UPDATED AT-->
                <td> {!! $item->updated_at !!} </td>
            </tr>
        @endforeach

    </tbody>

</table>
</div>
<div class="paginator">
    {!! $items->appends($request->except(['page']) )->render($pagination_view)  !!}
</div>
@else
    <!--SEARCH RESULT MESSAGE-->
    <span class="text-warning">
        <h5>
            {{ trans($plang_admin.'.descriptions.not-found') }}
        </h5>
    </span>
    <!--/SEARCH RESULT MESSAGE-->
@endif

@section('footer_scripts')
    @parent
    {!! HTML::script('packages/foostart/js/form-table.js')  !!}
@stop
