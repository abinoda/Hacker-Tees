<?php defined('SYSPATH') or die('No direct script access.');

class Model_Tee extends ORM {
	
	protected $_has_many = array
	(
        'products' => array()
	);
	
	public function update_inventory(array $items)
	{
	    foreach ($items AS $item)
	    {
    	    $tee = ORM::factory('tee', $item['tee_id']);

            if ( ! $tee->loaded())
                throw new Kohana_Exception('tee [id] => '.$item['tee_id'].' does not exist');

            if ($tee->is_limited)
            {
                $product = ORM::factory('product')
                                ->where('tee_id', '=', $tee->id)
                                ->and_where('size', '=', $item['size'])
                                ->find();

                if ( ! $product->loaded())
                    throw new Kohana_Exception('product [tee_id] => '.$item['tee_id'].', [size] => '.$item['size'].' not found');

                if ($product->quantity > $item["quantity"])
                {
                    $product->quantity -= $item["quantity"];
                }
                else
                {
                    $product->quantity = 0;
                }

                $product->save();
            }
	    }
	}
}