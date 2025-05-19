<?php

require_once dirname(__FILE__).'/../config.php';
require_once _ROOT_PATH.'/lib/smarty/libs/Smarty.class.php';

class CalcCtrl {

    private $form = null;
    private $infos = [];
    private $messages = [];
    private $result = null;
    private $hide_intro = false;

    public function getParams(){
        $this->form['kwota'] = $_REQUEST['kwota'] ?? null;
        $this->form['lata'] = $_REQUEST['lata'] ?? null;
        $this->form['proc'] = $_REQUEST['proc'] ?? null;	
    }

    public function validate() {
        if (!isset($this->form['kwota'], $this->form['lata'], $this->form['proc'])) return false;
        $this->hide_intro = true;
        $this->infos[] = 'Przekazano parametry.';
        if ($this->form['kwota'] === "") $this->messages[] = 'Nie podano kwoty';
        if ($this->form['lata'] === "") $this->messages[] = 'Nie podano ilości lat';
        if ($this->form['proc'] === "") $this->messages[] = 'Nie podano oprocentowania';

        if (count($this->messages) === 0) {
            if (!is_numeric($this->form['kwota'])) $this->messages[] = 'Kwota nie jest liczbą';
            if (!is_numeric($this->form['lata'])) $this->messages[] = 'Lata nie są liczbą';
            if (!is_numeric($this->form['proc'])) $this->messages[] = 'Oprocentowanie nie jest liczbą';
        }

        return count($this->messages) === 0;
    }

    public function process() {
        $this->getParams();
        if ($this->validate()) {
            $this->infos[] = 'Parametry poprawne. Wykonuję obliczenia.';
            $kwota = intval($this->form['kwota']);
            $lat = intval($this->form['lata']);
            $proc = floatval($this->form['proc']) * 0.01 * $lat;
            $oprocentowanie = $proc * $kwota;
            $this->result = round(($oprocentowanie + $kwota) / 12, 2);
        }

        $smarty = new Smarty\Smarty();
        $smarty->assign('app_url', _APP_URL);
        $smarty->assign('root_path', _ROOT_PATH);
        $smarty->assign('page_title', 'BS kalkulator');
        $smarty->assign('page_description', 'Profesjonalne szablonowanie oparte na bibliotece Smarty');
        $smarty->assign('page_header', 'Szablony Smarty');
        $smarty->assign('hide_intro', $this->hide_intro);
        $smarty->assign('form', $this->form);
        $smarty->assign('result', $this->result);
        $smarty->assign('messages', $this->messages);
        $smarty->assign('infos', $this->infos);
        $smarty->display(_ROOT_PATH.'/app/CalcView.html');
    }
}
