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
$provinces = empty($provinces) ? [] : $provinces;

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

<div class="row">
    <div class="col-md-4">
        {!! Form::select('province', $provinces, $value, [  'class' => 'form-control',
                                                            'placeholder' => $placehover,
                                                            'id' => 'province'
                                                            ]) !!}
    </div>
    <div class="col-md-4">
        {!! Form::select('district', [], null, [  'class' => 'form-control',
                                                             'placeholder' => $placehover,
                                                             'id' => 'district'
                                                             ]) !!}
    </div>
    <div class="col-md-4">
        {!! Form::select('ward', [], null, [  'class' => 'form-control',
                                                     'placeholder' => $placehover,
                                                     'id' => 'ward'
                                                     ]) !!}
    </div>
</div>


<!-- CATEGORY LIST -->
@section('footer_scripts')
    @parent
    <script type='text/javascript'>

        $(document).ready(function () {

            /**
             * Province change
             */
            $('#province').change(function() {
                // Province code
                let province_code = $(this).val();
                // Get districts by province_code


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
