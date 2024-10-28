<!------------------------------------------------------------------------------
| List of elements in company form
|------------------------------------------------------------------------------->
@if (!empty($student_id) && !empty($teacher_id))
{!! Form::open(['route'=>['internship.post_company', 'course_id' => $course_id,
                                                    'student_id' => $student_id,
                                                    'teacher_id' => $teacher_id,
                            ],  'files'=>true, 'method' => 'post', 'id'=> 'btn-submit-form'])  !!}
@else
    {!! Form::open(['route'=>['internship.post_company', 'course_id' => $course_id],
                            'files'=>true, 'method' => 'post',
                            'id'=> 'btn-submit-form'])  !!}
@endif

    <!--BUTTONS-->
    <div class='btn-form'>
        <!-- SAVE BUTTON -->
            {!! Form::submit(trans($plang_admin.'.buttons.save'), array("class"=>"btn btn-info pull-right ")) !!}
        <!-- /SAVE BUTTON -->
    </div>
    <!--/BUTTONS-->

    <!--TAB MENU-->
    <ul class="nav nav-tabs">
        <!--MENU 1-->
        <li class="active">
            <a data-toggle="tab" href="#menu_1_company_require">
                {!! trans($plang_admin.'.tabs.menu_1_company_require') !!}
            </a>
        </li>
        <!--OTHER-->
        <li>
            <a data-toggle="tab" href="#menu_2_company_other">
                {!! trans($plang_admin.'.tabs.menu_2_company_other') !!}
            </a>
        </li>
    </ul>
    <!--/TAB MENU-->

    <!--TAB CONTENT-->
    <div class="tab-content">

        <!--MENU 1-->
        <div id="menu_1_company_require" class="tab-pane fade in active">


            <div class="row">
                <div class="col-md-6">
                    <!--STUDENT CLASS-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'student_class',
                        'label' => trans($plang_admin.'.labels.student_class'),
                        'value' => @$item->student_class,
                        'description' => trans($plang_admin.'.descriptions.student_class'),
                        'errors' => $errors,
                    ])
                    <!--/NAME-->
                </div>
                <div class="col-md-6">
                    <!--STUDENT PHONE-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'student_phone',
                        'label' => trans($plang_admin.'.labels.student_phone'),
                        'value' => @$item->student_phone,
                        'description' => trans($plang_admin.'.descriptions.student_phone'),
                        'errors' => $errors,
                    ])
                    <!--/NAME-->
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <!--NAME-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'company_name',
                        'label' => trans($plang_admin.'.labels.internship_company_name'),
                        'value' => @$item->company_name,
                        'description' => trans($plang_admin.'.descriptions.internship_company_name'),
                        'errors' => $errors,
                    ])
                    <!--/NAME-->
                </div>
                <div class="col-md-6">
                    <!--STATUS-->
                    @include('package-category::admin.partials.radio', [
                        'name' => 'status',
                        'label' => trans($plang_admin.'.labels.company_status'),
                        'value' => @$item->status,
                        'description' => trans($plang_admin.'.descriptions.company_status'),
                        'items' => ['1' => 'Chính thức', '2' => 'Dự kiến']
                    ])
                </div>
            </div>

            <!--SITE SLUG-->
            @include('package-category::admin.partials.input_slug', [
                'name' => 'company_slug',
                'id' => 'company_slug',
                'ref' => 'company_name',
                'label' => trans($plang_admin.'.labels.slug'),
                'value' => @$item->company_slug,
                'description' => trans($plang_admin.'.descriptions.slug'),
                'errors' => $errors,
                'hidden' => true,
            ])
            <!--/SITE SLUG-->

            <!--SITE SLUG-->
            @include('package-category::admin.partials.input_slug', [
                'name' => 'course_id',
                'id' => 'course_id',
                'value' => @$item->course_id,
                'hidden' => true,
            ])
            <!--/SITE SLUG-->

            <div class="row">
                <div class='col-md-6'>
                    <!--CATEGORY ID-->
                    @include('package-category::admin.partials.select_single', [
                        'name' => 'category_id',
                        'label' => trans($plang_admin.'.labels.internship_category_id'),
                        'value' => @$item->category_id,
                        'items' => $categories,
                        'description' => trans($plang_admin.'.descriptions.internship_category_id'),
                    ])
                    <!--/CATEGORY ID-->
                </div>

                <div class="col-md-6">
                    <!--COMPANY PHONE-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'company_phone',
                        'label' => trans($plang_admin.'.labels.internship_company_phone'),
                        'value' => @$item->company_phone,
                        'description' => trans($plang_admin.'.descriptions.internship_company_phone'),
                        'errors' => $errors,
                    ])
                    <!-- /COMPANY PHONE-->
                </div>
            </div>

            <div class="row">
                <div class='col-md-6'>
                    <!--COMPANY INSTRUCTOR-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'company_instructor',
                        'label' => trans($plang_admin.'.labels.internship_company_instructor'),
                        'value' => @$item->company_instructor,
                        'description' => trans($plang_admin.'.descriptions.internship_company_instructor'),
                        'errors' => $errors,
                    ])
                    <!-- /COMPANY INSTRUCTOR-->
                </div>

                <div class='col-md-6'>
                    <!--COMPANY INSTRUCTOR PHONE-->
                    @include('package-category::admin.partials.input_text', [
                        'name' => 'company_instructor_phone',
                        'label' => trans($plang_admin.'.labels.internship_company_instructor_phone'),
                        'value' => @$item->company_instructor_phone,
                        'description' => trans($plang_admin.'.descriptions.internship_company_instructor_phone'),
                        'errors' => $errors,
                    ])
                    <!-- /COMPANY INSTRUCTOR-->
                </div>
            </div>

            <!--ADDRESS-->
            <div class="row form-group">
                <div class="col-md-12">
                    <label for="company_address">Địa chỉ công ty</label>
                </div>
                <div class="form-group">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">
                                Tỉnh/Thành phố
                            </span>
                            {!! Form::select('location_province', [], null, ['class' => 'form-control',
                                                                            'id' => 'city',
                                                                            'placeholder' => 'Chọn tỉnh/thành phố']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">
                                Quận/Huyện
                            </span>
                            {!! Form::select('location_district', [], null, ['class' => 'form-control',
                                                                             'id' => 'district',
                                                                             'placeholder' => 'Chọn quận/huyện']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">
                                Xã/Phường
                            </span>
                            {!! Form::select('location_ward', [], null, ['class' => 'form-control',
                                                                             'id' => 'ward',
                                                                             'placeholder' => 'Chọn xã/phường']) !!}
                        </div>
                    </div>
                </div>
            </div>
            @include('package-category::admin.partials.input_text', [
                'name' => 'street',
                'label' => trans($plang_admin.'.labels.internship_company_address_detail'),
                'value' => @$item->street,
                'description' => trans($plang_admin.'.descriptions.internship_company_address_detail'),
                'errors' => $errors,
            ])
            <!-- /ADDRESS-->

        </div>
        <!--/END MENU1-->
        <!--OTHER-->
        <div id="menu_2_company_other" class="tab-pane fade">

            <div class="row">
                <div class='col-md-6'>
                    <!--WEBSITE-->
                @include('package-category::admin.partials.input_text', [
                    'name' => 'company_website',
                    'label' => trans($plang_admin.'.labels.internship_company_website'),
                    'value' => @$item->company_website,
                    'description' => trans($plang_admin.'.descriptions.internship_company_website'),
                    'errors' => $errors,
                ])
                <!-- /WEBSITE-->
                </div>

                <div class="col-md-6">
                    <!--COMPANY TAX CODE-->
                @include('package-category::admin.partials.input_text', [
                    'name' => 'company_tax_code',
                    'label' => trans($plang_admin.'.labels.internship_company_tax_code'),
                    'value' => @$item->company_tax_code,
                    'description' => trans($plang_admin.'.descriptions.internship_company_tax_code'),
                    'errors' => $errors,
                ])
                <!-- /COMPANY TAX CODE-->
                </div>
            </div>
            <!--DESCRIPTION-->
            @include('package-category::admin.partials.textarea', [
                'name' => 'company_description',
                'label' => trans($plang_admin.'.labels.internship_company_description'),
                'value' => @$item->company_description,
                'description' => trans($plang_admin.'.descriptions.internship_company_description'),
                'rows' => 25,
                'tinymce' => true,
                'errors' => $errors,
            ])
        <!--/DESCRIPTION-->
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
| End list of elements in company form
|------------------------------------------------------------------------------>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var wards = document.getElementById("ward");

    axios.get('/api/provinces')
        .then(function (result) {
            renderCity(result.data);
        });

    function renderCity(data) {
        // Provinces
        for (const x of data.data) {
            citis.options[citis.options.length] = new Option(x.name, x.code);
        }

        // On change
        citis.onchange = function () {
            districts.length = 1;
            wards.length = 1;
            if(this.value != ""){
                axios.get(`/api/districts?province_code=${this.value}`)
                    .then(function (result) {
                        const list_districts = result.data;
                        for (const k of list_districts.data) {
                            districts.options[districts.options.length] = new Option(k.full_name, k.code);
                        }
                    });
            }
        };

        districts.onchange = function () {
            wards.length = 1;
            if (this.value != "") {
                axios.get(`/api/wards?district_code=${this.value}`)
                    .then(function (result) {
                        const wardsData = result.data;
                        for (const w of wardsData.data) {
                            wards.options[wards.options.length] = new Option(w.full_name, w.code);
                        }
                    });
            }
        };

        citis.value = 79;
        const event2 = new Event('change');
        citis.dispatchEvent(event2);

    }

</script>


<script type="text/javascript">
    $(document).ready(function () {
        $('#btn-submit-form').on( "submit", function( event ) {
            var city = $( "#city option:selected" ).text();
            var district = $( "#district option:selected" ).text();
            var ward = $( "#ward option:selected" ).text();
            var street = $('#street').val();
            var address = street + ', ' + ward + ', ' + district + ', ' + city;

            var input = $("<input>")
                .attr("type", "hidden")
                .attr("name", "company_address").val(address);

            $('#btn-submit-form').append(input);
        });
    });
</script>
