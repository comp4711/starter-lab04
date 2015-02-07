<?php

/**
 * Order handler
 * 
 * Implement the different order handling usecases.
 * 
 * controllers/welcome.php
 *
 * ------------------------------------------------------------------------
 */
class Order extends Application {

    function __construct() {
        parent::__construct();
    }

    // start a new order
    function neworder() {
        $order = $this->orders->create();
        $order->num = $this->orders->highest() + 1;
        $order->date = date('Y-m-d H:i:s');
        $order->status = 'a';
        
        $this->orders->add($order);
        
        redirect('/order/display_menu/' . $order->num);
    }

    // add to an order
    function display_menu($order_num = null) {
        if ($order_num == null)
            redirect('/order/neworder');

        $this->data['pagebody'] = 'show_menu';
        $this->data['order_num'] = $order_num;

        // Append the Order Total to the Page Title
        $order = $this->orders->get($order_num);
        $total = number_format( $this->orders->total($order_num), 2);
        $this->data['title'] = 'Order #' . $order->num;
        $this->data['title'] .= ' ($' . $total . ')';
        
        // Make the columns
        $this->data['meals'] = $this->make_column('m');
        $this->data['drinks'] = $this->make_column('d');
        $this->data['sweets'] = $this->make_column('s');

        // --- CODEIGNITER BUG FIX ---
        foreach ($this->data['meals'] as &$item)
            $item->order_num = $order_num;
        
        foreach ($this->data['drinks'] as &$item)
            $item->order_num = $order_num;
        
        foreach ($this->data['sweets'] as &$item)
            $item->order_num = $order_num;
        
        $this->render();
    }

    // make a menu ordering column
    function make_column($category) {
        $items = $this->menu->some('category', $category);
        return $items;
    }

    // add an item to an order
    function add($order_num, $item) {
        $this->orders->add_item($order_num, $item);
        redirect('/order/display_menu/' . $order_num);
    }

    // checkout
    function checkout($order_num) {
        $this->data['title'] = 'Checking Out';
        $this->data['pagebody'] = 'show_order';
        $this->data['order_num'] = $order_num;

        // Format the Order Total for Display
        $total = number_format( $this->orders->total($order_num), 2);
        $this->data['total'] = '$' . $total;

        // Assign the name of the menu category to the item code for view templating
        $items = $this->orderitems->group($order_num);
        foreach($items as $item) {
            $menuitem = $this->menu->get($item->item);
            $item->code = $menuitem->name;
        }
        
        $this->data['items'] = $items;
        
        // If the order is invalid, assign "disabled" to the okornot template variable.
        $this->data['okornot'] = $this->orders->validate($order_num) ? '' : 'disabled';
        
        $this->render();
    }
    
    // proceed with checkout
    function commit($order_num) {
        if (!$this->orders->validate($order_num))
            redirect('/order/display_menu/' . $order_num);
        $record = $this->orders->get($order_num);
        $record->date = date(DATE_ATOM);
        $record->status = 'c';
        $record->total = $this->orders->total($order_num);
        $this->orders->update($record);
        redirect('/');
    }

    // cancel the order
    function cancel($order_num) {
        $this->orderitems->delete_some($order_num);
        $record = $this->orders->get($order_num);
        $record->status = 'x';
        $this->orders->update($record);
        redirect('/');
    }

}
