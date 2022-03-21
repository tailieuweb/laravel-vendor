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
        'top-menu' => 'Công việc',
        'top-menu' => 'Quản lý công việc',
        'top-usermenu' => 'Công việc phụ trách',
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
        'list' => 'Danh sách',
        'add' => 'Thêm mới',
        'trash' => 'Trash',
        'config' => 'Cấu hình',
        'lang' => 'Ngôn ngữ',
        'teachers' => 'Giảng viên',
        'category' => 'Danh mục',
    ],





    /*
    |-----------------------------------------------------------------------
    | Table column
    |-----------------------------------------------------------------------
    | The list of columns in table
    |
    */
    'columns' => [
        'order' => '#',
        'name' => 'Công việc',
        'operations' => 'Thao tác',
        'updated_at' => 'Ngày cập nhật',
        'filename' => 'File',
        'status' => 'Trạng thái',
        'start_date' => 'Ngày bắt đầu',
        'end_date' => 'Ngày kết thúc',
        'teacher_name' => 'Thành viên',
        'total' => 'Total',
        'assigned' => 'Assigned',
        'canceled' => 'Canceled',
        'done' => 'Done',
        'declined' => 'Declined',
        'inprogress' => 'In progress',
        'pending' => 'Pending',
        'tasks' => 'Tasks',

    ],


    /*
    |-----------------------------------------------------------------------
    | Pages
    |-----------------------------------------------------------------------
    | Pages
    |
    */
    'pages' => [
        'title-list' => 'Danh sách công việc',
        'title-list-search' => 'Tìm kiếm công việc',
        'title-edit' => 'Cập nhật công việc',
        'title-add' => 'Thêm công việc mới',
        'title-delete' => 'Delete task',
        'title-config' => 'Current configurations',
        'title-lang' => 'Manage languages',
        'title-list-teachers' => 'Thống kê công việc theo thành viên phụ trách',
        'title-list-task-teacher' => 'Thống kê công việc theo thành viên phụ trách',
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
        'reset' => 'Resest',
        'add' => 'Add',
        'save' => 'Save',
        'delete' => 'Delete',
        'del-trash' => 'In trash',
        'del-forever' => 'Forever',
        'add_member' => 'Mời thành viên',
        'add_all_member' => 'Mời tất cả',
        'reset_invited' => 'Xóa tất cả',
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
        'keyword' => 'Từ khóa',
        'sorting' => 'Sorting',
        'no-selected' => 'Sorting',
        'status' => 'Trạng thái',
        'start_date' => 'Ngày bắt đầu',
        'end_date' => 'Ngày kết thúc',
        'task_size' => 'Độ lớn',
        'task_priority' => 'Độ ưu tiên',
        'order_by_asc' => 'ASC',
        'order_by_desc' => 'DESC',
    ],





    /*
    |-----------------------------------------------------------------------
    | Description
    |-----------------------------------------------------------------------
    | Description
    |
    */
    'description' => [
        'form' => 'Màn hình thêm mới, cập nhật thông tin công việc',
        'list-teachers' => 'Danh sách GV Khoa CNTT',
        'update' => 'Update task',
        'name' => 'Tên công việc thực hiện',
        'category' => 'Danh mục công việc',
        'list' => 'Thống kê số công việc phụ trách',
        'task-list' => 'Quản lý các công việc đã tạo',
        'counters' => 'Có <b>:number</b> công việc',
        'counters-teachers' => 'Có <b>:number</b> GV',
        'counter' => 'Có <b>:number</b> công việc',
        'not-found' => 'Not found items',
        'config' => 'List of configurations',
        'lang' => 'List of languages',
        'start_date' => 'Ngày bắt đầu thực hiện công việc, định dạng dd/mm/yyyy',
        'end_date' => 'Ngày kết thúc thực hiện công việc, định dạng dd/mm/yyyy',
        'task_size' => 'Độ lớn công việc: small (nhỏ), medium (vừa), large (lớn)',
        'task_priority' => 'Độ ưu tiên công việc: low (thấp), medium (vừa), high (cao)',
        'status' => 'Trạng thái công việc: hoàn thành, chưa hoàn thành,...',
        'overview' => 'Mô tả sơ lược về công việc cần thực hiện như mục tiêu, phạm vi, ..',
        'description' => 'Mô tả chi tiết công việc thực hiện, đủ thông tin để hiểu và thực hiện được công việc',
        'image' => 'Hình ảnh mô tả công việc',
        'files' => 'Đính kèm file liên quan đến công việc cần xử lý',
        'invite_member' => 'Mời thành viên phụ trách công việc từ danh sách đã có',
        'invited_member_counter' => 'Có <b>:number</b> thành viên phụ trách xử lý công việc',
        'list-task-teacher' => 'Thống kê số công việc phụ trách theo từng thành viên',
        'counters-task-teacher' => 'Có <b>:number</b> công việc',
        'counter-task-teacher' => 'Có <b>:number</b> công việc',
        'notes' => 'Phản hồi, trao đổi về công việc được phân công phụ trách',
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
        'required' => ':attribute yêu cầu nhập',
        'required_length' => 'Allow from: <b>:minlength</b> to <b>:maxlength</b>. characters',
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
        'name' => 'Tên công việc',
        'description' => 'Description',
        'overview' => 'Overview',
        'slug' => 'Slug',
        'updated_at' => 'Ngày cập nhật',
        'status' => 'Trạng thái',
        'start_date' => 'Ngày bắt đầu',
        'end_date' => 'Ngày kết thúc',
        'task_name' => 'Tên công việc',
        'task_start_date' => 'Ngày bắt đầu',
        'task_end_date' => 'Ngày kết thúc',
        'category_id' => 'Danh mục công việc',
        'task_size' => 'Độ lớn',
        'task_priority' => 'Độ ưu tiên',
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
        'name' => 'Công việc',
        'category' => 'Danh mục công việc',
        'title-search' => 'Tìm kiếm công việc',
        'title-backup' => 'Backups',
        'config' => 'Configurations',
        'start_date' => 'Ngày bắt đầu',
        'end_date' => 'Ngày kết thúc',
        'overview' => 'Mô tả sơ lược công việc',
        'description' => 'Mô tả chi tiết công việc',
        'image' => 'Hình ảnh',
        'files' => 'Đính kèm file',
        'invite_member' => 'Mời thành viên phụ trách',
        'add_member' => 'Mời thành viên',
        'add_all_member' => 'Mời tất cả',
        'reset_invited' => 'Xóa tất cả',
        'member_name' => 'Thành viên',
        'action' => 'Thao tác',
        'notes' => 'Ghi chú',
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
        'menu_1' => 'Thông tin công việc',
        'menu_2' => 'Mô tả chi tiết công việc',
        'menu_3' => 'Thông tin khác',
        'menu_4' => 'Thành viên phụ trách',
        'menu_5' => 'Other',
        'menu_6' => 'Other',
        'menu_7' => 'Other',
        'usermenu_1' => 'Xác nhận',
        'usermenu_2' => 'Mô tả công việc',
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
        'form-search' => 'Search task',
        'list' => 'List of task',
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
        'add-ok' => 'Thêm mới thành công',
        'add-error' => 'Thêm mới thất bại',
        'edit-ok' => 'Cập nhật thành công',
        'edit-error' => 'Cập nhật thất bại',
        'delete-ok' => 'Xóa thành công',
        'delete-error' => 'Xóa thất bại',
    ],
];
