@if(!empty($items) )
<?php
$withs = [
    'order' => '5%',
    'name' => '15%',
    'total' => '5%',
    'assigned' => '5%',
    'canceled' => '5%',
    'done' => '5%',
    'declined' => '5%',
    'inprogress' => '5%',
    'pending' => '5%',
    'tasks' => '5%',

];

global $counter;

$counter = 1;
?>
<caption>
    @if(count($items) == 1)
    {!! trans($plang_admin.'.descriptions.counter', ['number' => count($items)] )!!}
    @else
    {!! trans($plang_admin.'.descriptions.counters', ['number' => count($items)]) !!}
    @endif
</caption>
<div class="table-responsive">
<table class="table table-hover" id="tbTask">

    <thead>
        <tr style="height: 50px;">

            <!--ORDER-->
            <th style='width:{{ $withs['order'] }}'>
                {{ trans($plang_admin.'.columns.order') }}
            </th>

            <!-- NAME -->
            <?php $name = 'name' ?>
            <th class="hidden-xs" style='width:{{ $withs['name'] }}'>
                {!! trans($plang_admin.'.columns.teacher_name') !!}
            </th>

            <!-- TOTAL -->
            <?php $name = 'total' ?>
            <th class="hidden-xs" style='width:{{ $withs['total'] }}'>
                {!! trans($plang_admin.'.columns.total') !!}
            </th>

            <!-- ASSIGNED -->
            <?php $name = 'assigned' ?>
            <th class="hidden-xs" style='width:{{ $withs['assigned'] }}'>
                {!! trans($plang_admin.'.columns.assigned') !!}
            </th>

            <!-- CANCELED -->
            <?php $name = 'canceled' ?>
            <th class="hidden-xs" style='width:{{ $withs['canceled'] }}'>
                {!! trans($plang_admin.'.columns.canceled') !!}
            </th>

            <!-- DONE -->
            <?php $name = 'done' ?>
            <th class="hidden-xs" style='width:{{ $withs['done'] }}'>
                {!! trans($plang_admin.'.columns.done') !!}
            </th>

            <!-- DECLINED -->
            <?php $name = 'declined' ?>
            <th class="hidden-xs" style='width:{{ $withs['declined'] }}'>
                {!! trans($plang_admin.'.columns.declined') !!}
            </th>

            <!-- INPROGRESS -->
            <?php $name = 'inprogress' ?>
            <th class="hidden-xs" style='width:{{ $withs['inprogress'] }}'>
                {!! trans($plang_admin.'.columns.inprogress') !!}
            </th>

            <!-- PENDING -->
            <?php $name = 'pending' ?>
            <th class="hidden-xs" style='width:{{ $withs['pending'] }}'>
                {!! trans($plang_admin.'.columns.pending') !!}
            </th>

            <!-- TASKS -->
            <?php $name = 'tasks' ?>
            <th class="hidden-xs" style='width:{{ $withs['tasks'] }}'>
                {!! trans($plang_admin.'.columns.tasks') !!}
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
            <td> {!! $item['name'] !!} </td>

            <!--TOTAL-->
            <td> {!! $item['total'] !!} </td>

            <!--ASSIGNED-->
            <td> {!! $item['assigned'] !!} </td>

            <!--CANCELED-->
            <td> {!! $item['canceled'] !!} </td>

            <!--DONE-->
            <td> {!! $item['done'] !!} </td>

            <!--DECLINED-->
            <td> {!! $item['declined'] !!} </td>

            <!--IN PROGRESS-->
            <td> {!! $item['inprogress'] !!} </td>

            <!--PENDING-->
            <td> {!! $item['pending'] !!} </td>

            <!--TASKS-->
            <td> {!! $item['tasks'] !!} </td>


        </tr>
        @endforeach

    </tbody>

</table>
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
