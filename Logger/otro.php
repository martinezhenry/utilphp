<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once 'Logger.php';

$logger = Logger::getInstancia('./');
$logger->setClase('otro2');
$logger->escribirLog("Se produjo un error", Logger::ERROR );
$logger->escribirLog("informacion", Logger::INFO);
$logger->escribirLog("debug", Logger::DEBUG);
$logger->escribirLog("adverterncia", Logger::WARN);
$logger->escribirLog("fatal", Logger::FATAL);
$logger->escribirLog("cualquiera", NULL);



$logger = Logger::getInstancia('./');
$logger->setClase('otro');
$logger->escribirLog("Se produjo un error", Logger::ERROR );
$logger->escribirLog("informacion", Logger::INFO);
$logger->escribirLog("debug", Logger::DEBUG);
$logger->escribirLog("adverterncia", Logger::WARN);
$logger->escribirLog("fatal", Logger::FATAL);
$logger->escribirLog("cualquiera", NULL);