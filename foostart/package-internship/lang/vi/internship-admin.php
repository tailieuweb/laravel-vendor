<?php

return [

    /*
    |-----------------------------------------------------------------------
    | MAIN MENU
    |-----------------------------------------------------------------------
    | Top menu
    |
    */
    'menus' => [
        'top-menu' => 'Internship'
    ],





    /*
    |-----------------------------------------------------------------------
    | SIDEBAR
    |-----------------------------------------------------------------------
    | Left side bar
    |
    |
    |
    */
    'sidebar' => [
        'list' => 'Items',
        'list_internship_courses' => 'Báo cáo thực tập',
        'internship_diary_add' => 'Add',
        'internship_diary_list' => 'Diary',
        'add' => 'Add new',
        'trash' => 'Trash',
        'config' => 'Configurations',
        'lang' => 'Languages',
        'category' => 'Categories',
        'job' => 'Jobs',
        'sample' => 'Sample',
        'list_companies' => 'Companies',
        'list_patterns' => 'Patterns',
        'add_pattern' => 'New pattern',
        'tags' => 'Tags',
        'questions' => 'Questions',
        'list_jobs' => 'Jobs',
        'list_categories' => 'Categories',
        'list_courses' => 'Courses',
    ],





    /*
    |-----------------------------------------------------------------------
    | Table column
    |-----------------------------------------------------------------------
    | The list of columns in table
    |
    */
    'columns' => [
        'order' => 'Order',
        'diary_operations' => 'Thao tác',
        'internship_company_name' => 'Công ty thực tập',
        'internship_diary' => 'Nhật ký thực tập',
        'internship_course_name' => 'Môn học',
        'start_date' => 'Ngày đầu tuần',
        'end_date' => 'Ngày cuối tuần',
        'course_name' => 'Course name',
        'week' => 'Tuần',
        '#' => '#',
        'counter' => '#',
        'id' => 'Id',
        'name' => 'Crawler name',
        'operations' => 'Operations',
        'updated_at' => 'Updated at',
        'filename' => 'File name',
        'status'    => 'Status',
        'user_id_assigner' => 'User ID Assigner',
        'answer' => 'Answer',
        'title' => 'Title',
        'email' => 'Email',
        'message' => 'Message',
        'internship_name' => 'Site name',
        'pattern_name' => 'Pattern name',
        'machine_name' => 'Machine name',
        'regular_expression_value' => 'Value',
        'view_pattern' => 'Patterns',
        'num_questions' => 'Questions',
        'tag_name' => 'Tag name',
        'tag_num_questions' => 'Questions',
        'question_name' => 'Question name',
        'question_description' => 'Question description',
        'answer_description' => 'Answer description',
        'job_name' => 'Job name',
        'category_name' => 'Category name',
    ],


    /*
    |-----------------------------------------------------------------------
    | Pages
    |-----------------------------------------------------------------------
    | Pages
    |
    */
    'pages' => [
        'title-list' => 'List of companies',
        'internship-company-title-edit' => 'Thông tin công ty thực tập',
        'internship-company-title-add' => 'Thông tin công ty thực tập',
        'title-list' => 'List of companies',
        'title-internship-course' => 'Danh sách môn thực tập',
        'title-course' => 'List of courses',
        'title-list-search-diary' => 'Nhật ký thực tập',
        'internship-title-diary' => 'Nhật ký thực tập',
        'title-list-pattern' => 'List of patterns',
        'title-list-search' => 'Search results',
        'title-list-pattern-search' => 'Search results',
        'title-edit' => 'Edit internship',
        'title-add' => 'Add new internship',
        'title-delete' => 'Delete internship',
        'title-config' => 'Current configurations',
        'title-lang' => 'Manage list of languages',
        'title-internship' => 'List of companies',
        'title-pattern' => 'List of patterns',
        'title-list-search-internship' => 'Search companies',
        'title-list-search-pattern' => 'Search patterns',
        'title-edit-tag' => 'Edit tag',
        'title-questions' => 'List of questions',
        'title-edit-question' => 'Edit questions',
        'title-list-search-answers' => 'Search answers',
        'title-edit-answer' => 'Edit answer',
        'title-jobs' => 'List of jobs',
        'title-list-search-jobs' => 'Search jobs',
        'title-list-edit-job' => 'Edit job',
        'title-edit-job' => 'Edit job',
        'title-categories' => 'List of categories',
        'title-list-search-categories' => 'Search categories',
        'title-list-edit-category' => 'Edit category',
        'title-edit-category' => 'Edit category',
        'title-categories' => 'List of categories',
        'title-list-pattern' => 'List of patterns',

    ],





    /*
    |-----------------------------------------------------------------------
    | Button
    |-----------------------------------------------------------------------
    | The list of buttons
    |
    */
    'buttons' => [
        'search' => 'Search',
        'diary_add' => 'Thêm mới báo cáo tuần',
        'reset' => 'Resest',
        'add' => 'Add',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete-in-trash' => 'In trash',
        'delete-forever' => 'Forever',
        'sent' => 'Sent',
        'crawl_tag' => 'Crawl tag',
        'crawl_question' => 'Crawl question',
        'crawl_answer' => 'Crawl answer',
        'restore' => 'Restore',
        'export' => 'Export',
    ],





    /*
    |-----------------------------------------------------------------------
    | Form
    |-----------------------------------------------------------------------
    | The list of elements in form
    |
    |
    */
    'form' => [
        'keyword' => 'Keyword',
        'category_id' => 'Category',
        'sorting' => 'Sorting',
        'no-selected' => 'No selected',
        'status' => 'Status',
        'internship_id' => 'Site',
        'internship' => 'Site',
        'internship_type' => 'Site type',
    ],





    /*
    |-----------------------------------------------------------------------
    | Description
    |-----------------------------------------------------------------------
    | Description
    |
    */
    'descriptions' => [
        'form' => 'Crawler form',
        'student_class' => 'Lớp sinh viên, ví dụ: CD19TT3, CD19TT1, CD19TT2, ...',
        'student_phone' => 'Số điện thoại của sinh viên, ví dụ: 0912345678, ...',
        'internship_company_tax_code' => 'Thông tin mã số thuế của công ty',
        'internship_company_website' => 'Địa chỉ website của công ty',
        'internship_company_description' => 'Mô tả sơ lược về công ty thực tập',
        'internship_company_image' => 'Hình đại diện công ty thực tập',
        'internship_company_name' => 'Tên chính xác công ty thực tập chính thức hoặc dự kiến thực tập. Sinh viên có thể làm đơn thay đổi công ty thực tập sau này',
        'internship_company_status' => 'Xác nhận đây là công ty chính thức đi thực tập hay công ty dự kiến thực tập',
        'internship_company_address' => 'Nhập địa chỉ chính xác công ty thực tập (số nhà, đường, phường, quận, thành phố)',
        'internship_company_address_detail' => 'Nhập địa chỉ chính xác công ty thực tập (số nhà, đường)',
        'internship_category_id' => 'Lĩnh vực kinh doanh của công ty thực tập',
        'internship_company_phone' => 'Số điện thoại của công ty thực tập, KHÔNG được phép để số tổng đài phục vụ của công ty (ví dụ: 1900123)',
        'internship_company_instructor' => 'Họ và tên người hướng dẫn thực tập tại công ty',
        'internship_company_instructor_phone' => 'Số điện thoại của người hướng dẫn thực tập tại công ty',
        'diary_mon' => 'Nhập thông tin công việc được giao, nội dung đã thực hiện, nhận xét của người hướng dẫn ',
        'diary_tue' => 'Nhập thông tin công việc được giao, nội dung đã thực hiện, nhận xét của người hướng dẫn ',
        'diary_wed' => 'Nhập thông tin công việc được giao, nội dung đã thực hiện, nhận xét của người hướng dẫn ',
        'diary_thu' => 'Nhập thông tin công việc được giao, nội dung đã thực hiện, nhận xét của người hướng dẫn ',
        'diary_fri' => 'Nhập thông tin công việc được giao, nội dung đã thực hiện, nhận xét của người hướng dẫn ',
        'diary_sat' => 'Nhập thông tin công việc được giao, nội dung đã thực hiện, nhận xét của người hướng dẫn ',
        'diary_start_date' => 'Nhập ngày đầu tuần theo định dạng dd/mm/yyy. Ví dụ 13/11/2021',
        'diary_end_date' => 'Nhập ngày cuối tuần theo định dạng dd/mm/yyy. Ví dụ 13/11/2021',
        'form' => 'Crawler form',
        'diary_form' => 'Nhật ký thực tập trong tuần',
        'company_form' => 'Cập nhật thông tin công ty',
        'company_image' => 'Company image',
        'internship_address' => 'Internship address',
        'category_id' => 'Category',
        'update' => 'Update crawler',
        'name' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'category' => 'Click <a href=":href">here</a> to manage list of categories by token.',
        'overview' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'image' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'files' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'list' => 'List of items',
        'counters' => 'There are <b>:number</b> items',
        'counter' => 'There is <b>:number</b> item',
        'not-found' => 'Not found items',
        'config' => 'List of configurations',
        'lang' => 'List of languages',
        'status' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'member'    => 'Search member',
        'email'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'message'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'answer'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'title'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'internship_name' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'internship_url' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'internship_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'internship_form' => 'Internship form',
        'internship_id' => 'Internship ID',
        'internship_image' => 'Internship image',
        'pattern_name' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'pattern_machine_name' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'pattern_form' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'regular_expression' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'tag_form' => 'Tag form',
        'tag_name' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'tag_url' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'tag_overview' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'tag_other' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'tag_num_questions' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'question_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'question_form' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'answer_url_user' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'answer_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'answer_form' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'category_form' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'job_name' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'job_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'job_requirements' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'job_url' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'job_name' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'category_name' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'category_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'category_url' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'category_name' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'slug' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'internship_type' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'pattern_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'job_overview' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'internship_website' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'company_name' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'company_status' => '',
        'company_website' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'company_address' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'company_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
    ],



    /*
    |-----------------------------------------------------------------------
    | Error
    |-----------------------------------------------------------------------
    | Show error message
    |
    |
    |
    */
    'errors' => [
        'required' => ':attribute is required',
        'required_length' => '<b> :attribute </b> allows from: <b>:minlength</b> to <b>:maxlength</b> characters.',
        'required_min_length' =>'<b> :attribute </b> yêu cầu từ <b>:minlength</b>  đến <b>:maxlength</b> ký tự',
        'company_name_required_min_length' =>'<b> Tên công ty </b> yêu cầu từ <b>:minlength</b>  đến <b>:maxlength</b> ký tự',
        'category_id_required' => 'Danh mục công ty yêu cầu nhập',
        'student_class_required' => 'Tên lớp học yêu cầu nhập',
        'student_phone_required' => 'Số điện thoại của sinh viên yêu cầu nhập',
        'student_phone_regex' => 'Số điện thoại yêu cầu nhập hợp lệ (10 hoặc 11 số)',
        'student_phone_max_string' => 'Số điện thoại yêu cầu nhập hợp lệ (10 hoặc 11 số)',
        'company_name_required' => 'Danh mục công ty yêu cầu nhập',
        'company_phone_required' => 'Số điện thoại công ty yêu cầu nhập',
        'company_phone_regex' => 'Số điện thoại yêu cầu nhập hợp lệ (10 hoặc 11 số)',
        'company_phone_max_string' => 'Số điện thoại yêu cầu nhập hợp lệ (10 hoặc 11 số)',
        'company_instructor_required' => 'Người hướng dẫn tại công ty yêu cầu nhập',
        'company_instructor_phone_required' => 'Số điện thoại người hướng dẫn tại công ty yêu cầu nhập',
        'company_instructor_phone_regex' => 'Số điện thoại yêu cầu nhập hợp lệ (10 hoặc 11 số)',
        'company_instructor_phone_max_string' => 'Số điện thoại yêu cầu nhập hợp lệ (10 hoặc 11 số)',
        'company_address_required' => 'Địa chỉ công ty yêu cầu nhập',
        'diary_start_date_required' => 'Ngày đầu tuần yêu cầu nhập',
        'diary_end_date_required' => 'Ngày cuối tuần yêu cầu nhập',
    ],




    /*
    |-----------------------------------------------------------------------
    | FIELDS
    |-----------------------------------------------------------------------
    | Column name in table
    |
    |
    |
    */
    'fields' => [
        'id' => 'ID',
        'name' => 'Crawler name',
        'description' => 'Crawler description',
        'overview' => 'Crawler overview',
        'slug' => 'Slug',
        'updated_at' => 'Updated at',
        'user-id'   => 'ID',
        'last-name' => 'Last name',
        'first-name'    => 'First name',
        'status' => 'Status',
        'title' => 'Title',
        'internship-name' => 'Name',
        'internship-pattern' => 'Pattern',
        'internship_id' => 'ID',
        'tag_name' => 'Tag name',
        'tag_url' => 'Tag url',
        'question_name' => 'Question name',
        'job_name' => 'Job name',
        'category_id' => 'Category ID',
        'category_name' => 'Category name',
        'internship_name' => 'Internship name',
        'pattern_name' => 'Pattern name',
        'pattern_machine_name' => 'Pattern name',

    ],




    /*
    |-----------------------------------------------------------------------
    | LABLES
    |-----------------------------------------------------------------------
    | The lables of element in form
    |
    |
    |
    */
    'labels' => [
        'name' => 'Internship name',
        'student_class' => 'Lớp sinh viên',
        'student_phone' => 'Số điện thoại',
        'internship_company_website' => 'Địa chỉ website',
        'internship_company_tax_code' => 'Mã số thuế',
        'internship_company_description' => 'Mô tả sơ lược về công ty',
        'internship_company_image' => 'Ảnh đại diện công ty',
        'internship_company_name' => 'Tên công ty thực tập',
        'internship_company_address' => 'Địa chỉ công ty',
        'internship_company_address_detail' => 'Số nhà, đường phố',
        'internship_category_id' => 'Lĩnh vực hoạt động',
        'internship_company_phone' => 'Số điện thoại công ty',
        'internship_company_instructor' => 'Người hướng dẫn thực tập tại công ty',
        'internship_company_instructor_phone' => 'Số điện thoại người hướng dẫn',
        'diary_mon' => 'Nhật ký thực tập thứ 2',
        'diary_tue' => 'Nhật ký thực tập thứ 3',
        'diary_wed' => 'Nhật ký thực tập thứ 4',
        'diary_thu' => 'Nhật ký thực tập thứ 5',
        'diary_fri' => 'Nhật ký thực tập thứ 6',
        'diary_sat' => 'Nhật ký thực tập thứ 7',
        'diary_start_date' => 'Ngày đầu tuần',
        'diary_end_date' => 'Ngày cuối tuần',
        'company_phone' => 'Company phone',
        'company_instructor_phone' => 'Company instructor phone',
        'company_tax_code' => 'Company tax code',
        'company_image' => 'Company name',
        'company_instructor' => 'Company instructor',
        'title-search-company' => 'Search company',
        'company_name' => 'Company name',
        'company_status' => 'Xác nhận công ty thực tập',
        'company_website' => 'Company website',
        'company_address' => 'Company address',
        'company_description' => 'Company description',
        'internship_address' => 'Internship address',
        'overview' => 'Crawler overview',
        'description' => 'Crawler description',
        'image' => 'Crawler image',
        'files' => 'Crawler files',
        'category' => 'Category name',
        'title-search' => 'Search crawler',
        'title-categories' => 'Search categories',
        'title-search-internship' => 'Search companies',
        'title-search-pattern' => 'Search patterns',
        'internship-search' => 'Search internship',
        'title-backup' => 'Backups',
        'config' => 'Configurations',
        'crawler-status'    => 'Status',
        'assigner'        => 'Add assigner',
        'search'        => 'Search User Data',
        'total-data'    => 'Total Data :',
        'email'        => 'Email',
        'message'        => 'Message',
        'answer'        => 'Answer',
        'title'        => 'Title',
        'phone' => 'Phone',
        'internship_name' => 'Internship name',
        'internship_url' => 'Internship url',
        'internship_image' => 'Internship image',
        'internship_description' => 'Internship description',
        'pattern_name' => 'Pattern name',
        'pattern_machine_name' => 'Pattern machine name',
        'pattern_description' => 'Pattern description',
        'regular_expression' => 'Regular expression',
        'tag_name' => 'Tag name',
        'tag_url' => 'Tag URL',
        'tag_overview' => 'Tag overview',
        'tag_other' => 'Tag other',
        'tag_num_questions' => 'Number questions',
        'title-search-tag' => 'Search tags',
        'unknown' => 'Unknown',
        'title-search-question' => 'Search questions',
        'question_name' => 'Question name',
        'question_url' => 'Question URL',
        'question_description' => 'Question description',
        'question_url_user' => 'URL user',
        'title-search-answer' => 'Search answers',
        'answer_url_user' => 'URL user',
        'answer_description' => 'Description',
        'title-search-answer' => 'Search answers',
        'id' => 'ID',
        'category_id' => 'ID',
        'title-search-jobs' => 'Search jobs',
        'job_name' => 'Job name',
        'job_url' => 'Job url',
        'job_description' => 'Job description',
        'job_requirements' => 'Job requirements',
        'category_name' => 'Category name',
        'category_url' => 'Category url',
        'category_description' => 'Category description',
        'title-search-categories' => 'Search categories',
        'category_overview' => 'Category overview',
        'slug' => 'Internship slug',
        'job_overview' => 'Job overview',
        'internship_website' => 'Website',
        'category_id' => 'Category',
    ],





    /*
    |-----------------------------------------------------------------------
    | TABS
    |-----------------------------------------------------------------------
    | The name of tab
    |
    |
    |
      */
    'tabs' => [
        'menu_1_date' => 'Tuần thực tập',
        'menu_2_mon' => 'Thứ 2',
        'menu_3_tue' => 'Thứ 3',
        'menu_4_wed' => 'Thứ 4',
        'menu_5_thu' => 'Thứ 5',
        'menu_6_fri' => 'Thứ 6',
        'menu_7_sat' => 'Thứ 7',
        'menu-8' => 'Menu 8',
        'menu-9' => 'Menu 9',
        'menu-9' => 'Menu 9',
        'guide'  => 'Guide',
        'other'  => 'Other',
        'basic'  => 'Basic',
        'advance' => 'Advance',
        'menu_1_company_require' => 'Thông tin bắt buộc',
        'menu_2_company_other' => 'Thông tin thêm',
    ],





    /*
    |-----------------------------------------------------------------------
    | HEADING
    |-----------------------------------------------------------------------
    |
    |
    |
    |
    */
    'headings' => [
        'form-search' => 'Search crawlers',
        'list' => 'List of crawlers',
        'search' => 'Search results',
    ],





    /*
    |-----------------------------------------------------------------------
    | CONFIRMS
    |-----------------------------------------------------------------------
    | List of messages for confirm
    |
    |
    |
    */
    'confirms' => [
        'delete' => 'Are you sure you want to delete this item?',
    ],





    /*
    |-----------------------------------------------------------------------
    | ACTIONS
    |-----------------------------------------------------------------------
    |
    |
    |
    |
    */
    'actions' => [
        'add-ok' => 'Add item successfully',
        'add-error' => 'Add item failed',
        'edit-ok' => 'Edit item successfully',
        'edit-error' => 'Edit item failed',
        'delete-ok' => 'Delete item successfully',
        'delete-error' => 'Delete item failed',
        'internship_diary_unavailable_error' => 'Chưa nhập thông tin công ty thực tập, chưa thể nhập nhật ký thực tập',
    ],
];
