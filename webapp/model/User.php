<?php

use ActiveRecord\Model;

class User extends Model
{
    static $validates_presence_of = array(
        array('nome', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('morada', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('email', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('nif', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('telefone', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('username', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('password', 'message' => 'O Campo tem de ser preenchido!!!'),
        array('role', 'message' => 'O Campo tem de ser preenchido!!!')
    );

    static $validates_size_of = array(
        array('nome', 'within' => array(1, 80) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
        array('morada', 'within' => array(1, 100) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
        array('email', 'within' => array(1, 60) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
        array('nif', 'is' => 9 , 'too_long' => 'O Campo tem demasiado caracteres!!!') ,
        array('telefone', 'is' => 9 , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
        array('username', 'within' => array(1,50) , 'too_long' => 'O Campo tem demasiado caracteres!!!'),
        array('password', 'within' => array(1, 30) , 'too_long' => 'O Campo tem demasiado caracteres!!!')
    );

    static $validates_inclusion_of = array(
        array('role', 'in' => array('passageiro','opcheckin', 'gestorvoo', 'admin'))
    );

    static $validates_format_of = array(
        array('email',  'with' =>
        '/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/'),

        array('password', 'with' =>
        '/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/', 'message' => 'is too weak')
    );

    static $validates_numericality_of = array(
        array('nif', 'only_integer' => true),
        array('telefone', 'only_integer' => true)
    );
}