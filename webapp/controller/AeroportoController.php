<?php

use ArmoredCore\Controllers\BaseController;
use ArmoredCore\Interfaces\ResourceControllerInterface;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\View;

class AeroportoController extends BaseAuthController implements ResourceControllerInterface
{
    /**
     * Returns index view with all records
     */
    public function index()
    {
        $this->loginFilterbyRole('admin');
        $aeroportos = Airports::all();
        return View::make('aeroporto.index', ['aeroportos' => $aeroportos]);
    }

    public static function getAeroporto()
    {
        $aeroportos = Airports::all();
        return $aeroportos;
    }

    /**
     * Returns a view with a form to create a new record
     */
    public function create()
    {
        $this->loginFilterbyRole('admin');
        return View::make('aeroporto.create');
    }


    /**
     * Receives new record data through POST method and stores it in the DB table
     */
    public function store()
    {
        $this->loginFilterbyRole('admin');
        //create new resource (activerecord/model) instance with data from POST
        //your form name fields must match the ones of the table fields
        $aeroporto = new Airports(Post::getAll());

        if($aeroporto->is_valid()){
            $aeroporto->save();
            Redirect::toRoute('aeroporto/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('aeroporto/create', ['aeroportos' => $aeroporto]);
        }
    }


    /**
     * return a detailed view with record where PK = $id
     */
    public function show($id)
    {
        $this->loginFilterbyRole('admin');
        $aeroporto = Airports::find([$id]);

        if (is_null($aeroporto)) {
            //TODO redirect to standard error page
        } else {
            return View::make('aeroporto.show', ['aeroportos' => $aeroporto]);
        }
    }


    /**
     * return a editable form view with record where PK = $id
     */
    public function edit($id)
    {
        $this->loginFilterbyRole('admin');
        $aeroporto = Airports::find([$id]);

        if (is_null($aeroporto)) {
            //TODO redirect to standard error page
        } else {
            return View::make('aeroporto.edit', ['aeroportos' => $aeroporto]);
        }
    }


    /**
     * Receives record data through POST method and updates it in the DB table
     */
    public function update($id)
    {
        $this->loginFilterbyRole('admin');
        //find resource (activerecord/model) instance where PK = $id
        //your form name fields must match the ones of the table fields
        $aeroporto = Airports::find([$id]);
        $aeroporto->update_attributes(Post::getAll());

        if($aeroporto->is_valid()){
            $aeroporto->save();
            Redirect::toRoute('aeroporto/index');
        } else {
            //redirect to form with data and errors
            Redirect::flashToRoute('aeroporto/edit', ['aeroportos' => $aeroporto]);
        }
    }


    /**
     * deletes the record where PK = $id
     */
    public function destroy($id)
    {
        $this->loginFilterbyRole('admin');
        $aeroporto = Airports::find([$id]);
        $aeroporto->delete();
        Redirect::toRoute('aeroporto/index');
    }
}