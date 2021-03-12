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
        'top-menu' => 'Modules'
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
        'add' => 'Add new',
        'trash' => 'Trash',
        'config' => 'Configurations',
        'lang' => 'Languages',
        'category' => 'Categories',
        'sample' => 'Sample'
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
        '#' => '#',
        'counter' => '#',
        'id' => 'Id',
        'name' => 'Module name',
        'operations' => 'Operations',
        'updated_at' => 'Updated at',
        'filename' => 'File name',
        'status'    => 'Status',
        'user_id_assigner' => 'User ID Assigner',
        'answer' => 'Answer',
        'title' => 'Title',
        'email' => 'Email',
        'message' => 'Message',
        'module_name' => 'Module name'
    ],


    /*
    |-----------------------------------------------------------------------
    | Pages
    |-----------------------------------------------------------------------
    | Pages
    |
    */
    'pages' => [
        'title-list' => 'List of modules',
        'title-list-search' => 'Search results',
        'title-edit' => 'Edit module',
        'title-add' => 'Add new module',
        'title-delete' => 'Delete module',
        'title-config' => 'Current configurations',
        'title-lang' => 'Manage list of languages',
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
        'delete-in-trash' => 'In trash',
        'delete-forever' => 'Forever',
        'sent' => 'Sent'
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
        'sorting' => 'Sorting',
        'no-selected' => 'No selected',
        'status' => 'Status',
    ],





    /*
    |-----------------------------------------------------------------------
    | Description
    |-----------------------------------------------------------------------
    | Description
    |
    */
    'descriptions' => [
        'form' => 'Module form',
        'update' => 'Update module',
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
        'module_name'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'module_slug'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'module_description'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'module_html'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'module_css'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'module_javascript'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
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
        'required_min_length' =>'<b> :attribute </b> allows from: <b>:minlength</b> characters.',
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
        'id' => 'Module ID',
        'name' => 'Module name',
        'description' => 'Module description',
        'overview' => 'Module overview',
        'slug' => 'Slug',
        'updated_at' => 'Updated at',
        'user-id'   => 'ID',
        'last-name' => 'Last name',
        'first-name'    => 'First name',
        'status' => 'Status',
        'title' => 'Title',
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
        'name' => 'Module name',
        'overview' => 'Module overview',
        'description' => 'Module description',
        'image' => 'Module image',
        'files' => 'Module files',
        'category' => 'Category name',
        'title-search' => 'Search module',
        'title-backup' => 'Backups',
        'config' => 'Configurations',
        'module-status'    => 'Status',
        'assigner'        => 'Add assigner',
        'search'        => 'Search User Data',
        'total-data'    => 'Total Data :',
        'email'        => 'Email',
        'message'        => 'Message',
        'answer'        => 'Answer',
        'title'        => 'Title',
        'phone' => 'Phone',
        'module_name' => 'Module name',
        'module_slug' => 'Module slug',
        'module_description' => 'Module description',
        'module_html' => 'Source HTML',
        'module_css' => 'Source CSS',
        'module_javascript' => 'Source JavaScript',
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
        'menu-1' => 'Basic',
        'menu-2' => 'HTML',
        'menu-3' => 'CSS',
        'menu-4' => 'JavaScript',
        'menu-5' => 'Answer',
        'menu-6' => 'Menu 6',
        'menu-7' => 'Menu 7',
        'menu-8' => 'Menu 8',
        'menu-9' => 'Menu 9',
        'menu-9' => 'Menu 9',
        'guide'  => 'Guide',
        'other'  => 'Other',
        'basic'  => 'Basic',
        'advance' => 'Advance',
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
        'form-search' => 'Search modules',
        'list' => 'List of modules',
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