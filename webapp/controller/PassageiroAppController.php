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
        $airport = Airports::all(array('conditions' => array('id != ?', 7)));
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

    public function compra(){
        $this->loginFilterbyRole('passageiro');
        $airport = Airports::all(array('conditions' => array('id != ?', 7)));
        $flights = Flight::all(array('conditions' => array('id != ?', 3)));
        $user = User::find([$_SESSION['APPuserid']]);
        $date = date('Y-m-d', time());
        $layover = Layover::all(array('conditions' => array('dateend >= ?', $date)  ,'order' => 'dateorigin asc'));
        return View::make('passageiro.compra', ['user' => $user,'layover' => $layover, 'airport' => $airport, 'flights' => $flights]);
    }

    public function storeflightsale($id)
    {
        $this->loginFilterbyRole('passageiro');
        //create new resource (activerecord/model) instance with data from POST
        //your form name fields must match the ones of the table fields
        $airport = Airports::all();
        $date = date('Y-m-d', time());
        $user = User::find([$_SESSION['APPuserid']]);

        $flightsales = new Flightsales(Post::getAll());
        $flightsales->iduser = $id;
        $date = date('Y-m-d H:m:s', time());
        $flightsales->datacompra = $date;

        if ($flightsales->idvoovolta == 0){
            $flightsales->idvoovolta = 3;
        }

        if(is_null($flightsales->idvooida) == true){
            $layover = Layover::all(array('conditions' => array('dateend >= ?', $date)  ,'order' => 'dateorigin asc'));
            Redirect::flashToRoute('passageiro/compra', ['user' => $user,'flightsales' => $flightsales, 'layover' => $layover, 'airport' => $airport]);
        }
        else{
            $ida = $this->sendPriceBack($flightsales->idvooida);
            if($flightsales->idvoovolta == 0){
                $volta = null;
            }else{
                $volta = $this->sendPriceBack($flightsales->idvoovolta);
            }

            $flightsales->precopago = $ida + $volta;

            if($flightsales->is_valid()){
                $flightsales->save();

                Redirect::toRoute('passageiro/bilhete', $flightsales->id);
            } else {
                //redirect to form with data and errors
                $layover = Layover::all(array('conditions' => array('dateend >= ?', $date)  ,'order' => 'dateorigin asc'));
                Redirect::flashToRoute('passageiro/compra', ['user' => $user,'flightsales' => $flightsales, 'layover' => $layover, 'airport' => $airport]);
            }
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

    //dropdown para os voos
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

    //dropdown para os voos
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
    //dropdown para a compra
    public function selectdropdownstartend(){
        $this->loginFilterbyRole('passageiro');
        $origem = Post::get('idorigem');
        $destino = Post::get('iddestino');
        $date = date('Y-m-d', time());
        $airport = Airports::all();
        $flights = Flight::all();
        $layover = Layover::all(array('conditions' => array('dateend >= ?', $date)  ,'order' => 'dateorigin asc'));

        $user = User::find([$_SESSION['APPuserid']]);
        if($origem == 0){
            return View::make('passageiro.compra', ['user' => $user,'layover' => $layover, 'airport' => $airport , 'flights' => $flights]);
        }
        else{
            $layover = Layover::all(array('conditions' => array('idaeroportoorigem = ? and idaeroportodestino >= ?', $origem, $destino) ,'order' => 'dateorigin asc'));
        }
        return View::make('passageiro.compra', ['user' => $user,'layover' => $layover, 'airport' => $airport , 'flights' => $flights]);
    }

    //dropdown para a compra
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
        return View::make('passageiro.compra',  ['user' => $user,'layover' => $layover, 'airport' => $airport , 'flights' => $flights]);
    }

    public function historicoindex(){
        $this->loginFilterbyRole('passageiro');
        $user = User::find([$_SESSION['APPuserid']]);
        $flightsales = Flightsales::all(array('conditions' => array('iduser = ?', $user->id)));
        return View::make('passageiro.historico', ['flightsales' => $flightsales]);
    }

    public function bilhete($id){
        $this->loginFilterbyRole('passageiro');
        $flightsales = Flightsales::find([$id]);
        $flightsida = Flight::find([$flightsales->idvooida]);
        $flightsvolta = Flight::find([$flightsales->idvoovolta]);
        return View::make('passageiro.bilhete',  ['flightsida' => $flightsida, 'flightsvolta' => $flightsvolta, 'flightsales' => $flightsales]);
    }

}