<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Tees extends Controller_Application {

    public function action_index($slug = NULL)
    {
        if ($slug !== NULL)
        {
            $tee = ORM::factory('tee')
                        ->where('slug', '=', $slug)
                        ->find();
            
            if ( ! $tee->loaded())
                throw new ReflectionException;
            
            $this->template->title[] = $tee->title;
        }
        else
        {
            $tee = ORM::factory('tee')->find();
        }
        
        $tees = ORM::factory('tee')
                     ->where('id', '!=', $tee->id)
                     ->find_all();
                
        $products = $tee->products->find_all_available();
        
        $quantity = $tee->products->quantity();
                
        $this->template->section = 'tees';
        $this->template->content = View::factory('tees/index')
                                         ->bind('quantity', $quantity)
                                         ->bind('products', $products)
                                         ->bind('tee', $tee)
                                         ->bind('tees', $tees);
    }
    
    public function action_thanks()
    {
        $this->template->content = View::factory('tees/thanks');
    }
}
