<?php
App::uses('Component', 'Controller');
class OptionCommonComponent extends Component {
	public $day = array(
		1 => '1',
		2 => '2',
		3 => '3',
		4 => '4',
		5 => '5',
		6 => '6',
		7 => '7',
		8 => '8',
		9 => '9',
		10 => '10',
		11 => '11',
		12 => '12',
		13 => '13',
		14 => '14',
		15 => '15',
		16 => '16',
		17 => '17',
		18 => '18',
		19 => '19',
		20 => '20',
		21 => '21',
		22 => '22',
		23 => '23',
		24 => '24',
		25 => '25',
		26 => '26',
		27 => '27',
		28 => '28',
		29 => '29',
		30 => '30',
		31 => '31'
		);

	public $month = array(
		1 => 'JAN',
		2 => 'FEB',
		3 => 'MAR',
		4 => 'APR',
		5 => 'MAY',
		6 => 'JUN',
		7 => 'JUL',
		8 => 'AUG',
		9 => 'SEP',
		10 => 'OCT',
		11 => 'NOV',
		12 => 'DEC'
	);

	public $townships = array(
		1 => 'Ahlon',
		2 => 'Bahan',
		3 => 'Botataung',
		4 => 'Dagon',
		5 => 'Dagon Seikkan',
		6 => 'Dala',
		7 => 'Dawbon',
		8 => 'East Dagon',
		9 => 'Hlaing',
		10 => 'Hlaingthaya',
		11 => 'Insein',
		12 => 'Hlaingthaya',
		13 => 'Kamayut',
		14 => 'Kyauktada',
		15 => 'Kyimyindaing',
		16 => 'Lanmadaw',
		17 => 'Latha',
		18 => 'Mayangon',
		19 => 'Mingala Taungnyunt',
		20 => 'Mingaladon',
		21 => 'North Dagon',
		22 => 'North Okkalapa',
		23 => 'Pabedan',
		24 => 'Pazundaung',
		25 => 'Sanchaung',
		26 => 'Seikkan',
		27 => 'Shwepyitha',
		28 => 'South Dagon',
		29 => 'South Okkalapa',
		30 => 'Tamwe',
		31 => 'Thaketa',
		32 => 'Thingangyun',
		33 => 'Yankin'
	);

	public $job_type = array(
		1 => 'Washing',
		2 => 'Cleaning',
		3 => 'Deep Cleaning',
		4 => 'Ironing'
	);

	public $skill = array(
		1 => 'Good',
		2 => 'Fair',
		3 => 'Poor'
	);

	public $experience = array(
		1 => '1 year',
		2 => '2 years',
		3 => '3 years',
		4 => '4 years',
		5 => '5 years',
		6 => '6 years',
		7 => '7 years',
		8 => '8 years',
		9 => '9 years',
		10 => '10 years and above'
	);


	public function year() { //upto current year
		$tmp_year = array();
		for ($i = 1965; $i <= 2020; $i++) {
			$tmp_year[$i] = $i;
		}
		return $tmp_year;
	}

	public function next_three_years() { //current year plus next 3 years in admin company ,headhunter add
		$tmp_year = array();
		for ($i = 1965; $i <= date("Y")+3; $i++) {
			$tmp_year[$i] = $i;
		}
		return $tmp_year;
	}

	
// Admin pickup start year
	public function pickYear() { // from current year to 2030
		$pick_year = array();
		for ($i = date("Y"); $i <= 2030; $i++) {
			$pick_year[$i] = $i;
		}
		return $pick_year;
	}

}