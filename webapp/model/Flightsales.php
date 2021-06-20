<?php

use ActiveRecord\Model;

class Flightsales extends Model
{
    static $validates_presence_of = array(
        array('iduser', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('idvooida', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('precopago', 'message' => 'O Campo tem de ser preenchido!!!')
    );

    static $has_many = array(
        array('users', 'class_name' => 'User', 'foreign_key' => 'idUser'),
    );

    static $belongs_to = array(
        array('flightsaleida',  'class_name' => 'Flight', 'foreign_key' => 'idvooida'),
        array('flightsalevolta',  'class_name' => 'Flight', 'foreign_key' => 'idvoovolta'),
    );

}