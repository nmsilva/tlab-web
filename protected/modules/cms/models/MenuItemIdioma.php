<?php

/**
 * This is the model class for table "item_menu_idioma".
 *
 * The followings are the available columns in table 'item_menu_idioma':
 * @property integer $LANG_ID
 * @property integer $ID_MENU_ITEM
 * @property string $NOME
 * @property string $DESCRICAO
 */
class MenuItemIdioma extends CMSActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MenuItemIdioma the static model class
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
		return 'item_menu_idioma';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('LANG_ID, ID_MENU_ITEM', 'required'),
			array('LANG_ID, ID_MENU_ITEM', 'numerical', 'integerOnly'=>true),
			array('NOME, DESCRICAO', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('LANG_ID, ID_MENU_ITEM, NOME, DESCRICAO', 'safe', 'on'=>'search'),
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
			'LANG_ID' => 'Lang',
			'ID_MENU_ITEM' => 'Id Menu Item',
			'NOME' => 'Nome',
			'DESCRICAO' => 'Descricao',
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

		$criteria->compare('LANG_ID',$this->LANG_ID);
		$criteria->compare('ID_MENU_ITEM',$this->ID_MENU_ITEM);
		$criteria->compare('NOME',$this->NOME,true);
		$criteria->compare('DESCRICAO',$this->DESCRICAO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}