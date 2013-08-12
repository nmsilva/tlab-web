<?php

class CmsModule extends CWebModule
{
	private $_assetsUrl;

	public function init()
	{
                Yii::app()->session['translate']="cms";
                        
		if(user()->isGuest){
			user()->loginUrl=Yii::app()->createUrl('/cms/login');
			
			$this->defaultController="login";
			$this->layout="login";
		}
		else{
			if(user()->type != CMS_STATE)
				user()->loginRequired();
			else{
				$this->defaultController="dashboard";
				$this->layout="main";
			}
		}

		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'cms.models.*',
			'cms.components.*',
		));
                                
		$this->layoutPath="protected/modules/cms/views/layouts";

		
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

	public function getAssetsUrl()
        {
            if ($this->_assetsUrl === null)
                $this->_assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.modules.cms.assets') );
            return $this->_assetsUrl;
        }
}
