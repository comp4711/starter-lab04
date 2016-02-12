<?php

/**
 * Data access wrapper for "orderitems" table.
 *
 * @author jim
 */
class Orderitems extends MY_Model2 {

    // constructor
    function __construct() {
        parent::__construct('orderitems', 'order', 'item');
    }

}
