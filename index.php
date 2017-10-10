<?php

require_once( dirname(__FILE__) . '/class.cashier.php');

$cashier = new Cashier;

function add(){
    global $cashier;
    $product_id = $_POST['product_id'];
    $qty = $_POST['qty'];
    $cashier->add( $product_id, $qty );
}

function remove(){
    global $cashier;
    $product_id = $_POST['product_id'];
    $qty = $_POST['qty'];
    $cashier->remove( $product_id  );
}

function adjust(){
    global $cashier;
    $product_id = $_POST['product_id'];
    $qty = $_POST['qty'];
    $cashier->adjust( $product_id, $qty );
}

$_POST['action']();