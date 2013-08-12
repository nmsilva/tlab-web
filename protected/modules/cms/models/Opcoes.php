<?php

/**
 * This is the model class for table "opcoes_cms".
 *
 * The followings are the available columns in table 'opcoes_cms':
 * @property integer $ID_OPCAO
 * @property string $KEY_OPCAO
 * @property string $VALUE_OPCAO
 */
class Opcoes extends CMSActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Opcoes the static model class
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
		return 'opcoes_cms';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('KEY_OPCAO', 'length', 'max'=>255),
			array('VALUE_OPCAO', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_OPCAO, KEY_OPCAO, VALUE_OPCAO', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_OPCAO' => 'Id Opcao',
			'KEY_OPCAO' => 'Key Opcao',
			'VALUE_OPCAO' => 'Value Opcao',
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

		$criteria->compare('ID_OPCAO',$this->ID_OPCAO);
		$criteria->compare('KEY_OPCAO',$this->KEY_OPCAO,true);
		$criteria->compare('VALUE_OPCAO',$this->VALUE_OPCAO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function getDefaultIndexPage(){
            $model= Opcoes::model()->find('KEY_OPCAO=:key', array('key'=>'_index'));
            return $model->VALUE_OPCAO;
        }
        
        public static function getDefaultLang(){
            $model= Opcoes::model()->find('KEY_OPCAO=:key', array('key'=>'_lang'));
            return $model->VALUE_OPCAO;
        }
        
        public static function getSEOProperty($property,$lang='pt')
        {
            $model= Opcoes::model()->find('KEY_OPCAO=:key', array('key'=>$lang.'_'.$property));
            if($model)
                return $model->VALUE_OPCAO;
            
            return;
        }
}