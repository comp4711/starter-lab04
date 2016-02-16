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
        
    }

    // calculate the total for an order
    function total($num) {
        $CI = & get_instance();
        $items = $CI->orderitems->group($num);
        $result = 0;
        if (count($items) > 0)
            foreach ($items as $item)
            {
                $menu = $CI->menu->get($item->item);
                $result += $item->quantity * $menu->price;
            }
        return $result;
    }

    // retrieve the details for an order
    function details($num) {
        
    }

    // cancel an order
    function flush($num) {
        
    }

    // validate an order
    // it must have at least one item from each category
    function validate($num) {
        return false;
    }

}
