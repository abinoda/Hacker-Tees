<?php defined('SYSPATH') or die('No direct script access.');

class Form extends Kohana_Form {
    
    public static function error($errors, $key)
    {
        return isset($errors[$key]) ? '<span class="'.$key.' error">'.$errors[$key].'</span>' : NULL;
    }
}