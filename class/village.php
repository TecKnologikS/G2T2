<?php


class Village
{
	public  $id_vivi;
	public  $date_up;
	public  $cc;
	public  $actual_cc;
	public  $conso_cc;
	public  $silo;
	public  $nomvivi;
	public  $apports;
	public  $etat;

	function __construct() {
  	$id_vivi = 0;
  	$date_up = new DateTime('NOW');
  	$actual_cc = 0;
  	$cc = 0;
  	$silo = 0;
		$conso_cc = 0;
  	$nomvivi = 0;
  	$apports = [];
  	$etat = [];
  }

	public static function create($_id_vivi, $_date_up, $_cc, $c_cc, $_silo, $_nomvivi) {
		$instance = new self();

  	$instance->id_vivi = $_id_vivi;
  	$instance->date_up = $_date_up;
  	$instance->cc = $_cc;
  	$instance->actual_cc = 0;
		$instance->conso_cc = $c_cc;
  	$instance->silo = $_silo;
  	$instance->nomvivi = $_nomvivi;
  	$instance->apports = [];
  	$instance->etat = [];

    return $instance;
  }

	public function addApport($apport) {
		$this->apports[] = $apport;
	}

	public function calcul() {
		if (count($this->apports) == 0)
			return;

		/*** D'abors de la derniere maj jusqu'a maintenant ***/
		$tmp_cc = $this->cc;
		$tmp_i = 0;
		$tmp_heure = $this->date_up;


		while($this->apports[$tmp_i]->datearrivee < new DateTime('NOW')) {

			$since_start = $tmp_heure->diff($this->apports[$tmp_i]->datearrivee);

			$minutes = $since_start->days * 24 * 60;
			$minutes += $since_start->h * 60;
			$minutes += $since_start->i;

			$tmp_cc -= ($this->conso_cc * $minutes) / 60;
			if ($tmp_cc < 0)
				$tmp_cc = 0;

			//echo 'mouv : '.$tmp_i.' cc avant : '.$tmp_cc.' <br />';
			$tmp_cc += $this->apports[$tmp_i]->qte;
			//echo 'mouv : '.$tmp_i.' cc apres : '.$tmp_cc.' <br />';

			//------------------------------------
			$tmp_heure = $this->apports[$tmp_i]->datearrivee;

			$tmp_i++;
			if ($tmp_i >= count($this->apports))
				break;

			//var_dump($tmp_heure);
			//echo '<br />';
			//var_dump($this->apports[$tmp_i]->datearrivee);
			//echo '<br />';
			//var_dump(new DateTime('NOW'));
			//echo '<br />';
		}
		//echo 'tmp i = '.$tmp_i.'<br />';
		/*** On calcul la qte actuelle ***/
		$since_start = $tmp_heure->diff(new DateTime('NOW'));

		$minutes = $since_start->days * 24 * 60;
		$minutes += $since_start->h * 60;
		$minutes += $since_start->i;
		$tmp_cc -= ($this->conso_cc * $minutes) / 60;
		if ($tmp_cc < 0)
			$tmp_cc = 0;
		$tmp_heure = new DateTime('NOW');
		//echo 'mouv : '.$tmp_i.' cc maintenant : '.$tmp_cc.' <br />';
		$this->actual_cc = $tmp_cc;
		/*** Puis de maintenant jusqu'a +24h ***/
		//array_push($etat)
		for($i = $tmp_i; $i < count($this->apports); $i++) {
			$since_start = $tmp_heure->diff($this->apports[$i]->datearrivee);

			$minutes = $since_start->days * 24 * 60;
			$minutes += $since_start->h * 60;
			$minutes += $since_start->i;

			if (new DateTime('NOW') < $this->apports[$i]->datearrivee) {
				$tmp_cc -= ($this->conso_cc * $minutes) / 60;
				if ($tmp_cc < 0) {
					$this->etat[] = Etat::create(0, $this->apports[$i]->datearrivee->sub(new DateInterval('PT'.intval(($tmp_cc * -1) / ($this->conso_cc / 3600)).'S')));
					$tmp_cc = 0;
				}
				/*** 1 seconde avant --> sans l'apport ***/
				$this->etat[] = Etat::create($tmp_cc, $this->apports[$i]->datearrivee);


				/*** On up les tmp ***/
				//echo 'mouv : '.$i.' cc avant : '.$tmp_cc.' <br />';
				$tmp_cc += $this->apports[$i]->qte;
				//echo 'mouv : '.$i.' cc apres : '.$tmp_cc.' <br />';

				$tmp_heure = $this->apports[$i]->datearrivee;

				/*** avec l'apport ***/
				$this->etat[] = Etat::create($tmp_cc, $this->apports[$i]->datearrivee->add(new DateInterval('PT1S')));

				//print_r($this->etat);
			}
		}

	}

	public function getData() {
		return $this->etat;
	}

	public function getAlert() {
		$tmp = [];
		for($i = 0; $i < count($this->etat); $i++) {
			if ($this->etat[$i]->qte == 0) {
				$tmp[] = $this->etat[$i];
				$i++;
			}
		}
		return $tmp;
	}


}


?>
