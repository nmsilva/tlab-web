<?php

class ConfiguracaoController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
        public function actionIndex()
        {
            $this->pageTitle=t('Configuração de Novo Sensor');
            
            $model=new configuracaoForm;
            $sensor=new Sensor;
            $equipamento=new Equipamento; 
            
            $this->render('index',array('model'=> $model,
                                        'sensor'=> $sensor,
                                        'equipamento'=> $equipamento));
        }
        
        public function actionDynamicInstituicoes()
        {
            if(isset($_POST['ID_ENT']))
            {
                $data=array_merge(array(array('IDENTIFICACAO'=>t('- Escolha Instituição -'))),
                        Instituicao::model()->findAll('ID_ENT=:ID_ENT', 
                        array(':ID_ENT'=>(int) $_POST['ID_ENT'])));
 
                $data=CHtml::listData($data,'ID_INST','IDENTIFICACAO');
                foreach($data as $value=>$name)
                {
                    echo CHtml::tag('option',
                               array('value'=>$value),CHtml::encode($name),true);
                }
            }
        }
        
        public function actionDynamicCompartimentos()
        {
            if(isset($_POST['ID_INST']))
            {
                $data=Compartimento::model()->findAll('ID_INST=:ID_INST', 
                        array(':ID_INST'=>(int) $_POST['ID_INST']));
 
                $data=CHtml::listData($data,'ID_COMP','IDENTIFICACAO');
                foreach($data as $value=>$name)
                {
                    echo CHtml::tag('option',
                               array('value'=>$value),CHtml::encode($name),true);
                }
            }
        }
        
        public function actionDynamicEquipamentos()
        {
            if(isset($_POST['ID_COMP']))
            {
                $data= array_merge(array(array('IDENTIFICACAO'=>t('- Escolha Equipamento -'))),
                        Equipamento::model()->findAll('ID_COMP=:ID_COMP', 
                        array(':ID_COMP'=>(int) $_POST['ID_COMP'])));
 
                $data=CHtml::listData($data,'ID_EQUIP','IDENTIFICACAO');
                foreach($data as $value=>$name)
                {
                    echo CHtml::tag('option',
                               array('value'=>$value),CHtml::encode($name),true);
                }
            }
        }
        
        public function actiongravaEquipamento()
        {
            $result['sucess']=false;
            if(isset($_POST['IDENTIFICACAO']))
            {
                $model=new Equipamento;
                
                $model->ID_COMP=$_POST['ID_COMP'];
                $model->IDENTIFICACAO=$_POST['IDENTIFICACAO'];
                
                if($model->save()){
                    $result['sucess']=true;
                    $result['id']=$model->ID_EQUIP;
                }
            }
            
            echo json_encode($result);
        }
        
        public function actiongravaSensor()
        {
            $result['sucess']=false;
            
            if(isset($_POST['Sensor']))
            {                
                $model=new Sensor;
                $form_conf=new configuracaoForm;
                
                $form_conf->attributes=$_POST['configuracaoForm'];
                $model->attributes=$_POST['Sensor'];
                $model->ID_COMP=$form_conf->ID_COMP[0];
                                
                if(empty($form_conf->CHECK_EQUIP))
                   $model->ID_EQUIP=$form_conf->ID_EQUIP;
                
                if($model->save())
                {
                    $result['sucess']=true;
                    $result['id']=$model->ID_SENSOR;
                }

            }
            
            echo json_encode($result);
        }
        
        public function actionTeste($id)
        {
            
            $sensor= $this->loadSensor($id);

            $this->render('index',array('sensor'=> $sensor));

        }
        
        public function loadSensor($id)
	{
		$model= Sensor::model()->findByPk($id);
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
                                             'DynamicInstituicoes',
                                             'DynamicCompartimentos', 
                                             'DynamicEquipamentos',
                                             'gravaEquipamento',
                                             'gravaSensor',
                                             'teste'),
                            'expression'=>'(havePermission($user->rule))'
                        ),
			array('deny',
                            'users'=>array('*'),
                        ),
		);
	}
}