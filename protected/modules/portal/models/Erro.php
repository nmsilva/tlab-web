<?php

/**
 * This is the model class for table "erros".
 *
 * The followings are the available columns in table 'erros':
 * @property integer $ID_ERRO
 * @property integer $ID_SENSOR
 * @property string $TIPO
 * @property string $DATA
 * @property string $IDENTIFICACAO
 * @property string $DESCRICAO
 * @property integer $VISTO
 * @property string $DATA_VISUALIZACAO
 *
 * The followings are the available model relations:
 * @property Sensores $iDSENSOR
 */
class Erro extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Erro the static model class
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
		return 'erros';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_SENSOR, DATA', 'required'),
			array('ID_SENSOR, VISTO', 'numerical', 'integerOnly'=>true),
			array('TIPO', 'length', 'max'=>5),
			array('IDENTIFICACAO', 'length', 'max'=>150),
			array('DESCRICAO', 'length', 'max'=>200),
			array('DATA_VISUALIZACAO', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_ERRO, ID_SENSOR, TIPO, DATA, IDENTIFICACAO, DESCRICAO, VISTO, DATA_VISUALIZACAO', 'safe', 'on'=>'search'),
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
			'SENSOR' => array(self::BELONGS_TO, 'Sensor', 'ID_SENSOR'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_ERRO' => t('ID'),
			'ID_SENSOR' => t('Sensor'),
			'TIPO' => t('Tipo'),
			'DATA' => t('Data'),
			'IDENTIFICACAO' => t('Identificacao'),
			'DESCRICAO' => t('Descricao'),
			'VISTO' => 'Visto',
			'DATA_VISUALIZACAO' => 'Data Visualizacao',
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

		$criteria->compare('ID_ERRO',$this->ID_ERRO);
		$criteria->compare('ID_SENSOR',$this->ID_SENSOR);
		$criteria->compare('TIPO',$this->TIPO,true);
		$criteria->compare('DATA',$this->DATA,true);
		$criteria->compare('IDENTIFICACAO',$this->IDENTIFICACAO,true);
		$criteria->compare('DESCRICAO',$this->DESCRICAO,true);
		$criteria->compare('VISTO',$this->VISTO);
		$criteria->compare('DATA_VISUALIZACAO',$this->DATA_VISUALIZACAO,true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeValidate()
        {   
            
            if ($this->isNewRecord){
                $this->DATA= new CDbExpression('NOW()');
                $this->VISTO=0;
            }

            return parent::beforeValidate();
        }
}