<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'sales' => [
            'title'      => 'Sale',

            'all'        => 'All Sales',
            'management' => 'Sales Report Management',
            'main'       => 'Sales',
            'filter'     => 'Filter Sales',
        ],

        'discounts' => [
            'title' => 'Discount',

            'all'        => 'All Discounts',
            'create'     => 'Create Discount',
            'edit'       => 'Edit Discount',
            'management' => 'Discount Management',
            'main'       => 'Discounts',
            'deleted'    => 'Deleted Discounts',
            'view'       => ':discount'
        ],

        'dinings' => [
            'title' => 'Dining',

            'all'        => 'All Dinings',
            'create'     => 'Create Dining',
            'edit'       => 'Edit Dining',
            'management' => 'Dining Management',
            'main'       => 'Dinings',
            'deleted'    => 'Deleted Dinings',
            'view'       => ':dining'
        ],

        'shifts' => [
            'title' => 'Shift',

            'all'        => 'All Shifts',
            'create'     => 'Create Shift',
            'edit'       => 'Edit Shift',
            'management' => 'Shift Management',
            'main'       => 'Shifts',
            'deleted'    => 'Deleted Shifts',
            'view'       => ':shift'
        ],

        'categories' => [
            'title' => 'Category',

            'all'        => 'All Categories',
            'create'     => 'Create Category',
            'edit'       => 'Edit Category',
            'management' => 'Category Management',
            'main'       => 'Categories',
            'deleted'    => 'Deleted Categories',
            'view'       => ':category'
        ],

        'products' => [
            'title' => 'Product',

            'all'        => 'All Products',
            'create'     => 'Create Product',
            'edit'       => 'Edit Product',
            'management' => 'Product Management',
            'main'       => 'Products',
            'deleted'    => 'Deleted Products',
            'view'       => ':product'
        ],

        'access' => [
            'title' => 'Access',

            'roles' => [
                'all'        => 'All Roles',
                'create'     => 'Create Role',
                'edit'       => 'Edit Role',
                'management' => 'Role Management',
                'main'       => 'Roles',
            ],

            'users' => [
                'all'             => 'All Users',
                'change-password' => 'Change Password',
                'create'          => 'Create User',
                'deactivated'     => 'Deactivated Users',
                'deleted'         => 'Deleted Users',
                'edit'            => 'Edit User',
                'main'            => 'Users',
                'view'            => 'View User',
            ],
        ],

        'log-viewer' => [
            'main'      => 'Log Viewer',
            'dashboard' => 'Dashboard',
            'logs'      => 'Logs',
        ],

        'sidebar' => [
            'report'    => 'Sales Report',
            'category'  => 'Categories',
            'shift'     => 'Shifts',
            'dining'    => 'Dinings',
            'discount' => 'Discounts',
            'product'   => 'Products',
            'dashboard' => 'Dashboard',
            'general'   => 'General',
            'system'    => 'System'
        ],
    ],

    'language-picker' => [
        'language' => 'Language',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar'    => 'Arabic',
            'zh'    => 'Chinese Simplified',
            'zh-TW' => 'Chinese Traditional',
            'da'    => 'Danish',
            'de'    => 'German',
            'el'    => 'Greek',
            'en'    => 'English',
            'es'    => 'Spanish',
            'fa'    => 'Persian',
            'fr'    => 'French',
            'he'    => 'Hebrew',
            'id'    => 'Indonesian',
            'it'    => 'Italian',
            'ja'    => 'Japanese',
            'nl'    => 'Dutch',
            'no'    => 'Norwegian',
            'pt_BR' => 'Brazilian Portuguese',
            'ru'    => 'Russian',
            'sv'    => 'Swedish',
            'th'    => 'Thai',
            'tr'    => 'Turkish',
        ],
    ],
];
