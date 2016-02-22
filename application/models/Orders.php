<?php

/**
 * Data access wrapper for "orders" table.
 *
 * @author jim
 */
class Orders extends MY_Model {

    // constructor
    function __construct() {
        parent::__construct('orders', 'num');
    }

    // add an item to an order
    function add_item($num, $code) {
        $CI = & get_instance();
        if($CI->Orderitems->exists($num, $code))
        {
            $record = $CI->Orderitems->get($num, $code);
            $record->quantity++;
            $CI->Orderitems->update($record);
        }
        else
        {
            $record = $CI->Orderitems->create();
            $record->order = $num;
            $record->item = $code;
            $record->quantity = 1;
            $CI->Orderitems->add($record);
        }
    }

    // calculate the total for an order
    function total($num) {
        $CI = & get_instance();
        $items = $CI->Orderitems->group($num);
        $result = 0;
        if(count($items) > 0)
        {
            foreach($items as $item)
            {
                $menu = $CI->Menu->get($item->item);
                $result += $item->quantity * $menu->price;
            }
        }
        return $result;
    }

    // retrieve the details for an order
    function details($num) {
        
    }

    // cancel an order
    function flush($num) {
        $this->Orderitems->delete_some($num);
        $record = $this->Orders->get($num);
        $record->status = 'x';
        $this->Orders->update($record);
    }

    // validate an order
    // it must have at least one item from each category
    function validate($num) {
        $CI = & get_instance();
        $items = $CI->Orderitems->group($num);
        $gotem = array();
        
        if(count($items) > 0)
        {
            foreach($items as $item)
            {
                $menu = $CI->Menu->get($item->item);
                $gotem[$menu->category] = 1;
            }
        }
        
        return isset($gotem['m']) && isset($gotem['d']) && isset($gotem['s']);
    }

}
