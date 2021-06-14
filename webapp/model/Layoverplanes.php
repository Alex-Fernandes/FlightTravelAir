<?php

use ActiveRecord\Model;

class Layoverplanes extends Model
{
    static $validates_presence_of = array(
        array('idescala', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('idaviao', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('numpassageiros', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('numbilhetesvendidos', 'message' => 'O Campo tem de ser preenchido!!!')
    );

    static $validates_size_of = array(
        array('idescala', 'within' => array(1, 20) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
        array('idaviao', 'within' => array(1, 11) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
        array('numpassageiros', 'within' => array(1, 20) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
        array('numbilhetesvendidos', 'within' => array(1, 20) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
    );

    static $validates_numericality_of = array(
        array('numpassageiros', 'within' => array(1, 11) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
        array('numbilhetesvendidos', 'within' => array(1, 11) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
    );

}