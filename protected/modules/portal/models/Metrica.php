<?php

/**
 * This is the model class for table "metricas".
 *
 * The followings are the available columns in table 'metricas':
 * @property integer $ID_METRICA
 * @property integer $ID_SENSOR
 * @property string $DATA_REGISTO
 * @property string $VMEDIO
 * @property string $VMAX
 * @property string $VMIN
 *
 * The followings are the available model relations:
 * @property Sensores $iDSENSOR
 */
class Metrica extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Metrica the static model class
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
		return 'metricas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_SENSOR, DATA_REGISTO, VMEDIO', 'required'),
			array('ID_SENSOR', 'numerical', 'integerOnly'=>true),
			array('VMEDIO, VMAX, VMIN', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_METRICA, ID_SENSOR, DATA_REGISTO, VMEDIO, VMAX, VMIN', 'safe', 'on'=>'search'),
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
			'ID_METRICA' => 'Id Metrica',
			'ID_SENSOR' => 'Id Sensor',
			'DATA_REGISTO' => 'Data Registo',
			'VMEDIO' => 'Vmedio',
			'VMAX' => 'Vmax',
			'VMIN' => 'Vmin',
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

		$criteria->compare('ID_METRICA',$this->ID_METRICA);
		$criteria->compare('ID_SENSOR',$this->ID_SENSOR);
		$criteria->compare('DATA_REGISTO',$this->DATA_REGISTO,true);
		$criteria->compare('VMEDIO',$this->VMEDIO,true);
		$criteria->compare('VMAX',$this->VMAX,true);
		$criteria->compare('VMIN',$this->VMIN,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}