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
            let url_get_districts = '{{env('APP_URL')}}/api/location/districts';
            let url_get_wards = '{{env('APP_URL')}}/api/location/wards';
            /**
             * Province change
             */
            $('#province').change(function() {
                // Province code
                let province_code = $(this).val();
                // Get districts by province_code
                $.ajax({
                    url: url_get_districts + '/' + $(this).val(),
                    cache: false,
                    type: "GET",
                    success: function(response) {
                        if (response.status == 200) {
                            var $el = $('#district');
                            $el.empty(); // remove old options
                            $el.append($("<option></option>")
                                .attr("value", '').text('Choose district'));

                            // for each set of data, add a new option
                            $.each(response.data, function(index, value) {
                                $el.append($("<option></option>")
                                    .attr("value", value.district_code).text(value.district_name));
                            });
                        }
                    },
                    error: function(xhr) {

                    }
                });

                /**
                 * District change
                 */
                $('#district').change(function() {
                    // District code
                    let district_code = $(this).val();
                    // Get wards by district_code
                    $.ajax({
                        url: url_get_wards + '/' + $(this).val(),
                        cache: false,
                        type: "GET",
                        success: function(response) {
                            if (response.status == 200) {
                                var $el = $('#ward');
                                $el.empty(); // remove old options
                                $el.append($("<option></option>")
                                    .attr("value", '').text('Choose a ward'));

                                // for each set of data, add a new option
                                $.each(response.data, function(index, value) {
                                    $el.append($("<option></option>")
                                        .attr("value", value.ward_code).text(value.ward_name));
                                });
                            }
                        },
                        error: function(xhr) {

                        }
                    });
                });
            });
        });

    </script>
@endsection
