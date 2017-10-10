<?php

/*
    MIT License

    Copyright (c) 2017 Navneil Naicker

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in all
    copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
    SOFTWARE.
*/

//Start PHP session if not already started
if( !headers_sent() and session_status() == PHP_SESSION_NONE ){
    session_start();    
}

class Cashier{

    //Check if Cashier session has been initializeed if not then initialize it over here
    public function __construct(){
        ( !empty($_SESSION['Cashier']) )? $_SESSION['Cashier']: $_SESSION['Cashier'] = array();
    }

    //Add item to the cart
    public function add( $item, $qty = 0 ){
        if( $this->exists( $item ) ){
            $current_qty = $this->qty( $item );
            $qty = $qty + $current_qty;
            $_SESSION['Cashier'][$item] = ['qty' => (int) $qty];            
        } else {
            $_SESSION['Cashier'][$item] = ['qty' => (int) $qty];
        }
    }

    //Remove item from the cart
    public function remove( $item, $qty = 0 ){
        if( $this->exists( $item ) ){
            unset( $_SESSION['Cashier'][$item] );
        }
    }

    //Ajust the item in the cart
    public function adjust( $item, $qty = 0 ){
        $_SESSION['Cashier'][$item] = ['qty' => (int) $qty];
    }

    //Check if the item exists in the cart
    public function exists( $item ){
        return !empty($_SESSION['Cashier'][$item])? true: false;
    }

    //Get the qty of the item from the cart
    public function qty( $item ){
        if( $this->exists($item) ){
            $cashier = $_SESSION['Cashier'][$item];
            return (!empty($cashier['qty']))? (int) $cashier['qty']: null;
        }
    }
    
}