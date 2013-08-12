<?php
class sidebarMenuWidget extends CWidget {
 
    public $items=array();
    
    public $currentUrl;
    
    public function run() {
        
        $this->render('sidebarMenu');
    }
 
}