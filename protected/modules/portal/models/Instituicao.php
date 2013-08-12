<?php

/**
 * This is the model class for table "instituicoes".
 *
 * The followings are the available columns in table 'instituicoes':
 * @property integer $ID_INST
 * @property integer $ID_ENT
 * @property string $IDENTIFICACAO
 *
 * The followings are the available model relations:
 * @property Compartimentos[] $compartimentoses
 * @property Entidades $iDENT
 */
class Instituicao extends PortalActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Instituicao the static model class
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
		return 'instituicoes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_ENT, IDENTIFICACAO', 'required'),
			array('ID_ENT', 'numerical', 'integerOnly'=>true),
			array('IDENTIFICACAO', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_INST, ID_ENT, IDENTIFICACAO', 'safe', 'on'=>'search'),
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
			'COMPARTIMENTOS' => array(self::HAS_MANY, 'Compartimento', 'ID_INST'),
			'ENTIDADE' => array(self::BELONGS_TO, 'Entidade', 'ID_ENT'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_INST' => t('ID'),
			'ID_ENT' => t('Entidade'),
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

		$criteria->compare('ID_INST',$this->ID_INST);
		$criteria->compare('ID_ENT',$this->ID_ENT);
		$criteria->compare('IDENTIFICACAO',$this->IDENTIFICACAO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function haveWarning()
        {
            $result=false;
            
            foreach ($this->COMPARTIMENTOS as $comp){

                if($comp->haveWarning())
                    $result=true;
                
            }
            
            return $result;
             
        }
        
        public function beforeDelete() {
            
            foreach ($this->COMPARTIMENTOS as $comp){
                $comp->delete();
            }
            
            return parent::beforeDelete();
        }
}