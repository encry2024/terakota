<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all'     => 'All',
        'yes'     => 'Yes',
        'no'      => 'No',
        'copyright' => 'Copyright',
        'custom'  => 'Custom',
        'actions' => 'Actions',
        'active'  => 'Active',
        'buttons' => [
            'save'   => 'Save',
            'update' => 'Update',
        ],
        'hide'              => 'Hide',
        'inactive'          => 'Inactive',
        'none'              => 'None',
        'show'              => 'Show',
        'toggle_navigation' => 'Toggle Navigation',
    ],

    'backend' => [
        'sales' => [
            'management'          => 'Sales Report',

            'table' => [
                'id'            =>  'Sale Count',
                'name'          =>  'Cashier',
                'dining'        =>  'TBL #',
                'product'       =>  'Product',
                'discount'      =>  'Discount',
                'senior'        =>  'Senior ID',
                'quantity'      =>  'Quantity',
                'amount'        =>  'Amount',
                'vat'           =>  'VAT',
                'order'         =>  'Order Type',
                'status'        =>  'Order Status',
                'created_at'    =>  'Transaction Date',
                'updated_at'    =>  'Updated At',
                'deleted_at'    =>  'Deleted At',
                'total'         =>  'sale total|sales total'
            ],
        ],

        'discounts' => [
            'create'              => 'Create discount',
            'deleted'             => 'Deleted discounts',
            'edit'                => 'Edit discount',
            'management'          => 'Discount Management',
            'list'                => 'discount List',

            'table' => [
                'id'        => 'ID',
                'name'      => 'discount Name',
                'discount'  => 'Discount',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'deleted_at' => 'Deleted At',
                'total'      => 'discount total|discounts total'
            ],

            'tabs' => [
                'titles' => [
                    'overview' => 'Overview',
                    'history'  => 'History',
                ],

                'content' => [
                    'overview' => [
                        'id'        => 'ID',
                        'name'      => 'discount Name',
                        'discount'  => 'Discount',
                        'created_at' => 'Created At',
                        'updated_at' => 'Updated At',
                        'deleted_at' => 'Deleted At',
                    ],
                ],
            ],

            'view' => ':name',
        ],

        'dinings' => [
            'create'              => 'Create Dining',
            'deleted'             => 'Deleted Dinings',
            'edit'                => 'Edit Dining',
            'management'          => 'Dining Management',
            'list'                => 'Dining List',

            'table' => [
                'id'        => 'ID',
                'name'      => 'Dining Name',
                'price'      => 'Price',
                'description' => 'Description',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'deleted_at' => 'Deleted At',
                'total'      => 'dining total|dinings total'
            ],

            'tabs' => [
                'titles' => [
                    'overview' => 'Overview',
                    'history'  => 'History',
                ],

                'content' => [
                    'overview' => [
                        'id'        => 'ID',
                        'name'      => 'Dining Name',
                        'price'      => 'Price',
                        'description' => 'Description',
                        'created_at' => 'Created At',
                        'updated_at' => 'Updated At',
                        'deleted_at' => 'Deleted At',
                    ],
                ],
            ],

            'view' => ':name',
        ],

        'shifts' => [
            'create'              => 'Create Shift',
            'deleted'             => 'Deleted Shifts',
            'edit'                => 'Edit Shift',
            'management'          => 'Shift Management',
            'list'                => 'Shift List',

            'table' => [
                'id'        => 'ID',
                'name'      => 'Shift Name',
                'user'      => 'User',
                'time_start' => 'Time Start',
                'time_end' => 'Time End',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'deleted_at' => 'Deleted At',
                'total'      => 'shift total|shifts total'
            ],

            'tabs' => [
                'titles' => [
                    'overview' => 'Overview',
                    'history'  => 'History',
                ],

                'content' => [
                    'overview' => [
                        'id'        => 'ID',
                        'name'      => 'Shift Name',
                        'user'      => 'User',
                        'time_start' => 'Time Start',
                        'time_end' => 'Time End',
                        'created_at' => 'Created At',
                        'updated_at' => 'Updated At',
                        'deleted_at' => 'Deleted At',
                    ],
                ],
            ],

            'view' => ':name',
        ],

        'categories' => [
            'create'              => 'Create Category',
            'deleted'             => 'Deleted Categories',
            'edit'                => 'Edit Category',
            'management'          => 'Category Management',
            'list'                => 'Category List',

            'table' => [
                'id'        => 'ID',
                'name'      => 'Name',
                'product_count' => 'Product Count',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',
                'deleted_at' => 'Deleted At',
                'total'      => 'category total|categories total'
            ],

            'tabs' => [
                'titles' => [
                    'overview' => 'Overview',
                    'history'  => 'History',
                ],

                'content' => [
                    'overview' => [
                        'id'        => 'ID',
                        'name'      => 'Name',
                        'product_count' => 'Product Count',
                        'created_at' => 'Created At',
                        'updated_at' => 'Updated At',
                        'deleted_at' => 'Deleted At',
                    ],
                ],
            ],

            'view' => ':category',
        ],

        'products' => [
            'create'              => 'Create Product',
            'deleted'             => 'Deleted Products',
            'edit'                => 'Edit Product',
            'management'          => 'Product Management',
            'list'                => 'Product List',

            'table' => [
                'id'        => 'ID',
                'name'      => 'Name',
                'category'  => 'Category',
                'code'      => 'Code',
                'price'     => 'Price',
                'created_at'=> 'Created At',
                'updated_at'=> 'Updated At',
                'deleted_at'=> 'Deleted At',
                'total'     => 'product total|products total'
            ],

            'tabs' => [
                'titles' => [
                    'overview' => 'Overview',
                    'history'  => 'History',
                ],

                'content' => [
                    'overview' => [
                        'id'           => 'ID',
                        'name'         => 'Name',
                        'code'         => 'Product Code',
                        'price'        => 'Product Price',
                        'category'     => 'Category',
                        'created_at'   => 'Created At',
                        'updated_at'   => 'Updated At',
                        'deleted_at'   => 'Deleted At',
                    ],
                ],
            ],

            'view' => ':product',
        ],

        'access' => [
            'roles' => [
                'create'     => 'Create Role',
                'edit'       => 'Edit Role',
                'management' => 'Role Management',

                'table' => [
                    'number_of_users' => 'Number of Users',
                    'permissions'     => 'Permissions',
                    'role'            => 'Role',
                    'sort'            => 'Sort',
                    'total'           => 'role total|roles total',
                ],
            ],

            'users' => [
                'active'              => 'Active Users',
                'all_permissions'     => 'All Permissions',
                'change_password'     => 'Change Password',
                'change_password_for' => 'Change Password for :user',
                'create'              => 'Create User',
                'deactivated'         => 'Deactivated Users',
                'deleted'             => 'Deleted Users',
                'edit'                => 'Edit User',
                'management'          => 'User Management',
                'no_permissions'      => 'No Permissions',
                'no_roles'            => 'No Roles to set.',
                'permissions'         => 'Permissions',

                'table' => [
                    'confirmed'      => 'Confirmed',
                    'created'        => 'Created',
                    'email'          => 'E-mail',
                    'id'             => 'ID',
                    'last_updated'   => 'Last Updated',
                    'name'           => 'Name',
                    'first_name'     => 'First Name',
                    'last_name'      => 'Last Name',
                    'no_deactivated' => 'No Deactivated Users',
                    'no_deleted'     => 'No Deleted Users',
                    'other_permissions' => 'Other Permissions',
                    'permissions' => 'Permissions',
                    'roles'          => 'Roles',
                    'social' => 'Social',
                    'total'          => 'user total|users total',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                        'history'  => 'History',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar'       => 'Avatar',
                            'confirmed'    => 'Confirmed',
                            'created_at'   => 'Created At',
                            'deleted_at'   => 'Deleted At',
                            'email'        => 'E-mail',
                            'last_updated' => 'Last Updated',
                            'name'         => 'Name',
                            'first_name'   => 'First Name',
                            'last_name'    => 'Last Name',
                            'status'       => 'Status',
                        ],
                    ],
                ],

                'view' => 'View User',
            ],
        ],
    ],

    'frontend' => [

        'auth' => [
            'login_box_title'    => 'Login',
            'login_button'       => 'Login',
            'login_with'         => 'Login with :social_media',
            'register_box_title' => 'Register',
            'register_button'    => 'Register',
            'remember_me'        => 'Remember Me',
        ],

        'contact' => [
            'box_title' => 'Contact Us',
            'button' => 'Send Information',
        ],

        'passwords' => [
            'expired_password_box_title' => 'Your password has expired.',
            'forgot_password'                 => 'Forgot Your Password?',
            'reset_password_box_title'        => 'Reset Password',
            'reset_password_button'           => 'Reset Password',
            'update_password_button'           => 'Update Password',
            'send_password_reset_link_button' => 'Send Password Reset Link',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Change Password',
            ],

            'profile' => [
                'avatar'             => 'Avatar',
                'created_at'         => 'Created At',
                'edit_information'   => 'Edit Information',
                'email'              => 'E-mail',
                'last_updated'       => 'Last Updated',
                'name'               => 'Name',
                'first_name'         => 'First Name',
                'last_name'          => 'Last Name',
                'update_information' => 'Update Information',
            ],
        ],

    ],
];
