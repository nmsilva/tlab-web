<?php 

class UserLoginWidget extends CWidget
{
    public $title='User login';
    public $visible=true; 
    
    private $_state;

    public function init($state=PORTAL_STATE)
    {
        $this->_state=$state;

        if($this->visible)
        {
 
        }
    }
 
    public function run()
    {
        if($this->visible)
        {
            $this->renderContent();
        }
    }
 
    protected function renderContent()
    {
        if($this->_state == PORTAL_STATE)
            $form=new PortalLoginForm;
        else if($this->_state == CMS_STATE)
            $form=new CmsLoginForm;

        $this->render('user_login',array('model'=>$form));
    }   
}