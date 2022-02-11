<!------------------------------------------------------------------------------
| List of elements in task form
|------------------------------------------------------------------------------->

{!! Form::open(['route'=>['task.post', 'id' => @$item->id],  'files'=>true, 'method' => 'post'])  !!}

<!--BUTTONS-->
<div class='btn-form'>
    <!-- DELETE BUTTON -->
    @if($item)
    <a href="{!! URL::route('task.delete',['id' => @$item->id, '_token' => csrf_token()]) !!}"
       class="btn btn-danger pull-right margin-left-5 delete">
        {!! trans($plang_admin.'.buttons.delete') !!}
    </a>
    @endif
    <!-- DELETE BUTTON -->

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
            {!! trans($plang_admin.'.tabs.menu_1') !!}
        </a>
    </li>

    <!--MENU 2-->
    <li>
        <a data-toggle="tab" href="#menu_2">
            {!! trans($plang_admin.'.tabs.menu_2') !!}
        </a>
    </li>

    <!--MENU 3-->
    <li>
        <a data-toggle="tab" href="#menu_3">
            {!! trans($plang_admin.'.tabs.menu_3') !!}
        </a>
    </li>

    <!--MENU 4-->
    <li>
        <a data-toggle="tab" href="#menu_4">
            {!! trans($plang_admin.'.tabs.menu_4') !!}
        </a>
    </li>

</ul>
<!--/TAB MENU-->

