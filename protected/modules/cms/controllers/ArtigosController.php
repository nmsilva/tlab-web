<?php
class ArtigosController extends Controller
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

        public function actions() {
		return array('upload' => array('class' => 'xupload.actions.XUploadAction', 'path' => Yii::app() -> getBasePath() . "/../images/uploads", "publicPath" => Yii::app()->getBaseUrl()."/images/uploads" ), );
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
            $this->pageTitle=t("Adicionar Artigo");
            
            $model=new Artigo;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Artigo']))
            {
                    $model->attributes=$_POST['Artigo'];
                    if($model->save())
                            $this->redirect(array('update','id'=>$model->OBJETO_ID));
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
                $this->pageTitle=t("Editar Artigo");
                
		$model=$this->loadModel($id);
                $idioma_artigo = $this->ArtigoIdiomaExists($id,Idioma::model()->getDefaultLang());
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                
                if(!empty($_POST))
		{   
                    //print_r($_POST);
                    //$model->attributes=$_POST['Artigo'];
                    
                    ArtigoCategoria::model()->deleteAll('OBJETO_ID='.$id);
                    if(isset($_POST['terms']))
                    {
                        foreach ($_POST['terms'] as $value) {
                            $artigo_categoria= new ArtigoCategoria;

                            $artigo_categoria->OBJETO_ID=$id;
                            $artigo_categoria->ID_CAT=$value;

                            $artigo_categoria->save();


                            unset($artigo_categoria);
                        }
                    }
                    
                    $model->attributes=$_POST['Artigo'];
                    $model->SLUG=$_POST['Artigo']['SLUG'];
                    $model->ID_MEDIA=$_POST['Artigo']['ID_MEDIA'];
                    
                    $idioma_artigo = $this->ArtigoIdiomaExists($id,$_POST['LANG_ID']);
                    $idioma_artigo->attributes=$_POST['ArtigoIdioma'];
                    
                    if(!$idioma_artigo->LANG_ID){
                        $idioma_artigo->OBJETO_ID=$id;
                        $idioma_artigo->LANG_ID=$_POST['LANG_ID'];
                    }
                                        
                    $end=FALSE;
                    if($idioma_artigo->validate())
                        $end=$idioma_artigo->save();
                                        
                    if($model->validate())
                        $end=$model->save() && $end;
                    
                    if(isset($_POST['end']) && $end)
                        $this->redirect(array('index'));

                }
                
                $temp=array();
                $temp['id']=0;
                $temp['lang']='pt';
                $temp['title']='Categorias';
                $temp['name']='portugues';
                $temp['terms']=array();


                //Look for the Term Items belong to this Taxonomy
                $list_terms= CategoriaIdioma::model()->findAll(
                         array(
                             'select'=>'*',
                             'condition'=>'LANG_ID=:id',
                             'params'=>array(':id'=>Idioma::model()->getDefaultLang())
                         ));
                if($list_terms){
                    foreach($list_terms as $term) {                
                        $temp_item['id']=$term->ID_CAT;
                        $temp_item['name']=CHtml::encode($term->TITULO);

                        $temp['terms']['item_'.$term->ID_CAT]=$temp_item;
                    }
                }

                $terms[0]=$temp;  

                $temp=array();
                $temp['id']=0;
                $temp['lang']='pt';
                $temp['name']=t('Categorias');
                $temp['terms']=array();

                //Look for the Term Items belong to this Taxonomy
                $list_terms= ArtigoCategoria::model()->findAll(
                         array(
                             'select'=>'*',
                             'condition'=>'OBJETO_ID=:id',
                             'params'=>array(':id'=>$model->OBJETO_ID)
                         ));
                if($list_terms){
                    foreach($list_terms as $term) {                
                        $temp_item['id']=$term->ID_CAT;                
                        $temp_item['name']=CHtml::encode(CategoriaIdioma::model()->find('LANG_ID='.Idioma::model()->getDefaultLang().' and ID_CAT='.$term->ID_CAT)->TITULO);

                        $temp['0']['terms']['item_'.$term->ID_CAT]=$temp_item;
                    }
                }

                $selected_terms=$temp; 
                
                $imagens= Media::model()->findAll();
                
                $imagem=null;
                if($model->IMAGEM)
                    $imagem=Media::model()->getPublicUrl()."/".$model->IMAGEM->PATH;
                                
                $this->render('update',array(
                        'model'=>$model,
                        'idioma_artigo'=>$idioma_artigo,
                        'terms'=>$terms,
                        'selected_terms'=>$selected_terms,
                        'imagens'=>$imagens,
                        'imagem'=>$imagem,
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
			$model= $this->loadModel($id);
                        
                        ArtigoIdioma::model()->deleteAll('OBJETO_ID=:id',array('id'=>$id));
                        
                        ArtigoCategoria::model()->deleteAll('OBJETO_ID=:id',array('id'=>$id));
                                
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
            $this->pageTitle=t("Lista de Artigos");
            
            $model =new Artigo('search');

            if(isset($_GET['Artigo'])) {
                $model->attributes=$_GET['Artigo'];

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
		$model=new Artigo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Objeto']))
			$model->attributes=$_GET['Objeto'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionIdiomas(){

		$id_lang=$_POST['LANG_ID'];
		$id_artigo=$_POST['OBJETO_ID'];

		$artigo_idioma= $this->ArtigoIdiomaExists($id_artigo,$id_lang);
		
                echo json_encode(array('titulo'=>$artigo_idioma->TITULO,
                                       'content'=>$artigo_idioma->CONTENT));

	}
        
        private function ArtigoIdiomaExists($id_artigo,$id_lang=""){
            
            $model=ArtigoIdioma::model()->find('OBJETO_ID=:id and LANG_ID=:id_lang', array(':id'=>$id_artigo,':id_lang'=>$id_lang));
            if(!$model)
                $model= new ArtigoIdioma;
            
            return $model;

        }
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Artigo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
                
	}
        
        public function loadArtigoIdioma($id_artigo,$id_lang){
                

                $model=ArtigoIdioma::model()->findByPk(array('OBJETO_ID'=>$id_artigo,'LANG_ID'=>$id_lang));

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
		if(isset($_POST['ajax']) && $_POST['ajax']==='objeto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
