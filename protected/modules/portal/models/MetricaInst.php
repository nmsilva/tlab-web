<?php

/**
 * This is the model class for table "metricas_instant".
 *
 * The followings are the available columns in table 'metricas_instant':
 * @property integer $ID_INST_METR
 * @property integer $ID_SENSOR
 * @property string $DATA_REGISTO
 * @property string $VALOR
 *
 * The followings are the available model relations:
 * @property Sensores $iDSENSOR
 */
class MetricaInst extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MetricaInst the static model class
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
		return 'metricas_instant';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_SENSOR, DATA_REGISTO', 'required'),
			array('ID_SENSOR', 'numerical', 'integerOnly'=>true),
			array('VALOR', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_INST_METR, ID_SENSOR, DATA_REGISTO, VALOR', 'safe', 'on'=>'search'),
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
			'ID_INST_METR' => 'Id Inst Metr',
			'ID_SENSOR' => 'Id Sensor',
			'DATA_REGISTO' => 'Data Registo',
			'VALOR' => 'Valor',
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

		$criteria->compare('ID_INST_METR',$this->ID_INST_METR);
		$criteria->compare('ID_SENSOR',$this->ID_SENSOR);
		$criteria->compare('DATA_REGISTO',$this->DATA_REGISTO,true);
		$criteria->compare('VALOR',$this->VALOR,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}