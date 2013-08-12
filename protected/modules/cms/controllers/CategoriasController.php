<?php

class CategoriasController extends Controller
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
				'actions'=>array('index','view','create','update','idiomas','delete'),
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
                $this->pageTitle=t("Adcionar nova categoria");
            
		$model=new Categoria;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Categoria']))
		{
			$model->attributes=$_POST['Categoria'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->ID_CAT));
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
                $this->pageTitle=t("Editar categoria");
                
		$model=$this->loadModel($id);
                
		$categoria_idioma= $this->CategoriaIdiomaExists($id,Idioma::model()->getDefaultLang());
			

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(!empty($_POST))
		{	
                    
                    //print_r($_POST);
                    $model->attributes=$_POST['Categoria'];
                    
                    $categoria_idioma= $this->CategoriaIdiomaExists($id,$_POST['LANG_ID']);
                    $categoria_idioma->attributes=$_POST['CategoriaIdioma'];
                    
                    if(!$categoria_idioma->LANG_ID){
                        $categoria_idioma->ID_CAT=$id;
                        $categoria_idioma->LANG_ID=$_POST['LANG_ID'];
                    }
                    
                    $end=FALSE;
                    if($model->validate()){
                        $end=$model->save();
                    }
                    
                    
                    if($categoria_idioma->validate()){
                        $end=$categoria_idioma->save() && $end;
                    }                    
                    
                    if(isset($_POST['end']) && $end)
                        $this->redirect(array('index'));
//                    else
//                        Yii::app()->controller->refresh(); 
                               
                }

		$this->render('update',array(
			'model'=>$model,
			'categoria_idioma'=>$categoria_idioma,
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
                    
                        $model= $this->loadModel($id);
                        
                        $sql="UPDATE menu_item SET ID_CAT=NULL WHERE ID_CAT='$id'";
                        $command=Yii::app()->db_cms->createCommand($sql);
                        $command->execute();
                        
                        CategoriaIdioma::model()->deleteAll('ID_CAT=:id',array('id'=>$id));
                        ArtigoCategoria::model()->deleteAll('ID_CAT=:id',array('id'=>$id));
                        
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
                $this->pageTitle=t("Lista de categorias");
                
		$model =new Categoria('search');
        
                $model->unsetAttributes(); 
                if(isset($_GET['Categoria'])) {
                    $model->attributes=$_GET['Categoria'];
            
                } 
                
                $provider=$model->search();
                                
		$this->render('index',array(
                                    'model'=>$model,
                                    'dataProvider'=>$provider,
		));
                
                
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Categoria('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Categoria']))
			$model->attributes=$_GET['Categoria'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionIdiomas(){

                    
		//$id_cat="4";
		//$id_lang="2";

		$id_cat=$_POST['ID_CAT'];
		$id_lang=$_POST['LANG_ID'];
                
		$categoria_idioma= $this->CategoriaIdiomaExists($id_cat,$id_lang);
		
		//$categoria_idioma=new CategoriaIdioma;

		$this->renderPartial('_idiomas_content',array(
			'categoria_idioma'=>$categoria_idioma,
		));
	}		


	private function CategoriaIdiomaExists($id_cat,$id_lang="")
	{   
            
                $model= CategoriaIdioma::model()->find('ID_CAT=:id and LANG_ID=:id_lang', array(':id'=>$id_cat,':id_lang'=>$id_lang));
                                
                if(!$model)
                    $model= new CategoriaIdioma;
                
                return $model;
            
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Categoria::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadCategoriaIdioma($id_cat=null,$id_idioma=null)
	{
                $model=CategoriaIdioma::model()->findByPk(array('ID_CAT'=>$id_cat,'LANG_ID'=>$id_idioma));

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
		if(isset($_POST['ajax']) && $_POST['ajax']==='categorias-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
