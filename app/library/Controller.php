<?php

class Controller
{
    public function model($model)
    {
        require_once '../app/mopdels/' . $model . '.php'; // Incluir el archivo del modelo especificado
        return new $model; // Crear una instancia del modelo y devolverla
    }

    public function view($view, $data = [])
    {
        if (file_exists('../app/views/' . $view . '.php')) { // Verificar si existe el archivo de la vista especificada
            require_once '../app/views/' . $view . '.php'; // Incluir el archivo de la vista
        } else {
            die('La vista no existe'); // Mostrar un mensaje de error y terminar la ejecución si la vista no existe
        }
    }
}
