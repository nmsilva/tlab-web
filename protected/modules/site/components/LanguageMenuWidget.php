<?php
class LanguageMenuWidget extends CWidget {
 
    public $lang;
    
    public function run() {

        $current=Idioma::model()->find('LANG_ID=:id', array('id'=>$this->lang));
        
        $idiomas= Idioma::model()->findAll();
        
        $this->render('language_menu_widget',array('idiomas'=>$idiomas,'current'=>$current));
    }
 
}
