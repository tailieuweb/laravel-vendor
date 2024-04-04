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
        'top-menu' => 'Forum'
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
        'list' => 'Danh sách',
        'add' => 'Thêm mới câu hỏi',
        'trash' => 'Trash',
        'config' => 'Cấu hình',
        'lang' => 'Ngôn ngữ',
        'category' => 'Danh mục',
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
        'name' => 'Tiêu đề câu hỏi',
        'operations' => 'Thao tác',
        'updated_at' => 'Updated at',
        'filename' => 'File đính kèm',
        'status' => 'Trạng thái',
    ],


    /*
    |-----------------------------------------------------------------------
    | Pages
    |-----------------------------------------------------------------------
    | Pages
    |
    */
    'pages' => [
        'title-list' => 'Danh sách câu hỏi và trả lời',
        'title-list-search' => 'Tìm kiếm câu hỏi',
        'title-edit' => 'Cập nhật thông tin câu hỏi',
        'title-add' => 'Thêm mới câu hỏi',
        'title-delete' => 'Xóa',
        'title-config' => 'Cấu hình ứng dụng',
        'title-lang' => 'Quản lý ngôn ngữ',
        'title-question-and-answer' => 'Hỏi đáp các vấn đề thực tập',
        'title-question' => 'Hỏi các vấn đề thực tập',
        'title-answer' => 'Trả lời câu hỏi'
    ],


    /*
    |-----------------------------------------------------------------------
    | Button
    |-----------------------------------------------------------------------
    | The list of buttons
    |
    */
    'buttons' => [
        'search' => 'Tìm kiếm',
        'reset' => 'Reset',
        'add' => 'Thêm mới',
        'save' => 'Lưu thông tin',
        'delete' => 'Xóa',
        'delete-in-trash' => 'In trash',
        'delete-forever' => 'Forever',
    ],


    /*
    |-----------------------------------------------------------------------
    | Hint
    |-----------------------------------------------------------------------
    | The list of hint
    |
    */
    'hint' => [
        'delete-forever' => 'Delete forever',
        'delete-in-trash' => 'Delete in trash',
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
        'keyword' => 'Từ khóa',
        'sorting' => 'Sắp xếp',
        'no-selected' => 'No selected',
        'status' => 'Status',
    ],


    /*
    |-----------------------------------------------------------------------
    | Descriptions
    |-----------------------------------------------------------------------
    | Descriptions
    |
    */
    'descriptions' => [
        'form' => 'Thông tin câu hỏi',
        'update' => 'Update post',
        'name' => 'Đặt tiêu đề câu hỏi cần thảo luận',
        'slug' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'category' => 'Phân loại câu hỏi',
        'overview' => 'Mô tả ngắn gọn nội dung câu hỏi',
        'description' => 'Mô tả chi tiết nội dung câu hỏi',
        'image' => 'Đính kèm thêm hình ảnh trong câu hỏi',
        'files' => 'Đính kèm thêm các file',
        'status' => 'Chọn trạng thái của câu hỏi',
        'list' => '',
        'counters' => 'There are <b>:number</b> items',
        'counter' => 'There is <b>:number</b> item',
        'not-found' => 'Không tìm thấy dữ liệu',
        'config' => 'List of configurations',
        'lang' => 'List of languages',
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
        'required_min_length' => '<b> :attribute </b> allows from: <b>:minlength</b> characters.',
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
        'id' => 'Forum ID',
        'name' => 'Forum name',
        'description' => 'Forum Description',
        'overview' => 'Forum Overview',
        'slug' => 'Slug',
        'updated_at' => 'Updated at'
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
        'name' => 'Tiêu đề câu hỏi',
        'slug' => 'Forum slug',
        'overview' => 'Mô tả ngắn nội dung câu hỏi',
        'description' => 'Mô tả chi tiết nội dung câu hỏi',
        'image' => 'Hình ảnh đính kèm',
        'files' => 'Đính kèm file',
        'category' => 'Danh mục',
        'slideshow' => 'Slideshow name',
        'title-search' => 'Tìm kiếm',
        'title-backup' => 'Backups',
        'config' => 'Configurations',
        'keyword' => 'Từ khóa',
        'sorting' => 'Sắp xếp',
        'no-selected' => 'No selected',
        'status' => 'Trạng thái',
        'delete' => 'Delete',
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
        'menu_1' => 'Basic',
        'menu_2' => 'Advance',
        'menu_3' => 'Other',
        'menu_4' => 'Menu 4',
        'menu_5' => 'Menu 5',
        'menu_6' => 'Menu 6',
        'menu_7' => 'Menu 7',
        'menu_8' => 'Menu 8',
        'menu_9' => 'Menu 9',
        'menu_9' => 'Menu 9',
        'guide' => 'Guide',
        'other' => 'Thêm file đính kèm',
        'basic' => 'Thông tin cơ bản',
        'advance' => 'Thông tin thêm',
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
        'form-search' => 'Search posts',
        'list' => 'List of posts',
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
    ],
];
