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

{!! Form::select('province', $items, $value, ['class' => 'form-control',  'placeholder' => $placehover]) !!}


<select id="province" name="province">
    <option value="0">Select City</option>
    <option value="1">Manchester</option>
    <option value="2">Leicester</option>
    <option value="3">Londra</option>
</select>

<select id="district" name="district">
    <option value="0" data-province-code="1">Select Street</option>
    <option value="1" data-province-code="1">Street 1</option>
    <option value="1" data-province-code="1">Street 2</option>
</select>

<select id="ward" name="ward">
    <option value="0" data-district-code="1">Select Street</option>
    <option value="1" data-district-code="1">Street 1</option>
    <option value="1" data-district-code="1">Street 2</option>
</select>


<!-- CATEGORY LIST -->
@section('footer_scripts')
    @parent
    <script type='text/javascript'>

        $(document).ready(function () {

            /**
             * Province change
             */
            $('#province').change(function() {

                $('#district option').hide();
                $('#district option[data-province-code="' + $(this).val() + '"]').show();
                // add this code to select 1'st of streets automaticaly
                // when city changed
                if ($('#district option[data-province-code="' + $(this).val() + '"]').length) {
                    $('#district option[data-province-code="' + $(this).val() + '"]').first().prop('selected', true);
                }
                    // in case if there's no corresponding street:
                // reset select element
                else {
                    $('#district').val('');
                };

                /**
                 * District change
                 */
                $('#district').change(function() {

                    $('#ward option').hide();
                    $('#ward option[data-ward-code="' + $(this).val() + '"]').show();
                    // add this code to select 1'st of streets automaticaly
                    // when city changed
                    if ($('#ward option[data-ward-code="' + $(this).val() + '"]').length) {
                        $('#ward option[data-ward-code="' + $(this).val() + '"]').first().prop('selected', true);
                    }
                        // in case if there's no corresponding street:
                    // reset select element
                    else {
                        $('#ward').val('');
                    }
                    ;
                });
            });
        });

    </script>


@endsection
