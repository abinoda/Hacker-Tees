<?php defined('SYSPATH') or die('No direct script access.');

class Model_Order extends ORM {
    
    public $_items = array();
    
	public function process()
	{
        $is_new_txn = (bool) ! ORM::factory('order')->where('txn_id', '=', $this->txn_id)->find()->loaded();
        
        if ($is_new_txn)
        {
            $this->save();
            
            ORM::factory('tee')->update_inventory($this->_items);   
        }        
	}
    
    public function save()
    {
        $this->items      = serialize($this->_items);
        $this->created_at = new Database_Expression('NOW()');
        
        return parent::save();
    }
}