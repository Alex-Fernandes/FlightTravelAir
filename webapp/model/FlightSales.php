<?php

use ActiveRecord\Model;

class FlightSales extends Model
{
    static $has_many = array(
        array('users', 'class_name' => 'User', 'foreign_key' => 'idUser')
    );

}