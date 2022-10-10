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
    <script type='text/javascript'>

        $(document).ready(function () {
            var provinces = 'a';
            console.log(provinces);
        });

    </script>


@endsection
