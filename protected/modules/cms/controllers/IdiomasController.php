<?php

class IdiomasController extends Controller
{       
    
        public $dir;
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
        
        public function __construct($id, $module = null) {
            
            $this->dir=Yii::getPathOfAlias('application.modules.site.assets.images.bandeiras');
            parent::__construct($id, $module);
        }

        /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','delete'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
                $this->pageTitle=t("adicionar novo idioma");
                
		$model=new Idioma;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
                $this->saveModel($model);
                
		
		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
                $this->pageTitle=t("editar idioma");
                
		$model=$this->loadModel($id);
               
		$this->saveModel($model);

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        private function saveModel($model){
            
                if(isset($_POST['Idioma']))
		{   
                        $model->attributes=$_POST['Idioma'];
                        
                        
                        $uploadedFile=CUploadedFile::getInstance($model,'BANDEIRA');
                        $fileName = "_{$model->SHORT}.{$uploadedFile->getExtensionName()}";  // random number + file name
                        $model->BANDEIRA = $fileName;
                        
                        if($model->validate() && $uploadedFile)
                        {   
                            $path_image= $this->dir."/".$fileName;
                                                       
                            if($uploadedFile->saveAs($path_image)){
                                if($model->save())
                                        $this->redirect(array('index'));
                            }
                        }
                        
		}
        }
        
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
                        ArtigoIdioma::model()->deleteAll('LANG_ID=:id',array('id'=>$id));
                        CategoriaIdioma::model()->deleteAll('LANG_ID=:id',array('id'=>$id));
                        MenuItemIdioma::model()->deleteAll('LANG_ID=:id',array('id'=>$id));
                        
			// we only allow deletion via POST request
			$model=$this->loadModel($id);
                        
                        $path_image=Yii::app()->getModule('site')->getBasePath()."/assets/images/bandeiras/".$model->BANDEIRA;
                        unlink($path_image);
                        
                        $model->delete();
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
                $this->pageTitle=t("Lista de Idiomas");
                
                $model =new Idioma('search');

                $model->unsetAttributes(); 
                if(isset($_GET['Idioma'])) {
                    $model->attributes=$_GET['Idioma'];

                } 

                $this->render('index',array(
                    'model'=>$model,
                    'dataProvider'=>$model->search(),
		));

	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Idioma('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Idioma']))
			$model->attributes=$_GET['Idioma'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Idioma::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='idioma-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
