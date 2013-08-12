<?php
class accountDetailsWidget extends CWidget {
 
    public $assetsurl;
    
    public function run() {
        $model= Utilizador::model()->findByPk(user()->getId());
        
        $this->render('accountDetails',array('model'=>$model));
        
    }
 
}