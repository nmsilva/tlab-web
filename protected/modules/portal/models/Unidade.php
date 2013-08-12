<?php

/**
 * This is the model class for table "unidades".
 *
 * The followings are the available columns in table 'unidades':
 * @property integer $ID_UNI
 * @property string $IDENTIFICACAO
 * @property string $TVALOR
 *
 * The followings are the available model relations:
 * @property Sensores[] $sensores
 */
class Unidade extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Unidade the static model class
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
		return 'unidades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('IDENTIFICACAO', 'required'),
			array('IDENTIFICACAO', 'length', 'max'=>100),
			array('TVALOR', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_UNI, IDENTIFICACAO, TVALOR', 'safe', 'on'=>'search'),
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
			'SENSORES' => array(self::HAS_MANY, 'Sensor', 'ID_UNI'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_UNI' => t('ID'),
			'IDENTIFICACAO' => t('Identificacao'),
			'TVALOR' => t('Tipo de Valor'),
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

		$criteria->compare('ID_UNI',$this->ID_UNI);
		$criteria->compare('IDENTIFICACAO',$this->IDENTIFICACAO,true);
		$criteria->compare('TVALOR',$this->TVALOR,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function beforeDelete() {
            
            foreach ($this->SENSORES as $sensor){
                $sensor->delete();
            }
            
            return parent::beforeDelete();
        }
}