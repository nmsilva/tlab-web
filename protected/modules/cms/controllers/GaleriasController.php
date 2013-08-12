<?php
Yii::import("xupload.models.XUploadForm");
class GaleriasController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

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
				'actions'=>array('create','update','index','delete'),
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
                $this->pageTitle=t("Adicionar Nova Galeria");
                
		$model=new Galeria('search');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Galeria']))
		{
			$model->attributes=$_POST['Galeria'];
                        $model->DATA_CRIACAO = new CDbExpression('NOW()');
			if($model->save())
				$this->redirect(array('update','id'=>$model->ID_GALERIA));
		}
                
                
                
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
                $this->pageTitle=t("Editar Galeria");
                
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Galeria']))
		{
			$model->attributes=$_POST['Galeria'];
			if($model->save())
				$this->redirect(array('index','id'=>$model->ID_GALERIA));
		}
                
                $imagens= MediaGaleria::model()->getImagensGaleria($model->ID_GALERIA);
                
                $xmodel = new XUploadForm;
                
		$this->render('update',array(
			'model'=>$model,
                        'xmodel'=>$xmodel,
                        'imagens'=>$imagens,
		));
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
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

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
                $this->pageTitle=t("Lista de Galerias");
                
		$model =new Galeria;
        
                $model->unsetAttributes(); 
                if(isset($_GET['Galeria'])) {
                    $model->attributes=$_GET['Galeria'];
            
                } 
                
                $provider=$model->search();
                                
		$this->render('index',array(
                                    'model'=>$model,
                                    'dataProvider'=>$provider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Galeria::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='galeria-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
