<!------------------------------------------------------------------------------
| List of elements in company form
|------------------------------------------------------------------------------->
@if (!empty($student_id) && !empty($teacher_id))
{!! Form::open(['route'=>['internship.post_company', 'course_id' => $course_id,
                                                    'student_id' => $student_id,
                                                    'teacher_id' => $teacher_id,
                            ],  'files'=>true, 'method' => 'post'])  !!}
@else
    {!! Form::open(['route'=>['internship.post_company', 'course_id' => $course_id],  'files'=>true, 'method' => 'post'])  !!}
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
                'name' => 'company_address',
                'label' => trans($plang_admin.'.labels.internship_company_address_detail'),
                'value' => @$item->company_address,
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
    var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
        method: "GET",
        responseType: "application/json",
    };
    var promise = axios(Parameter);
    promise.then(function (result) {
        renderCity(result.data);
    });

    function renderCity(data) {
        for (const x of data) {
            citis.options[citis.options.length] = new Option(x.Name, x.Id);
        }
        citis.onchange = function () {
            district.length = 1;
            ward.length = 1;
            if(this.value != ""){
                const result = data.filter(n => n.Id === this.value);

                // for (const k of result[0].Districts) {
                //     district.options[district.options.length] = new Option(k.Name, k.Id);
                // }
                let districts = result[0].Districts;
                districts.sort((a, b) => {
                    const nameA = a.Name.toUpperCase();
                    const nameB = b.Name.toUpperCase();
                    if (nameA < nameB) {
                        return -1;
                    }
                    if (nameA > nameB) {
                        return 1;
                    }
                    return 0;
                });

                for (const k of districts) {
                    district.options[district.options.length] = new Option(k.Name, k.Id);
                }
            }
        };
        district.onchange = function () {
            ward.length = 1;
            const dataCity = data.filter((n) => n.Id === citis.value);
            if (this.value != "") {
                const dataWards = dataCity[0].Districts.filter(n => n.Id === this.value)[0].Wards;

                for (const w of dataWards) {
                    wards.options[wards.options.length] = new Option(w.Name, w.Id);
                }
            }
        };

        <?php if(!empty($item) && !empty($item->location_province)) { ?>
            citis.value = {!! $item->location_province !!};
            const event1 = new Event('change');
            citis.dispatchEvent(event1);

            districts.value = {!! $item->location_district !!};
            const event11 = new Event('change');
            districts.dispatchEvent(event11);

            wards.value = {!! $item->location_ward !!}
        <?php }else{ ?>
            citis.value = 79;
            const event2 = new Event('change');
            citis.dispatchEvent(event2);
        <?php }?>


    }




</script>
