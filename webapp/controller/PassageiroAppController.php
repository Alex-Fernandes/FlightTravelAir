<?php

use ArmoredCore\WebObjects\Debug;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class PassageiroAppController extends BaseAuthController
{

    public function index()
    {
        $this->loginFilterbyRole('passageiro');
        return View::make('passageiro.start');
    }

    public function voos(){
        $this->loginFilterbyRole('passageiro');
        $user = User::find([$_SESSION['APPuserid']]);
        $airport = Airports::all();
        $date = date('Y-m-d', time());
        $layover = Layover::all(array('conditions' => array('dateend >= ?', $date)  ,'order' => 'dateorigin asc'));
        return View::make('passageiro.voos', ['user' => $user, 'layover' => $layover, 'airport' => $airport]);
    }

    public function profile()
    {
        $this->loginFilterbyRole('passageiro');
        $user = User::find([$_SESSION['APPuserid']]);
        return View::make('passageiro.profile', ['user' => $user]);
    }

    public function bilhete(){
        $this->loginFilterbyRole('passageiro');
        $airport = Airports::all();
        $flights = Flight::all();
        $user = User::find([$_SESSION['APPuserid']]);
        $date = date('Y-m-d', time());
        $layover = Layover::all(array('conditions' => array('dateend >= ?', $date)  ,'order' => 'dateorigin asc'));
        return View::make('passageiro.bilhete', ['user' => $user,'layover' => $layover, 'airport' => $airport, 'flights' => $flights]);
    }

    public function storeflightsale($id)
    {
        $this->loginFilterbyRole('passageiro');
        //create new resource (activerecord/model) instance with data from POST
        //your form name fields must match the ones of the table fields
        $flightsales = new Flightsales(Post::getAll());
        $flightsales->iduser = $id;
        $date = date('Y-m-d H:m:s', time());
        $flightsales->datacompra = $date;

        $ida = $this->sendPriceBack($flightsales->idvooida);
        if($flightsales->idvoovolta == 0){
            $volta = 0;
        }else{
            $volta = $this->sendPriceBack($flightsales->idvoovolta);
        }

        $flightsales->precopago = $ida + $volta;

        if($flightsales->is_valid()){
            $flightsales->save();
            Redirect::toRoute('passageiro/voos');
        } else {
            //redirect to form with data and errors
            $airport = Airports::all();
            $date = date('Y-m-d', time());
            $user = User::find([$_SESSION['APPuserid']]);
            $layover = Layover::all(array('conditions' => array('dateend >= ?', $date)  ,'order' => 'dateorigin asc'));

            Redirect::flashToRoute('passageiro/bilhete', ['user' => $user,'flightsales' => $flightsales, 'layover' => $layover, 'airport' => $airport]);
        }
    }

    public function sendPriceBack($id){
        $flights = Flight::find([$id]);
        return $flights->precovenda;
    }

    public function edit($id)
    {
        $this->loginFilterbyRole('passageiro');
        $user = User::find([$id]);

        if (is_null($user)) {
            //TODO redirect to standard error page
        } else {
            return View::make('passageiro/edit', ['user' => $user]);
        }
    }

    public function update($id)
    {
        $this->loginFilterbyRole('passageiro');
        //find resource (activerecord/model) instance where PK = $id
        //your form name fields must match the ones of the table fields
        $user = User::find([$id]);
        $user->update_attributes(Post::getAll());

        if($user->is_valid()){
            $user->save();
            Redirect::toRoute('passageiro/index', $user->id);
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('passageiro/edit', ['user' => $user], $user->id);
        }
    }

    public function selectdropdowndestino(){
        $this->loginFilterbyRole('passageiro');
        $selection = Post::get('iddestino');
        $date = date('Y-m-d', time());
        $airport = Airports::all();
        if($selection == 0){
            $layover = Layover::all(array('conditions' => array('dateend >= ?', $date)  ,'order' => 'dateorigin asc'));
        }
        else{
            $layover = Layover::all(array('conditions' => array('idaeroportodestino = ? and dateend >= ?', $selection, $date) ,'order' => 'dateorigin asc'));
        }
        return View::make('passageiro.voos', ['layover' => $layover, 'airport' => $airport]);
    }

    public function selectdropdownorigem(){
        $this->loginFilterbyRole('passageiro');
        $selection = Post::get('idorigem');
        $date = date('Y-m-d', time());
        $airport = Airports::all();
        if($selection == 0){
            $layover = Layover::all(array('conditions' => array('dateend >= ?', $date)  ,'order' => 'dateorigin asc'));
        }else{
            $layover = Layover::all(array('conditions' => array('idaeroportoorigem = ? and dateend >= ?', $selection, $date) ,'order' => 'dateorigin asc'));
        }
        return View::make('passageiro.voos', ['layover' => $layover, 'airport' => $airport]);
    }

    public function selectdropdownstartend(){
        $this->loginFilterbyRole('passageiro');
        $origem = Post::get('idorigem');
        $destino = Post::get('iddestino');
        $date = date('Y-m-d', time());
        $airport = Airports::all();
        $flights = Flight::all();
        $user = User::find([$_SESSION['APPuserid']]);
        if($origem == 0){
        }
        else{
            $layover = Layover::all(array('conditions' => array('idaeroportoorigem = ? and idaeroportodestino >= ?', $origem, $destino) ,'order' => 'dateorigin asc'));
        }
        return View::make('passageiro.bilhete', ['user' => $user,'layover' => $layover, 'airport' => $airport , 'flights' => $flights]);
    }

    public function selectdropdowntime(){
        $this->loginFilterbyRole('passageiro');
        $date = date('Y-m-d', time());
        $partida = Post::get('idpartida');
        $chegada = Post::get('idchegada');
        $flights = Flight::all();
        $user = User::find([$_SESSION['APPuserid']]);
        $airport = Airports::all();
        if($partida == ""){
            $layover = Layover::all(array('conditions' => array('dateend >= ?', $date)  ,'order' => 'dateorigin asc'));
        }else{
            $layover = Layover::all(array('conditions' => array('dateorigin = ? and dateend >= ?', $partida, $chegada) ,'order' => 'dateorigin asc'));
        }
        return View::make('passageiro.bilhete',  ['user' => $user,'layover' => $layover, 'airport' => $airport , 'flights' => $flights]);
    }

    public function historicoindex(){
        $this->loginFilterbyRole('passageiro');
        $user = User::find([$_SESSION['APPuserid']]);
        $flightsales = Flightsales::all(array('conditions' => array('iduser = ?', $user->id)));
        Debug::barDump($flightsales);
        return View::make('passageiro.historico', ['flightsales' => $flightsales]);
    }

}