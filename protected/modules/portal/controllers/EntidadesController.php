<?php

class EntidadesController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
        public function actionIndex()
        {
            $this->pageTitle=t('Listagem de Entidades');
            
            $model =new Entidade;

            if(isset($_GET['Entidade'])) {
                $model->attributes=$_GET['Entidade'];
            } 
            
            $provider=$model->search();
            
            $this->render('index',array(
                'model'=>$model,
                'dataProvider'=>$provider,
            ));
        }

	public function actionCreate()
        {
            $this->pageTitle=t('Nova Entidade');
            
            $foto = new FotoUploadForm;
            $model=new Entidade;
            
            $this->gravaRegisto($model,$foto);
            
            $this->render('create',array('model'=>$model,
                                         'foto'=>$foto));
        }
        
        public function actionUpdate($id)
        {
                        
            $foto = new FotoUploadForm;
            $model=$this->loadModel($id);
            $this->gravaRegisto($model,$foto);
            
            $this->pageTitle=$model->NOME;
            
            $model_2 =new Instituicao;
            $model_2->ID_ENT=$model->ID_ENT;
            if(isset($_GET['Instituicao'])) {
                $model_2->attributes=$_GET['Instituicao'];
            } 
            
            $provider=$model_2->search();
            
            $this->render('create',array('model'=>$model,
                                  'dataProvider'=>$provider,
                                          'foto'=>$foto));
        }
        
        private function gravaRegisto($model,$foto)
        {
           
            if(isset($_POST['Entidade']))
            {
                $model->attributes=$_POST['Entidade'];
                
                if($model->validate()){
                                        
                    $imagem=CUploadedFile::getInstance($foto,'file');                    
                    if(is_object($imagem))
                    {
                        $rnd=dechex(rand()%999999999);
                        $name=$rnd."_".$model->ID_ENT;

                        if(!empty($model->LOGO))
                            unlink(Helper::getFotoPath()."/".$model->LOGO);

                        $model->LOGO = "{$name}.{$imagem->getExtensionName()}";  // random number + file name

                        $path=Helper::getFotoPath()."/".$model->LOGO;
                        $imagem->saveAs($path);

                        $resize_image = Yii::app()->image->load($path);
                        $resize_image->resize(100, 100);
                        $resize_image->save();

                    }
                        
                    if($model->isNewRecord)
                        $message=t('Entidade registada com sucesso.');
                    else
                        $message=t('Entidade alterada com sucesso.');
                    
                    $model->save();
                    
                    Yii::app()->user->setFlash('success', '<strong>'.t('Sucesso').'!</strong> '.$message);

                    $this->redirect($this->createUrl('/portal/'.$this->id.'/update/id/'.$model->primaryKey));
                }
            }
        }
        
        public function loadModel($id)
	{
		$model= Entidade::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model; 
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
                        array('allow',
                            'actions'=>array('index',
                                             'create',
                                             'update', ),
                            'expression'=>'(havePermission($user->rule))'
                        ),
			array('deny',
                            'users'=>array('*'),
                        ),
		);
	}

}