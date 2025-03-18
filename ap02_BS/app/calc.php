<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

//ochrona kontrolera - poniższy skrypt przerwie przetwarzanie w tym punkcie gdy użytkownik jest niezalogowany
include _ROOT_PATH.'/app/security/check.php';

// 1. pobranie parametrów
function getParams(&$kwota,&$lat,&$oprocentowanie){
	$kwota = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
	$lat = isset($_REQUEST['lata']) ? $_REQUEST['lata'] : null;
	$oprocentowanie = isset($_REQUEST['op']) ? $_REQUEST['op'] : null;	
}


// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$kwota,&$lat,&$oprocentowanie,&$messages){
	global $role;
	// sprawdzenie, czy parametry zostały przekazane
	if ( ! (isset($kwota) && isset($lat) && isset($oprocentowanie))) {
		//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
		// teraz zakładamy, ze nie jest to błąd. Po prostu nie wykonamy obliczeń
		return false;
	}

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $kwota == "") {
		$messages [] = 'Nie podano kwoty';
	}
	if ( $oprocentowanie == "") {
		$messages [] = 'Nie podano oporcentowania';
	}
	if ( $lat == "") {
		$messages [] = 'Nie podano lat';
	}

	//nie ma sensu walidować dalej gdy brak parametrów
	if (count ( $messages ) != 0) return false;
	
	// sprawdzenie, czy $x i $y są liczbami całkowitymi
	if (! is_numeric( $kwota)) {
		$messages [] = 'Kwota nie jest liczbą całkowitą';
	}
	
	if (! is_numeric( $oprocentowanie )) {
		$messages [] = 'Oprocentowanie nie jest liczbą całkowitą';
	}
	
	if (! is_numeric( $lat )) {
		$messages [] = 'Lata nie są liczbą całkowitą';
	}

	if ( $oprocentowanie < 10  && $role == 'user') {
		$messages [] = 'Oprocentowanie nie może być mniejsze niż 10, dla użytkownika';
	}

	if (count ( $messages ) != 0) return false;
	else return true;
}


// 3. wykonaj zadanie jeśli wszystko w porządku
function process(&$kwota,&$lat,&$oprocentowanie,&$messages,&$result){
	// sprawdzenie, czy parametry są liczbami
if (empty ( $messages )) { // gdy brak błędów
	
	//konwersja parametrów na int
	$kwota = intval($kwota);
	$oprocentowanie = floatval($oprocentowanie);
	$lat = intval($lat);
	
	//wykonanie operacji
	
	$stopa = ($oprocentowanie / 100 )* $lat;
	$kwota_calosc = $kwota + ($kwota * $stopa);
	$result = $kwota_calosc / ($lat * 12);
	$result = round($result, 2);
}
}

//definicja zmiennych kontrolera
$kwota = null;
$lat = null;
$oprocentowanie = null;
$result = null;
$messages = array();

//pobierz parametry i wykonaj zadanie jeśli wszystko w porządku
getParams($kwota,$lat,$oprocentowanie);
if ( validate($kwota,$lat,$oprocentowanie,$messages) ) { // gdy brak błędów
	process($kwota,$lat,$oprocentowanie,$messages,$result);
}

// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$operation,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';