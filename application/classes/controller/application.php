<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Application extends Controller_Template {

    public $template = 'layouts/application';
        
    public function before()
    {
        parent::before();
                
        if ( ! CSRF::check())
            throw new ApplicationException("Cross site request forgery.", 403);
        
        // Set base title
        $this->template->title = array('Hacker Tees');
        $this->template->section = NULL;
    }
    
    public function after()
    {
        if ( ! Request::$is_ajax)
		{
		    return parent::after();
		}
    }
}