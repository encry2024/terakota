<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Alert Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain alert messages for various scenarios
    | during CRUD operations. You are free to modify these language lines
    | according to your application's requirements.
    |
    */

    'backend' => [
        'discounts' => [
            'created'             => 'Discount ":discount" was successfully created.',
            'deleted'             => 'Discount ":discount" was successfully deleted.',
            'deleted_permanently' => 'Discount ":discount" was deleted permanently.',
            'restored'            => 'Discount ":discount" was successfully restored.',
            'updated'             => 'Discount ":discount" was successfully updated.',
        ],

        'dinings' => [
            'created'             => 'Dining ":dining" was successfully created.',
            'deleted'             => 'Dining ":dining" was successfully deleted.',
            'deleted_permanently' => 'Dining ":dining" was deleted permanently.',
            'restored'            => 'Dining ":dining" was successfully restored.',
            'updated'             => 'Dining ":dining" was successfully updated.',
        ],

        'shifts' => [
            'created'             => 'Shift ":shift" was successfully created.',
            'deleted'             => 'Shift ":shift" was successfully deleted.',
            'deleted_permanently' => 'Shift ":shift" was deleted permanently.',
            'restored'            => 'Shift ":shift" was successfully restored.',
            'updated'             => 'Shift ":shift" was successfully updated.',
            'assigned'            => 'User ":user" was successfully assigned to Shift ":shift"'
        ],

        'categories' => [
            'created'             => 'Category ":category" was successfully created.',
            'deleted'             => 'Category ":category" was successfully deleted.',
            'deleted_permanently' => 'Category ":category" was deleted permanently.',
            'restored'            => 'Category ":category" was successfully restored.',
            'updated'             => 'Category ":category" was successfully updated.',
        ],

        'products' => [
            'created'             => 'Product ":product" was successfully created.',
            'deleted'             => 'Product ":product" was successfully deleted.',
            'deleted_permanently' => 'Product ":product" was deleted permanently.',
            'restored'            => 'Product ":product" was successfully restored.',
            'updated'             => 'Product ":product" was successfully updated.',
        ],

        'roles' => [
            'created' => 'The role was successfully created.',
            'deleted' => 'The role was successfully deleted.',
            'updated' => 'The role was successfully updated.',
        ],

        'users' => [
            'cant_resend_confirmation' => 'The application is currently set to manually approve users.',
            'confirmation_email'  => 'A new confirmation e-mail has been sent to the address on file.',
            'confirmed'              => 'The user was successfully confirmed.',
            'created'             => 'The user was successfully created.',
            'deleted'             => 'The user was successfully deleted.',
            'deleted_permanently' => 'The user was deleted permanently.',
            'restored'            => 'The user was successfully restored.',
            'session_cleared'      => "The user's session was successfully cleared.",
            'social_deleted' => 'Social Account Successfully Removed',
            'unconfirmed' => 'The user was successfully un-confirmed',
            'updated'             => 'The user was successfully updated.',
            'updated_password'    => "The user's password was successfully updated.",
        ],
    ],

    'frontend' => [
        'contact' => [
            'sent' => 'Your information was successfully sent. We will respond back to the e-mail provided as soon as we can.',
        ],
    ],
];
