<?php

/*
Mapear la url ingresada en el navegador
1- Controlador 
2- Método
3- Parámetro
*/



class Core
{
    protected $controladorActual = 'Views'; // Controlador actual predeterminado
    protected $metodoActual = 'index'; // Método actual predeterminado
    protected $parametros = []; // Arreglo de parámetros

    public function __construct()
    {
        $url = $this->getUrl(); // Obtener la URL actual

        // Verificar si se proporcionó el nombre de un controlador en la URL
        // y si existe el archivo del controlador en la ruta especificada
        if (isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            $this->controladorActual = ucwords($url[0]); // Establecer el controlador actual
            unset($url[0]); // Eliminar el elemento del arreglo de la URL
        }

        // Incluir el archivo del controlador actual
        require_once '../app/controllers/' . $this->controladorActual . '.php';

        // Crear una instancia del controlador actual
        $this->controladorActual = new $this->controladorActual;

        // Verificar si se proporcionó el nombre de un método en la URL
        // y si el método existe en el controlador actual
        if (isset($url[1]) && method_exists($this->controladorActual, $url[1])) {
            $this->metodoActual = $url[1]; // Establecer el método actual
            unset($url[1]); // Eliminar el elemento del arreglo de la URL
        }

        // Establecer los parámetros (si existen) para llamar al método del controlador
        $this->parametros = $url ? array_values($url) : [];

        // Llamar al método del controlador actual con los parámetros especificados
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/'); // Obtener la URL y eliminar la barra diagonal final
            $url = filter_var($url, FILTER_SANITIZE_URL); // Filtrar y limpiar la URL
            $url = explode('/', $url); // Dividir la URL en elementos de un arreglo
            return array_filter($url); // Eliminar elementos vacíos del arreglo
        }
        return []; // Devolver un arreglo vacío si no se proporcionó una URL
    }
}
