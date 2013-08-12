<?php

/**
 * This is the model class for table "sensores".
 *
 * The followings are the available columns in table 'sensores':
 * @property integer $ID_SENSOR
 * @property integer $ID_USER
 * @property integer $ID_COMP
 * @property integer $ID_UNI
 * @property integer $ID_EQUIP
 * @property string $IDENTIFICACAO
 * @property string $VMAX
 * @property string $VMIN
 * @property integer $ATIVO
 * @property string $EMAIL_ERRO
 * @property string $EMAIL_AVISO
 *
 * The followings are the available model relations:
 * @property Erros[] $erroses
 * @property Metricas[] $metricases
 * @property MetricasInstant[] $metricasInstants
 * @property Utilizadores $iDUSER
 * @property Compartimentos $iDCOMP
 * @property Equipamentos $iDEQUIP
 * @property Unidades $iDUNI
 */
class Sensor extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Sensor the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sensores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_UNI, IDENTIFICACAO, VMAX, VMIN', 'required'),
			array('ID_USER, ID_COMP, ID_UNI, ID_EQUIP, ATIVO', 'numerical', 'integerOnly'=>true),
			array('IDENTIFICACAO', 'length', 'max'=>100),
			array('VMAX, VMIN', 'length', 'max'=>8),
			array('EMAIL_ERRO, EMAIL_AVISO', 'length', 'max'=>150),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_SENSOR, ID_USER, ID_COMP, ID_UNI, ID_EQUIP, IDENTIFICACAO, VMAX, VMIN, ATIVO, EMAIL_ERRO, EMAIL_AVISO', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'ERROS' => array(self::HAS_MANY, 'Erro', 'ID_SENSOR'),
			'METRICAS' => array(self::HAS_MANY, 'Metrica', 'ID_SENSOR'),
			'METRICAS_INST' => array(self::HAS_MANY, 'MetricaInst', 'ID_SENSOR'),
			'USER' => array(self::BELONGS_TO, 'Utilizador', 'ID_USER'),
			'COMPARTIMENTO' => array(self::BELONGS_TO, 'Compartimento', 'ID_COMP'),
			'EQUIPAMENTO' => array(self::BELONGS_TO, 'Equipamento', 'ID_EQUIP'),
			'UNIDADE' => array(self::BELONGS_TO, 'Unidade', 'ID_UNI'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                        'ID_SENSOR' => t('ID'),
			'ID_COMP' => t('Compartimento'),
			'ID_EQUIP' => t('Equipamento'),
			'IDENTIFICACAO' => t('Identificação'),
			'VMAX' => t('Valor Máximo'),
			'VMIN' => t('Valor Minimo'),
                        'ID_USER' => t('Responsável'),
                        'ID_UNI' => t('Unidade'),
			'ATIVO' => 'Ativo',
			'EMAIL_ERRO' => t('Email'),
			'EMAIL_AVISO' => t('Email'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID_SENSOR',$this->ID_SENSOR);
		$criteria->compare('ID_USER',$this->ID_USER);
		$criteria->compare('ID_COMP',$this->ID_COMP);
		$criteria->compare('ID_UNI',$this->ID_UNI);
		$criteria->compare('ID_EQUIP',$this->ID_EQUIP);
		$criteria->compare('IDENTIFICACAO',$this->IDENTIFICACAO,true);
		$criteria->compare('VMAX',$this->VMAX,true);
		$criteria->compare('VMIN',$this->VMIN,true);
		$criteria->compare('ATIVO',$this->ATIVO);
		$criteria->compare('EMAIL_ERRO',$this->EMAIL_ERRO,true);
		$criteria->compare('EMAIL_AVISO',$this->EMAIL_AVISO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeValidate()
        {   
            
            if ($this->isNewRecord){                
                $this->ATIVO=0;
            }

            return parent::beforeValidate();
        }
        
        public function haveError()
        {
            $check_error=Erro::model()->find('ID_SENSOR=:sensor and VISTO=0 and TIPO=1', array('sensor'=>$this->ID_SENSOR));
            
            return (!$check_error)?false: true;
        }
        
        public function isConect()
        {
            // verifica se o tempo do ultima metrica registada foi superior a 1minuto
            $query='SELECT count(*) as num FROM metricas_instant WHERE ID_SENSOR='.$this->ID_SENSOR.' and DATA_REGISTO > now() - 60';

            $command = Yii::app()->db_portal->createCommand($query); 
            $result=$command->queryRow();
            
            return ($result['num']==0)?false:true;
                
        }
        
        public function getMetricasInst()
        {
            
            $query='SELECT * FROM metricas_instant WHERE ID_INST_METR = ( 
                    SELECT MAX(ID_INST_METR) FROM metricas_instant WHERE ID_SENSOR='.$this->ID_SENSOR.' and DATA_REGISTO > now() - 30)';

            $command = Yii::app()->db_portal->createCommand($query); 
            $result=$command->queryRow();
                         
            if(isset($result['VALOR'])){
                
                $val=null;
                if($this->UNIDADE->TVALOR=="int")
                    $val=(int)$result['VALOR'];
                else if($this->UNIDADE->TVALOR=="float")
                    $val=floatval($result['VALOR']);
                                
                return $val;
            
            }else {
                return $this->checkConection();
            }
            
        }
        
        public function verificaMaximos($val)
        {
            
        }
        
        public function addInstantMetrica($val)
        {
            $model=new MetricaInst;
            
            $this->actualizaMetricas();
            
            $model->DATA_REGISTO= new CDbExpression('NOW()');
            $model->ID_SENSOR=$this->ID_SENSOR;
            $model->VALOR=$val;
            
            $this->verificaMaximos($val);
            
            return $model->save();
        }
        
        public function actualizaMetricas()
        {

            $query='SELECT DATA_REGISTO FROM metricas WHERE  `ID_METRICA` = ( 
                    SELECT MAX(`ID_METRICA`) FROM metricas WHERE ID_SENSOR='.$this->ID_SENSOR.')';

            $command = Yii::app()->db_portal->createCommand($query); 
            $result=$command->queryRow();

            $data_registo=strtotime($result['DATA_REGISTO']);
            
            if($data_registo<time()-600)
                $this->adiconaMetrica();
            
        }
        
        public function adiconaMetrica()
        {
            $query='SELECT AVG(VALOR) as MEDIA, MIN(VALOR) as MIN, MAX(VALOR) as MAX 
                     FROM metricas_instant ';
            $where='WHERE DATA_REGISTO > now() - 600 and ID_SENSOR='.$this->ID_SENSOR;

            $command = Yii::app()->db_portal->createCommand($query.$where);       
            $result=$command->queryRow();

            $model=new Metrica;

            $model->ID_SENSOR=$this->ID_SENSOR;
            $model->DATA_REGISTO=new CDbExpression('NOW()');
            $model->VMEDIO=$result['MEDIA'];
            $model->VMIN=$result['MIN'];
            $model->VMAX=$result['MAX'];

            if($model->save())
            {          
                $select='DELETE FROM metricas_instant WHERE DATA_REGISTO < now() - 300 and ID_SENSOR='.$this->ID_SENSOR;
                $del_command = Yii::app()->db_portal->createCommand($select);
                $del_command->execute();
            }
            
        }
        
        public function checkConection()
        {
            $con=$this->isConect();
            if(!$con)
                $this->registaErro(1,"Comunicação","Falha de comunicação!");
            
            return $con;
        }
        
        public function registaErro($tipo,$identificacao,$desc)
        {
            // verifica se ja tem algum erro resgistado neste sensor que ainda n foi visualizado
            if(!$this->haveError())
            {
                $erro=new Erro;

                $erro->TIPO=$tipo;
                $erro->ID_SENSOR=$this->ID_SENSOR;
                $erro->IDENTIFICACAO=$identificacao;
                $erro->DESCRICAO=$desc;

                $erro->save();
            }
        }
        
        public function beforeDelete() {
            
            foreach ($this->ERROS as $erro){
                $erro->delete();
            }
            foreach ($this->METRICAS as $metrica){
                $metrica->delete();
            }
            foreach ($this->METRICAS_INST as $metrica_inst){
                $metrica_inst->delete();
            }
            
            return parent::beforeDelete();
        }
}