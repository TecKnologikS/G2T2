<?php
include('class/etat.php');
include('class/village.php');
include('class/apport.php');

$vivi = Village::create(1, new DateTime('2017-03-22 10:30:00'), 100000, 60000, 140000, 'test');
$vivi->addApport(Apport::create(1, 1, 1, 10000, new DateTime('2017-03-22 10:45:00')));
$vivi->addApport(Apport::create(1, 1, 1, 0, new DateTime('2017-03-22 11:00:00')));
$vivi->addApport(Apport::create(1, 1, 1, 10000, new DateTime('2017-03-22 11:30:00')));
$vivi->addApport(Apport::create(1, 1, 1, 20000, new DateTime('2017-03-22 12:00:00')));
$vivi->addApport(Apport::create(1, 1, 1, 10000, new DateTime('2017-03-22 13:00:00')));
//$vivi = Village::create(1, new DateTime('2017-03-22 12:30:00'), 78300, 12851, 160000, 'test'); //environ 18h35
//$vivi->addApport(Apport::create(1, 1, 1, 0, new DateTime('2017-03-23 12:30:00')));
$vivi->calcul();
var_dump($vivi->getData());
echo '<br /><br />';
var_dump($vivi->getAlert());

 ?>
