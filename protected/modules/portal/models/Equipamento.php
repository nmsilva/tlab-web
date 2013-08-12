<?php

/**
 * This is the model class for table "equipamentos".
 *
 * The followings are the available columns in table 'equipamentos':
 * @property integer $ID_EQUIP
 * @property integer $ID_COMP
 * @property string $IDENTIFICACAO
 *
 * The followings are the available model relations:
 * @property Compartimentos $iDCOMP
 * @property Sensores[] $sensores
 */
class Equipamento extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Equipamento the static model class
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
		return 'equipamentos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_COMP', 'required'),
			array('ID_COMP', 'numerical', 'integerOnly'=>true),
			array('IDENTIFICACAO', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_EQUIP, ID_COMP, IDENTIFICACAO', 'safe', 'on'=>'search'),
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
			'COMPARTIMENTO' => array(self::BELONGS_TO, 'Compartimento', 'ID_COMP'),
			'SENSORES' => array(self::HAS_MANY, 'Sensor', 'ID_EQUIP'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_EQUIP' => t('ID'),
			'ID_COMP' => t('Compartimento'),
			'IDENTIFICACAO' => t('Identificação'),
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

		$criteria->compare('ID_EQUIP',$this->ID_EQUIP);
		$criteria->compare('ID_COMP',$this->ID_COMP);
		$criteria->compare('IDENTIFICACAO',$this->IDENTIFICACAO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function haveError()
        {
            $check_error=false;
            foreach ($this->SENSORES as $sensor)
            {
                if($sensor->haveError() || !$sensor->isConect())
                    $check_error=true;
            }
            
            return (!$check_error)?false: true;
        }
        
        public function beforeDelete() {
            
            foreach ($this->SENSORES as $sensor){
                $sensor->delete();
            }
            
            return parent::beforeDelete();
        }
}