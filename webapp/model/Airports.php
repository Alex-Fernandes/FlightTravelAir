<?php


use ActiveRecord\Model;

class Airports extends Model
{
    static $validates_presence_of = array(
        array('nome', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('cidade', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('pais', 'message' => 'O Campo tem de ser preenchido!!!')
    );

    static $validates_size_of = array(
        array('nome', 'within' => array(1, 100) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
        array('cidade', 'within' => array(1, 100) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
        array('pais', 'within' => array(1, 50) , 'too_long' => 'O Campo tem demasiado caracteres!!!')
    );

}