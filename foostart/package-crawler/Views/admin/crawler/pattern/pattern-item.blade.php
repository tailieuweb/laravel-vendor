<?php
$withs = [
    'counter' => '5%',
    'id' => '10%',
    'pattern_name' => '25%',
    'pattern_machine_name' => '25%',
    'status' => '10%',
    'updated_at' => '15%',
    'operations' => '15%',
];
?>
@if(!empty($crawlerPatterns) && (!$crawlerPatterns->isEmpty()) )
    <div style="min-height: 50px;">
        <div>
            @if($crawlerPatterns->total() == 1)
                {!! trans($plang_admin.'.descriptions.counter', ['number' => 1]) !!}
            @else
                {!! trans($plang_admin.'.descriptions.counters', ['number' => $crawlerPatterns->total()]) !!}
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

            <!--ID-->
            <?php $name = 'id' ?>
            <th class="hidden-xs" style='width:{{ $withs['id'] }}'>{!! trans($plang_admin.'.columns.id') !!}
                <a href='{!! $sorting["url"][$name] !!}' class='tb-id' data-order='asc'>
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
            <?php $name = 'pattern_name' ?>
            <th class="hidden-xs" style='width:{{ $withs[$name] }}'>{!! trans($plang_admin.'.columns.pattern_name') !!}
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

            <!--MACHINE NAME-->
            <?php $name = 'pattern_machine_name' ?>
            <th class="hidden-xs" style='width:{{ $withs[$name] }}'>
                {!! trans($plang_admin.'.columns.machine_name') !!}
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
            <th class="hidden-xs text-center" style='width:{{ $withs['status'] }}'>{!! trans($plang_admin.'.columns.status') !!}
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
            <th style='width:{{ $withs['operations'] }}'>
                <span class='lb-delete-all'>
                    {{ trans($plang_admin.'.columns.operations') }}
                </span>
            </th>

        </tr>

    </thead>

    <tbody>
        <?php $counter = $crawlerPatterns->perPage() * ($crawlerPatterns->currentPage() - 1) + 1;  ?>
        @foreach($crawlerPatterns as $item)
            <tr>
                <!--COUNTER-->
                <td>
                    <?php echo $counter; $counter++ ?>
                    <span class='box-item pull-right'>
                        <input type="checkbox" id="<?php echo $item->id ?>" name="ids[]" value="{!! $item->id !!}">
                        <label for="box-item"></label>
                    </span>
                </td>

                <!--ID-->
                <td>
                    <a href="{!! URL::route('crawler.pattern.edit', [   'id' => $item->id,
                                                                '_token' => csrf_token()
                                                            ])
                            !!}">
                    {!! $item->pattern_id !!}
                    </a>
                </td>

                <!--NAME-->
                <td> {!! $item->pattern_name !!} </td>

                <!--MACHINE NAME-->
                <td> {!! $item->pattern_machine_name !!} </td>

                <!--STATUS-->
                <td style="text-align: center;">
                    @if($item->status && (isset($config_status['list'][$item->status])))
                        <i class="fa fa-circle" style="color:{!! $config_status['color'][$item->status] !!}" title='{!! $config_status["list"][$item->status] !!}'></i>
                    @else
                    <i class="fa fa-circle-o red" title='{!! trans($plang_admin.".labels.unknown") !!}'></i>
                    @endif
                </td>

                <!--UPDATED AT-->
                <td> {!! $item->updated_at !!} </td>

                <!--OPERATOR-->
                <td>
                    <!--edit-->
                    <a href="{!! URL::route('crawler.pattern.edit', [   'id' => $item->id,
                                                                '_token' => csrf_token()
                                                            ])
                            !!}">
                        <i class="fa fa-edit f-tb-icon"></i>
                    </a>

                    <!--copy-->
                    <a href="{!! URL::route('crawler.pattern.copy',[    'cid' => $item->id,
                                                                '_token' => csrf_token(),
                                                            ])
                             !!}"
                        class="margin-left-5">
                        <i class="fa fa-files-o f-tb-icon" aria-hidden="true"></i>
                    </a>

                    <!--delete-->
                    <a href="{!! URL::route('crawler.pattern.delete',[  'id' => $item->id,
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
</div>
<div class="paginator">
    {!! $crawlerPatterns->appends($request->except(['page']) )->render($pagination_view)  !!}
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
