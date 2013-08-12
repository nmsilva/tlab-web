<?php
Yii::import("xupload.models.XUploadForm");
class MediaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
    
        public function actions() {
		return array('upload' => array('class' => 'xupload.actions.XUploadAction', 
                             'path' => Media::model()->getPath(), 
                             'publicPath' => Media::model()->getPublicUrl()));
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
				'actions'=>array('index','create','update','upload','delete'),
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
                $this->pageTitle=t("Adicionar Multimédia");
                
                $xmodel = new XUploadForm;
                
		$this->render('create',array(
                        'xmodel'=>$xmodel,
		));
	}
                
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

                if(isset($_POST['Media']))
		{         

			$model->attributes=$_POST['Media'];
                        
                        if($model->ID_MEDIA){
                            MediaGaleria::model()->deleteAll('ID_MEDIA='.$model->ID_MEDIA);   
                        }                        

                        if($model->save())
			{
                                          
                            if(isset($_POST['terms']))
                            {
                                foreach ($_POST['terms'] as $value) {
                                    $sec_model= new MediaGaleria;

                                    $sec_model->ID_MEDIA=$model->ID_MEDIA;
                                    $sec_model->ID_GALERIA=$value;

                                    $sec_model->save();
                                    unset($sec_model);

                                }
                            }
                            
                            if(isset($_POST['end']))
                                $this->redirect(array('index'));
                            else
                                Yii::app()->controller->refresh(); 

                        }

		}

                $temp=array();
                $temp['id']=0;
                $temp['lang']='pt';
                $temp['title']='Galerias';
                $temp['name']='portugues';
                $temp['terms']=array();


                //Look for the Term Items belong to this Taxonomy
                $list_terms= Galeria::model()->findAll();
                if($list_terms){
                    foreach($list_terms as $term) {                
                        $temp_item['id']=$term->ID_GALERIA;
                        $temp_item['name']=CHtml::encode($term->NOME);

                        $temp['terms']['item_'.$term->ID_GALERIA]=$temp_item;
                    }
                }

                $terms[0]=$temp;
                
                
                $temp=array();
                $temp['id']=0;
                $temp['lang']='pt';
                $temp['name']=t('Categorias');
                $temp['terms']=array();

                //Look for the Term Items belong to this Taxonomy
                $list_terms= MediaGaleria::model()->findAll(
                         array(
                             'condition'=>'ID_MEDIA=:id',
                             'params'=>array(':id'=>$model->ID_MEDIA)
                         ));
                if($list_terms){
                    foreach($list_terms as $term) {                
                        $temp_item['id']=$term->ID_GALERIA;                
                        $temp_item['name']= CHtml::encode(Galeria::model()->find('ID_GALERIA='.$term->ID_GALERIA)->NOME);

                        $temp['0']['terms']['item_'.$term->ID_GALERIA]=$temp_item;
                    }
                }

                $selected_terms=$temp; 
                
		$this->render('update',array(
			'model'=>$model,
                        'terms'=>$terms,
                        'selected_terms'=>$selected_terms,
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
                        $model=$this->loadModel($id);
                                        
                        $file=Media::model()->getPath().$model->PATH;
                        $success = is_file( $file) && unlink($file);

                        MediaGaleria::model()->deleteAll('ID_MEDIA=:id', array('id'=>$model->ID_MEDIA));
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
		$this->pageTitle=t("Lista de Multimédia");
                
		$model =new Media('search');
        
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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Media('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Media']))
			$model->attributes=$_GET['Media'];

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
		$model=Media::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='media-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
