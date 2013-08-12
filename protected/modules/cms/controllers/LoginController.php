<?php

class LoginController extends Controller
{
	public function actionIndex()
	{

		if(user()->isGuest)
		{
			$model=new CmsLoginForm;

			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}
	                   
			// collect user input data
			if(isset($_POST['CmsLoginForm']))
			{
	                       
				$model->attributes=$_POST['CmsLoginForm'];
				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->login())
					$this->redirect(Yii::app()->createUrl('/cms/dashboard'));
			}
	                 
			$this->render('index',array('model'=>$model));
		}
		else{
			$this->redirect(Yii::app()->createUrl('/cms/dashboard'));
		}
	}

}