<?php

/**
 * This is the model class for table "categoria_idioma".
 *
 * The followings are the available columns in table 'categoria_idioma':
 * @property integer $LANG_ID
 * @property integer $ID_CAT
 * @property string $NOME
 * @property string $TITULO
 * @property string $DESCRICAO
 * @property string $KEYWORDS
 */
class CategoriaIdioma extends CMSActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CategoriaIdioma the static model class
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
		return 'categoria_idioma';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('LANG_ID, ID_CAT', 'required'),
			array('LANG_ID, ID_CAT', 'numerical', 'integerOnly'=>true),
			array('NOME, TITULO, DESCRICAO, KEYWORDS', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('LANG_ID, ID_CAT, NOME, TITULO, DESCRICAO, KEYWORDS', 'safe', 'on'=>'search'),
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
			'ID_CAT' => 'Id Cat',
			'NOME' => 'Nome',
			'TITULO' => 'Titulo',
			'DESCRICAO' => 'Descricao',
			'KEYWORDS' => 'Keywords',
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
		$criteria->compare('ID_CAT',$this->ID_CAT);
		$criteria->compare('NOME',$this->NOME,true);
		$criteria->compare('TITULO',$this->TITULO,true);
		$criteria->compare('DESCRICAO',$this->DESCRICAO,true);
		$criteria->compare('KEYWORDS',$this->KEYWORDS,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}