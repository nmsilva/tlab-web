<?php
class TitleWidget extends CWidget {
 
    public $title="";
    public $crumbs = array();
 
    public function run() {
        $this->render('title_widget');
    }
 
}
