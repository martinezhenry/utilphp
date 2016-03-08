<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Logger {

    private $ipRemota;
    private $path;
    private $fecha;
    private $navegador;
    private $tipoPeticion;
    private $cadenaConsulta;
    private $puertoPeticion;
    private $pathScript;
    private $uriPeticion;
    private $nameFile;
    private $clase;
    private static $instancia;

    const ERROR = 1;
    const INFO = 2;
    const DEBUG = 3;
    const WARN = 4;
    const FATAL = 5;

    /*     * **   CONTRUCT    *** */

    private function __construct($reaPath, $nameFile = 'log') {

        //$this->ipRemota = $_SERVER['REMOTE_ADDR'];
        
       // $reaPath = realpath('.') . '/logs';
        $this->nameFile = $nameFile;
        if (!file_exists($reaPath)) mkdir ($reaPath, 0777, true);
        
        $this->ipRemota = filter_input(INPUT_SERVER, 'REMOTE_ADDR');
        $this->fecha = date('d/m/Y');
        $this->navegador = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT');
        $this->path = $reaPath.'/'.$this->nameFile.'-' . date('Y-m-d') . '.log';
        $this->pathScript = filter_input(INPUT_SERVER, 'SCRIPT_FILENAME');
        $this->tipoPeticion = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
        $this->puertoPeticion = filter_input(INPUT_SERVER, 'REMOTE_PORT');
        $this->cadenaConsulta = filter_input(INPUT_SERVER, 'QUERY_STRING');
        $this->uriPeticion = filter_input(INPUT_SERVER, 'REQUEST_URI');

        $this->escribirPeticion();
    }

    /*     * **   DESTROY    *** */

    public function __destruct() {
        unset($this->fecha, $this->ipRemota, $this->navegador, $this->path, $this->cadenaConsulta, $this->pathScript, $this->puertoPeticion, $this->tipoPeticion, $this->uriPeticion);
    }

    /*     * **   GETTTERS AND SETTERS    *** */

    function getIpRemota() {
        return $this->ipRemota;
    }

    function getPath() {
        return $this->path;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getNavegador() {
        return $this->navegador;
    }

    function setIpRemota($ipRemota) {
        $this->ipRemota = $ipRemota;
    }

    private function setPath($path) {
        $this->path = $path;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setNavegador($navegador) {
        $this->navegador = $navegador;
    }

    function getCadenaConsulta() {
        return $this->cadenaConsulta;
    }

    function getPuertoPeticion() {
        return $this->puertoPeticion;
    }

    function getPathScript() {
        return $this->pathScript;
    }

    function getUriPeticion() {
        return $this->uriPeticion;
    }

    function setCadenaConsulta($cadenaConsulta) {
        $this->cadenaConsulta = $cadenaConsulta;
    }

    function setPuertoPeticion($puertoPeticion) {
        $this->puertoPeticion = $puertoPeticion;
    }

    function setPathScript($pathScript) {
        $this->pathScript = $pathScript;
    }

    function setUriPeticion($uriPeticion) {
        $this->uriPeticion = $uriPeticion;
    }

    function getTipoPeticion() {
        return $this->tipoPeticion;
    }

    function setTipoPeticion($tipoPeticion) {
        $this->tipoPeticion = $tipoPeticion;
    }
    
    function getNameFile() {
        return $this->nameFile;
    }

    function setNameFile($nameFile) {
        $this->nameFile = $nameFile;
    }
    
    function getClase() {
        return $this->clase;
    }

    function setClase($clase) {
        $this->clase = $clase;
    }

    
    /****   INSTANCIA    ****/
     public static function getInstancia($path, $nameFile = 'log')
    {
        
        if (!isset(self::$instancia)) {
            echo "crea instancia";
            $miclase = __CLASS__;
            var_dump($miclase);
            self::$instancia = new $miclase($path, $nameFile);
            
        } 
        return self::$instancia;
    }

    /****   METODOS    ****/

    public function escribirPeticion() {

        $data = PHP_EOL. date('Y-m-d H:i:s') . ' [ip] ' . $this->ipRemota . 
                ' [navegador] ' . $this->navegador . PHP_EOL . ' [uri] ' .
                $this->uriPeticion . ' [script] ' . $this->pathScript . PHP_EOL .
                ' [puerto] ' . $this->puertoPeticion . ' [metodo] ' . $this->tipoPeticion .PHP_EOL;

        $separador = PHP_EOL. '====================================================' . PHP_EOL;

        $result = (file_exists($this->path)) ?
                file_put_contents($this->path, $separador . $data . $separador . PHP_EOL, FILE_APPEND | LOCK_EX) :
                file_put_contents($this->path, $separador . $data . $separador);
        
        return $result;
    }
    
    public function escribirLog($text, $tipo) {
        switch ($tipo) {
            case 1 :
                $tipo = 'ERROR';
                break;
            case 2:
                $tipo = 'INFO';
                break;
            case 3:
                $tipo = 'DEBUG';
                break;
            case 4:
                $tipo = 'WARN';
                break;
            case 5:
                $tipo = 'FATAL';
                break;
            default:
                $tipo = 'ERROR';
                break;
        }
        $data = date('Y-m-d H:i:s') . ' [ip] ' . $this->ipRemota . ' ['.$this->clase.'] [' . $tipo . '] ' . $text . '.';
        $result = file_put_contents($this->path, $data. PHP_EOL, FILE_APPEND | LOCK_EX);
        return $result;
    }

}
