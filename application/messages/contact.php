<?php defined('SYSPATH') or die('No direct script access.');

return array
(
    'name' => array
    (
        'not_empty'    => 'Please enter your name.'
    ),
    'email' => array
    (
        'not_empty'    => 'Please enter your email address.',
        'email'        => 'Invalid email address.'
    ),
    'subject' => array
    (
        'not_empty'    => 'Please enter a subject.'
    ),
    'message' => array
    (
        'not_empty'    => 'Please enter a message.'
    )
);