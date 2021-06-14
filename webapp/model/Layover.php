<?php

use ActiveRecord\Model;

class Layover extends Model
{
    static $validates_presence_of = array(
        array('idvoo', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('idaeroportodestino', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('idaeroportoorigem', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('dateorigin', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('dateend', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('distancia', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('numordem', 'message' => 'O Campo tem de ser preenchido!!!'),
    );

    static $validates_size_of = array(
        array('idvoo', 'within' => array(1, 100) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
        array('idaeroportodestino', 'within' => array(1, 100) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
        array('idaeroportoorigem', 'within' => array(1, 100) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
        array('distancia', 'within' => array(1, 100) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
        array('numordem', 'within' => array(1, 200) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
    );


    static $validates_numericality_of = array(
        array('idvoo', 'only_integer' => true),
        array('idaeroportodestino', 'only_integer' => true),
        array('idaeroportoorigem', 'only_integer' => true),
        array('distancia', 'only_integer' => true),
        array('numordem', 'only_integer' => true),
    );

    static $belongs_to = array(
        array('airportorigem',  'class_name' => 'Airports', 'foreign_key' => 'idaeroportoorigem'),
        array('airportdestino',  'class_name' => 'Airports', 'foreign_key' => 'idaeroportodestino'),
    );

}