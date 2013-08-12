<?php

class ApiModule extends CWebModule
{        
	public function init()
	{
                // import the module-level models and components
		$this->setImport(array(
			'portal.models.*',
			'portal.components.*',
		));
                
                
	}

}
