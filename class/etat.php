<?php

class Etat
{
  public $qte;
  public $date_etat;

  function __construct() {
    $qte = 0;
    $date_etat = new DateTime('NOW');
  }

  function __construct1($_qte, $_dt) {
    $qte = $_qte;
    $date_etat = $_dt;
  }


  public static function create($_qte, $_dt) {
    $instance = new self();
  	$instance->qte = $_qte;
    $instance->date_etat = $_dt;
    return $instance;
  }

}

?>
