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
        'top-menu' => 'Crawlers'
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
        'sample' => 'Sample',
        'list_sites' => 'Sites',
        'list_patterns' => 'Patterns',
        'add_pattern' => 'New pattern',
        'tags' => 'Tags',
        'questions' => 'Questions',
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
        'site_name' => 'Site name',
        'pattern_name' => 'Pattern name',
        'machine_name' => 'Machine name',
        'regular_expression_value' => 'Value',
        'view_pattern' => 'Patterns',
        'num_questions' => 'Questions',
        'tag_name' => 'Tag name',
        'tag_num_questions' => 'Questions'
    ],


    /*
    |-----------------------------------------------------------------------
    | Pages
    |-----------------------------------------------------------------------
    | Pages
    |
    */
    'pages' => [
        'title-list' => 'List of crawlers',
        'title-list-search' => 'Search results',
        'title-edit' => 'Edit crawler',
        'title-add' => 'Add new crawler',
        'title-delete' => 'Delete crawler',
        'title-config' => 'Current configurations',
        'title-lang' => 'Manage list of languages',
        'title-site' => 'List of sites',
        'title-pattern' => 'List of patterns',
        'title-list-search-site' => 'Search sites',
        'title-list-search-pattern' => 'Search patterns',
        'title-edit-tag' => 'Edit tag'
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
        'site_id' => 'Site',
        'site' => 'Site'
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
        'site_name' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'site_url' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'site_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        'site_form' => 'Site form',
        'site_id' => 'Site ID',
        'site_image' => 'Site image',
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
        'id' => 'Crawler ID',
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
        'site-name' => 'Name',
        'site-pattern' => 'Pattern',
        'site_id' => 'ID',
        'tag_name' => 'Tag name',
        'tag_url' => 'Tag url',

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
        'name' => 'Crawler name',
        'overview' => 'Crawler overview',
        'description' => 'Crawler description',
        'image' => 'Crawler image',
        'files' => 'Crawler files',
        'category' => 'Category name',
        'title-search' => 'Search crawler',
        'title-search-site' => 'Search sites',
        'title-search-pattern' => 'Search patterns',
        'site-search' => 'Search site',
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
        'site_name' => 'Site name',
        'site_url' => 'Site url',
        'site_image' => 'Site image',
        'site_description' => 'Site description',
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
        'unknown' => 'Unknown'
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
        'menu-2' => 'Advance',
        'menu-3' => 'Other',
        'menu-4' => 'Assigner',
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
    ],
];