<!--TAB CONTENT-->
<div class="tab-content">

    <!--MENU 1-->
    <div id="menu_1" class="tab-pane fade in active">

        <!--TASK NAME-->
        @include('package-category::admin.partials.input_text', [
            'name' => 'task_name',
            'label' => trans($plang_admin.'.labels.name'),
            'value' => @$item->task_name,
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
            'value' => @$item->task_slug,
            'description' => trans($plang_admin.'.descriptions.slug'),
            'errors' => $errors,
            'hidden' => true,
        ])
        <!--/TASK SLUG-->

        <div class="row">
            <div class="col-md-6">
                <!--STATUS-->
                @include('package-category::admin.partials.select_single', [
                    'name' => 'status',
                    'label' => trans($plang_admin.'.form.status'),
                    'value' => @$item->status,
                    'items' => $status,
                    'description' => trans($plang_admin.'.descriptions.status'),
                ])
            </div>
            <div class="col-md-6">
                <!-- LIST OF CATEGORIES -->
                @include('package-category::admin.partials.select_single', [
                    'name' => 'category_id',
                    'label' => trans($plang_admin.'.labels.category'),
                    'items' => $categories,
                    'value' => @$item->category_id,
                    'description' => trans($plang_admin.'.descriptions.category', [
                    'href' => URL::route('categories.list', ['_key' => $context->context_key])
                    ]),
                    'errors' => $errors,
                ])
                <!-- /LIST OF CATEGORIES -->
            </div>
        </div>

    </div>

    <!--MENU 2-->
    <div id="menu_2" class="tab-pane fade">
        <!--SAMPLE OVERVIEW-->
        @include('package-category::admin.partials.textarea', [
        'name' => 'task_overview',
        'label' => trans($plang_admin.'.labels.overview'),
        'value' => @$item->task_overview,
        'description' => trans($plang_admin.'.descriptions.overview'),
        'tinymce' => false,
        'errors' => $errors,
        ])
        <!--/SAMPLE OVERVIEW-->

        <!--SAMPLE DESCRIPTION-->
        @include('package-category::admin.partials.textarea', [
        'name' => 'task_description',
        'label' => trans($plang_admin.'.labels.description'),
        'value' => @$item->task_description,
        'description' => trans($plang_admin.'.descriptions.description'),
        'rows' => 50,
        'tinymce' => true,
        'errors' => $errors,
        ])
        <!--/SAMPLE DESCRIPTION-->
    </div>

    <!--MENU 3-->
    <div id="menu_3" class="tab-pane fade">
        <!--SAMPLE IMAGE-->
        @include('package-category::admin.partials.input_image', [
        'name' => 'task_image',
        'label' => trans($plang_admin.'.labels.image'),
        'value' => @$item->task_image,
        'description' => trans($plang_admin.'.descriptions.image'),
        'errors' => $errors,
        ])
        <!--/SAMPLE IMAGE-->

        <!--SAMPLE FILES-->
        @include('package-category::admin.partials.input_files', [
        'name' => 'files',
        'label' => trans($plang_admin.'.labels.files'),
        'value' => @$item->task_files,
        'description' => trans($plang_admin.'.descriptions.files'),
        'errors' => $errors,
        ])
        <!--/SAMPLE FILES-->
    </div>

    <!--MENU 4-->
    <div id="menu_4" class="tab-pane fade">
        <div class="row">
            <div class="col-md-4">
                <!--Invite member-->
                @include('package-category::admin.partials.select_single', [
                    'name' => 'invite_member',
                    'label' => trans($plang_admin.'.labels.invite_member'),
                    'items' => @$members,
                    'description' => trans($plang_admin.'.descriptions.invite_member'),
                    'errors' => $errors,
                ])
                <!--/Invite member-->
            </div>
            <div class="col-md-8">
                <div class="btn-button-member-assignee" style="padding: 25px">
                    <!-- Add member -->
                    <span class="btn btn-primary pull-left margin-left-5 add_member">
                        {!! trans($plang_admin.'.buttons.add_member') !!}
                    </span>

                    <!-- Add all -->
                    <span class="btn btn-success pull-left margin-left-5 add_all_members">
                        {!! trans($plang_admin.'.buttons.add_all_member') !!}
                    </span>

                    <!-- Reset all -->
                    <span class="btn btn-warning pull-left margin-left-5 reset_invited">
                        {!! trans($plang_admin.'.buttons.reset_invited') !!}
                    </span>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @if(!empty($invitedMembers))
                    <span>Invited members: {{count($invitedMembers)}}</span>
                    <table class="table table-hover invited-members">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Member</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--item template-->
                            <tr class="item-template invited-member">
                                <td class="member-counter"></td>
                                <td class="member-info">
                                    <input type="hidden" name="invited_member_id[]">
                                    <span class="member-name"></span>
                                </td>
                                <td class="delete-member">
                                    <a href="javascript:;" class="trash">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <span>No invited members</span>
                @endif
            </div>
        </div>

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

        $(document).ready(function () {
            (function ($) {
                //All members
                var members = <?php echo json_encode($members) ?>;
                //Invited members
                var invitedMembers = <?php echo json_encode($invitedMembers) ?>;
                displayInvitedMembers();

                //Add event click deleting item
                $('.invited-member .delete-member').click(function () {
                    //Get member id
                    var member_id = $(this).parent().find('input').val();
                    if (invitedMembers.hasOwnProperty(member_id)) {
                        delete invitedMembers[member_id];
                        displayInvitedMembers();
                    }

                    return false;
                });

                //Add new member
                $('.add_member').click(function() {
                    var member_id = $('#invite_member').find(":selected").val();
                    var member_name = $('#invite_member').find(":selected").text();

                    if ($.isNumeric(member_id) && !invitedMembers.hasOwnProperty(member_id)) {
                        invitedMembers[member_id] = member_name;
                        displayInvitedMembers();
                    }

                });
                //Add all members
                $('.add_all_members').click(function() {
                    //Set all members to invited
                    invitedMembers = JSON.parse(JSON.stringify(members));
                    //Display
                    displayInvitedMembers();
                });
                //Reset invited
                $('.reset_invited').click(function (){
                    invitedMembers = {};
                    displayInvitedMembers();
                });

                function displayInvitedMembers() {
                    //Empty table invited members
                    var item = $('.invited-members' ).find('.item-template').clone(true);
                    $('.invited-members tbody').empty();
                    item.appendTo($('.invited-members tbody'));

                    //Display invited members
                    var counter = 1;

                    $.each( invitedMembers, function( id, name ) {
                        var item = $('.invited-members' ).find('.item-template').clone(true).removeClass('item-template');
                        item.find('.member-counter').html(counter);
                        item.find('input').val(id);
                        item.find('.member-name').html(name);
                        //append to last item
                        item.appendTo($('.invited-members tbody'));

                        counter++;

                    });

                }

            })(jQuery);
        });

    </script>
@endsection
