<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Pages extends Controller_Application {

	public function action_show($page_name)
	{
	    $this->template->section = $page_name;
        $this->template->title[] = ucwords($page_name == 'faq' ? strtoupper($page_name) : $page_name);
        $this->template->content = View::factory('pages/'.$page_name);    
	}
}