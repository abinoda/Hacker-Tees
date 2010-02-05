<?php defined('SYSPATH') OR die('No direct access allowed.');

class CSRF {
    
    private static $token;
                
    public static function check()
    {
        CSRF::$token = Session::instance()->get('csrf_token');
        
        if ((CSRF::$token === NULL))
        {
            CSRF::$token = Text::random('alnum', 50);
                        
            Session::instance()->set('csrf_token', CSRF::$token);
        }
                
        if ($_POST)
            if (( ! isset($_POST['csrf_token']) ) OR ($_POST['csrf_token'] !== CSRF::$token))
                return FALSE;
                
        return TRUE;
    }
    
    public static function token()
    {
        return CSRF::$token;
    }
    
    public static function set_token()
    {
        return '<div style="display:none"><input type="hidden" name="csrf_token" value="'.CSRF::$token.'" /></div>';
    }
}