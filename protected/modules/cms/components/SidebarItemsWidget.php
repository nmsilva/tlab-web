<?php
class SidebarItemsWidget extends CWidget
{
    public $form;
    public $model;
    public $term;
    public $selected_terms;
    public $key;
    
    public function init()
    {
        
    }
 
    public function run()
    {
        $this->render('_sidebar_items_widget');
    }
}