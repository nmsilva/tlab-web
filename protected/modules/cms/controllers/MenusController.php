<?php

class MenusController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';

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
				'actions'=>array('index','view',
                                                 'create','update','additem',
                                                 'itemsmenu','ajaxupdateitems','CreateMenuItem',
                                                 'sort','delete'),
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
        
        public function actionAddItem()
        {
            if(!empty($_POST['MenuItem']['ID_MENU_ITEM']))
                $model= $this->loadMenuItem($_POST['MenuItem']['ID_MENU_ITEM']);
            else
                $model=new MenuItem;
            
            $result=array();
            $result['sucess']=FALSE;
            
//            print_r($_POST);
            
            if(isset($_POST['MenuItem']))
            {
                    $model->attributes=$_POST['MenuItem'];
                    $model->MEN_ID_MENU_ITEM=$_POST['MenuItem']['MEN_ID_MENU_ITEM'];
                    
                    if($_POST['MenuItem']['TIPO']!=0)
                        $model->ID_CAT=NULL;
                    else
                        $model->ID_CAT=$_POST['MenuItem']['ID_CAT'];
                    
                    if($model->validate()){
                        if($model->save()){
                            $result['sucess']=TRUE;
                        }
                    }else
                        $result['errors']=$model->getErrors();
                        
            }              
            
            echo json_encode($result);
            
        }
        
	public function actionCreate()
	{       
                $this->pageTitle=t("Adicionar Novo Menu");
                
		$model=new Menu;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Menu']))
		{
			$model->attributes=$_POST['Menu'];
			if($model->save())
				$this->redirect(array('update','id'=>$model->ID_MENU));
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
		$model=$this->loadModel($id);
                
                $this->pageTitle=t("Editar ".$model->NOME);
                
                $item_menu=new MenuItem;
                                        
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $end=FALSE;
		if(isset($_POST['Menu']))
		{
			$model->attributes=$_POST['Menu'];
			if($model->save())
				$end=TRUE;
		}
                               
                if(isset($_POST['end']) && $end)
                    $this->redirect(array('index','id'=>$model->ID_MENU));

		$this->render('update',array(
			'model'=>$model,
                        'item_menu'=>$item_menu,
		));
	}
        
       public function actionSort()
       {      
            if (isset($_POST['items']) && is_array($_POST['items'])) {
                $i = 0;
                foreach ($_POST['items'] as $item) {
                    $project = MenuItem::model()->findByPk($item);
                    $project->ORDEM = $i;
                    $project->save();
                    $i++;
                }
            }
            
            
        }
        
        public function actionItemsMenu($id)
        {
                if(!isset($_POST['LANG_ID']))
                    $idioma=Idioma::model()->getDefaultLang();
                else
                    $idioma=$_POST['LANG_ID'];
                
                $model =new MenuItem;
                $model->ID_MENU=$id;
                $model->IDIOMA=$idioma;
                $provider=$model->search();
            
		$this->renderPartial('_list_items',array(
                        'model'=>$model,
			'dataProvider'=>$provider,
		));
        }
        
        public function actionCreateMenuItem($id,$item=""){
            
            $model=$this->loadModel($id);
            
            if($item)
                $item_menu=$this->loadMenuItem($item);
            else  
                $item_menu=new MenuItem;
            
            $this->renderPartial('_new_item',array(
                        'item_menu'=>$item_menu,
                        'model'=>$model,
		));
        }
        
        public function actionAjaxUpdateItems()
        {
            //print_r($_POST);
            
            $act = $_GET['act'];
            if($act=='update')
            {
                if($_POST){

                    $nomes=$_POST['NOME'];
                    if(count($nomes)>0)
                    {
                        foreach ($nomes as $id=>$value) {

                            $model=MenuItemIdioma::model()->findAll('ID_MENU_ITEM=:menu AND LANG_ID=:lang',array('menu'=>$id,'lang'=>$_POST['LANG_ID']));

                            if($model)
                                $model=$this->loadMenuItemIdioma($id,$_POST['LANG_ID']);
                            else{
                                $model=new MenuItemIdioma;
                                $model->LANG_ID=$_POST['LANG_ID'];
                                $model->ID_MENU_ITEM=$id;
                            }

                            $model->NOME=$value;
                            $model->DESCRICAO=$_POST['DESCRICAO'][$id];
                            $model->save();

                        }
                    }
                }
            }
            else if($act=='delete'){
                
                $autoIdAll = $_POST['autoId'];
                if(count($autoIdAll)>0)
                {
                    foreach($autoIdAll as $autoId)
                    {
                        MenuItemIdioma::model()->deleteAll('ID_MENU_ITEM=:menu',array('menu'=>$autoId));
                        
                        $model=$this->loadMenuItem($autoId);
                        if(!$model->delete())
                            throw new Exception("Sorry",500);

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
                $this->pageTitle=t("Lista de Menus");
                
		$model =new Menu('search');
        
                $model->unsetAttributes(); 
                if(isset($_GET['Menu'])) {
                    $model->attributes=$_GET['Menu'];

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
		$model=Menu::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        public function loadMenuItem($id)
        {
            $model=MenuItem::model()->findByPk($id);
            if($model===null)
                    throw new CHttpException(404,'The requested page does not exist.');
            return $model;
        }
        
        public function loadMenuItemIdioma($id_menu_item,$id_idioma)
	{
                $model= MenuItemIdioma::model()->findByPk(array('ID_MENU_ITEM'=>$id_menu_item,'LANG_ID'=>$id_idioma));

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
		if(isset($_POST['ajax']) && $_POST['ajax']==='menu-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
