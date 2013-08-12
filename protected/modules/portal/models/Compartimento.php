<?php

/**
 * This is the model class for table "compartimentos".
 *
 * The followings are the available columns in table 'compartimentos':
 * @property integer $ID_COMP
 * @property integer $ID_INST
 * @property string $IDENTIFICACAO
 *
 * The followings are the available model relations:
 * @property Instituicoes $iDINST
 * @property Equipamentos[] $equipamentoses
 * @property Sensores[] $sensores
 */
class Compartimento extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Compartimento the static model class
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
		return 'compartimentos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_INST, IDENTIFICACAO', 'required'),
			array('ID_INST', 'numerical', 'integerOnly'=>true),
			array('IDENTIFICACAO', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_COMP, ID_INST, IDENTIFICACAO', 'safe', 'on'=>'search'),
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
			'INSTITUICAO' => array(self::BELONGS_TO, 'Instituicao', 'ID_INST'),
			'EQUIPAMENTOS' => array(self::HAS_MANY, 'Equipamento', 'ID_COMP'),
			'SENSORES' => array(self::HAS_MANY, 'Sensor', 'ID_COMP'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_COMP' => 'Id Comp',
			'ID_INST' => 'Id Inst',
			'IDENTIFICACAO' => 'Identificacao',
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

		$criteria->compare('ID_COMP',$this->ID_COMP);
		$criteria->compare('ID_INST',$this->ID_INST);
		$criteria->compare('IDENTIFICACAO',$this->IDENTIFICACAO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function haveWarning()
        {
            $result=false;
                        
            foreach ($this->SENSORES as $sensor){
                    
                if($sensor->haveError() || !$sensor->isConect())
                    $result=true;
            }

            foreach ($this->EQUIPAMENTOS as $equip){


            }
            
            return $result;
             
        }
        
        public function beforeDelete() {
            
            foreach ($this->SENSORES as $sensor){
                $sensor->delete();
            }

            foreach ($this->EQUIPAMENTOS as $equip){
                $equip->delete();
            }
            
            return parent::beforeDelete();
        }
}