<?php

/**
 * Data access wrapper for "menu" table.
 *
 * @author jim
 */
class Menu extends MY_Model {
    // constructor
    function __construct() {
        parent::__construct('menu','code');
    }
}
