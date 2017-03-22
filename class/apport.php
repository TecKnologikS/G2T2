<?php

class Apport
{
  public  $id_from;
  public  $id_to;
  public  $id_player;
  public  $qte;
  public  $datearrivee;


  function __construct() {
  	$this->id_from = 0;
  	$this->id_to = 0;
  	$this->id_player = 0;
  	$this->qte = 0;
  	$this->datearrivee = new DateTime('NOW');
  }


  public static function create($_from, $_to, $_player, $_qte, $_dt) {
    $instance = new self();
  	$instance->id_from = $_from ;
  	$instance->id_to = $_to;
  	$instance->id_player = $_player;
  	$instance->qte = $_qte;
  	$instance->datearrivee = $_dt;
    return $instance;
  }

}

 ?>
