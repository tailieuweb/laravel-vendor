@if(!empty($items) && (!$items->isEmpty()) )
<?php
$withs = [
    'order' => '5%',
    'name' => '50%',
    'status' => '10%',
    'updated_at' => '20%',
    'operations' => '10%',
    'delete' => '5%',
];

global $counter;
$nav = $items->toArray();
$counter = ($nav['current_page'] - 1) * $nav['per_page'] + 1;
?>
<caption>
    @if($nav['total'] == 1)
    {!! trans($plang_admin.'.descriptions.counter', ['number' => $nav['total']]) !!}
    @else
    {!! trans($plang_admin.'.descriptions.counters', ['number' => $nav['total']]) !!}
    @endif
</caption>

<table class="table table-hover" id="tbTask">

    <thead>
        <tr style="height: 50px;">

            <!--ORDER-->
            <th style='width:{{ $withs['order'] }}'>
                {{ trans($plang_admin.'.columns.order') }}
            </th>

            <!-- NAME -->
            <?php $name = 'task_name' ?>

            <th class="hidden-xs" style='width:{{ $withs['name'] }}'>{!! trans($plang_admin.'.columns.name') !!}
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

            <th class="hidden-xs" style='width:{{ $withs['updated_at'] }}'>{!! trans($plang_admin.'.columns.status') !!}
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
            <td> <?php
                echo $counter;
                $counter++
                ?> </td>

            <!--NAME-->
            <td> {!! $item->tasks->task_name !!} </td>

            <!--STATUS-->
            <td> {!! @$status[$item->status] !!} </td>

            <!--UPDATED AT-->
            <td> {!!
                    $item->tasks->updated_at !!} </td>

            <!--OPERATOR-->
            <td>
                <!--view-->
                <a href="{!! URL::route('usertask.edit', [   'id' => $item->tasks->task_id,
                   '_token' => csrf_token()
                   ])
                   !!}">
                    <i class="fa fa-edit f-tb-icon"></i>
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
        {{ trans($plang_admin.'.descriptions.not-found') }}
    </h5>
</span>
<!--/SEARCH RESULT MESSAGE-->
@endif

@section('footer_scripts')
@parent
{!! HTML::script('packages/foostart/package-task/js/form-table.js')  !!}
@stop

<script>
    function checkAllCheckBox() {
        var checkboxes = $('#tbTask').find(':checkbox');
        var isCheckedAll = $("#selecctall:checked").length; // if length is 0 that checkbox was unchecked, otherwise

        if (isCheckedAll) {
            $(".colDel").show();
        } else {
            $(".colDel").hide();
        }
        for (var i = 1; i < checkboxes.length; i++) {
            checkboxes[i].checked = isCheckedAll;
        }
    }
    function checkedCheckBox(){
        var check = $("input[name='ids[]']:checked").length;
        if(check){
            $(".colDel").show();
        }else {
            $(".colDel").hide();
        }
    }
</script>
