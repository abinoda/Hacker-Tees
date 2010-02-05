<?php defined('SYSPATH') or die('No direct script access.');

class Model_Product extends ORM {
	
	protected $_belongs_to = array
	(
        'tee' => array()
	);
	
	public function find_all_available()
	{
	    return $this->where_open()
	                ->where('quantity', '>', '0')
                    ->or_where('quantity', '=', '-1')
                    ->where_close()
                    ->find_all();
	}
	
	public function quantity()
	{
	    $products = $this->where('quantity', '>', '0')
                         ->find_all();
               
        $quantity = 0;
        
        foreach ($products AS $product)
        {
            $quantity += $product->quantity;
        }
        
        return $quantity;
	}	
	
}