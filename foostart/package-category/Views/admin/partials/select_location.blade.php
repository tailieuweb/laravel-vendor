<!--
| TITLE
| Select single item in form
|
|-------------------------------------------------------------------------------
| REQUIRED
| $name is select name
| $items is list of items
| $label is select label
| $label is input lable
| $placehover is placehover text
| $errors is error name
| $description is description text
|
|÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷÷
| @DESCRIPTION
|
|_______________________________________________________________________________
-->

<!--DATA-->
<?php
//name
$name = empty($name) ? 'undefined' : $name;

//items
$items = empty($items) ? [] : $items;

//value
$value = empty($value) ? $request->get($name) : $value;

//label
$label = empty($label) ? '' : $label;

//place hover
$placehover = empty($placehover) ? $label : $placehover;

//eror
$errors = empty($errors) ? '' : $errors;

//description
$description = empty($description) ? '' : $description;
?>
<!--/DATA-->

<!-- CATEGORY LIST -->
@section('footer_scripts')
    @parent

    <script type="javascript">
        $('#city').change(function() {
            $('#street option').hide();
            $('#street option[value="' + $(this).val() + '"]').show();
            // add this code to select 1'st of streets automaticaly
            // when city changed
            if ($('#street option[value="' + $(this).val() + '"]').length) {
                $('#street option[value="' + $(this).val() + '"]').first().prop('selected', true);
            }
                // in case if there's no corresponding street:
            // reset select element
            else {
                $('#street').val('');
            };
        });
    </script>
@endsection
