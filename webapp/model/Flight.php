<?php

use ActiveRecord\Model;

class Flight extends Model
{
/*    static $validates_presence_of = array(
        array('idAeroporto', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('precoVenda', 'message' => 'O Campo tem de ser preenchido!!!'),
    );

    static $validates_size_of = array(
        array('idAeroporto', 'within' => array(1, 100) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
        array('precoVenda', 'within' => array(1, 100) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
    );
*/

    static $has_many = array(
        array('layovers', 'class_name' => 'Layover', 'foreign_key' => 'idVoo')
    );


}