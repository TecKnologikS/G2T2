<?php

include('class/etat.php');
include('class/village.php');
include('class/apport.php');

function roundToQuarterHour($minutes) {
    return $minutes - ($minutes % 15);
}

$vivi = Village::create(1, new DateTime('2017-03-22 15:30:00'), 100000, 60000, 140000, 'test');
$vivi->addApport(Apport::create(1, 1, 1, 10000, new DateTime('2017-03-22 15:45:00')));
$vivi->addApport(Apport::create(1, 1, 1, 0, new DateTime('2017-03-22 16:00:00')));
$vivi->addApport(Apport::create(1, 1, 1, 10000, new DateTime('2017-03-22 16:30:00')));
$vivi->addApport(Apport::create(1, 1, 1, 10000, new DateTime('2017-03-22 16:32:00')));
$vivi->addApport(Apport::create(1, 1, 1, 20000, new DateTime('2017-03-22 17:00:00')));
$vivi->addApport(Apport::create(1, 1, 1, 50000, new DateTime('2017-03-22 17:10:00')));
$vivi->addApport(Apport::create(1, 1, 1, 10000, new DateTime('2017-03-22 18:00:00')));
//$vivi = Village::create(1, new DateTime('2017-03-22 12:30:00'), 78300, 12851, 160000, 'test'); //environ 18h35
//$vivi->addApport(Apport::create(1, 1, 1, 0, new DateTime('2017-03-23 12:30:00')));
$vivi->calcul();
//var_dump($vivi->getData());
//echo '<br /><br />';
//var_dump($vivi->getAlert());

$tmp_dateheure = new DateTime('NOW');
$tmp_dateheure->setTime($tmp_dateheure->format('H'), roundToQuarterHour($tmp_dateheure->format('i')), 0);
$tmp_demain = clone $tmp_dateheure;
$tmp_demain->add(new DateInterval('P1D'));
echo 'la : '.$tmp_dateheure->format('Y-m-d H:i:s') . " <br />";
echo 'demain : '.$tmp_demain->format('Y-m-d H:i:s') . " <br />";
echo 'cc : '.$vivi->actual_cc.'<br />';
$tmp_cc = $vivi->actual_cc;
while ($tmp_dateheure < $tmp_demain) {
  $tmp = clone $tmp_dateheure;
  $tmp_apport = 0;
  $tmp_dateheure->add(new DateInterval('PT15M'));
  for($i = 0; $i < count($vivi->apports); $i++) {
    if ($vivi->apports[$i]->datearrivee >= $tmp && $vivi->apports[$i]->datearrivee < $tmp_dateheure) {
      $tmp_apport += $vivi->apports[$i]->qte;
    }
  }
  echo 'from '.$tmp->format('H:i:s').' to '.$tmp_dateheure->format('H:i:s').' apport de '.$tmp_apport.'<br />';

}


 ?>
