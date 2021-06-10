<?php


use ActiveRecord\Model;

class Plane extends Model
{
    static $validates_presence_of = array(
        array('referencia', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('lotacao', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('tipoaviao', 'message' => 'O Campo tem de ser preenchido!!!')
    );

    static $validates_size_of = array(
        array('referencia', 'within' => array(1, 20) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
        array('lotacao', 'within' => array(1, 11) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
        array('tipoaviao', 'within' => array(1, 20) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
    );

    static $validates_numericality_of = array(
        array('lotacao', 'within' => array(1, 11) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
    );

}