<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title bariol-thin"><i class="fa fa-search"></i>
            <?php echo trans($plang_admin.'.labels.title-search-site') ?>
        </h3>
    </div>
    <div class="panel-body">

        {!! Form::open(['route' => 'crawler.site.list','method' => 'get']) !!}

            <!--BUTTONS-->
            <div class="form-group">
                <a href="{!! URL::route('crawler.site.list', ['context' => @$params['context']]) !!}" class="btn btn-default search-reset">
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

            <!-- SITE TYPE -->
            @include('package-category::admin.partials.select_single', [
                'name' => 'site_type',
                'label' => trans($plang_admin.'.form.site_type'),
                'value' => @$params['site_type']?$params['site_type']:'0',
                'items' => $siteTypeSelect,
            ])

            <!-- STATUS -->
            @include('package-category::admin.partials.select_single', [
                'name' => 'status',
                'label' => trans($plang_admin.'.form.status'),
                'value' => @$params['status']?$params['status']:'99',
                'items' => $status,
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
