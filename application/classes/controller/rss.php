<?php defined('SYSPATH') or die('No direct script access.');

class Controller_RSS extends Controller {

    public function action_tees()
    {
        $tees = ORM::factory('tee')->find_all();
    
        $last_build_date = ORM::factory('tee')
                                ->order_by('created_at', 'DESC')
                                ->find()
                                ->created_at;

        $this->request->headers['Content-Type'] = "application/rss+xml";
        $this->request->response = View::factory('rss/tees')
                                         ->bind('last_build_date', $last_build_date)
                                         ->bind('tees', $tees);
    }
}