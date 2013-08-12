<?php

/**
 * This is the model class for table "objeto_idioma".
 *
 * The followings are the available columns in table 'objeto_idioma':
 * @property integer $OBJETO_ID
 * @property integer $LANG_ID
 * @property string $CONTENT
 * @property string $TITULO
 * @property string $EXCERTO
 * @property string $KEYWORDS
 */
class ArtigoIdioma extends CMSActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ObjetoIdioma the static model class
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
		return 'objeto_idioma';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('OBJETO_ID, LANG_ID', 'required'),
			array('OBJETO_ID, LANG_ID', 'numerical', 'integerOnly'=>true),
			array('TITULO, EXCERTO, KEYWORDS', 'length', 'max'=>255),
			array('CONTENT', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('OBJETO_ID, LANG_ID, CONTENT, TITULO, EXCERTO, KEYWORDS', 'safe', 'on'=>'search'),
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
			'OBJETO_ID' => t('Artigo'),
			'LANG_ID' => t('Idioma'),
			'CONTENT' => t('Conteúdo'),
			'TITULO' => t('Titulo'),
			'EXCERTO' => t('Excerto'),
			'KEYWORDS' => t('Keywords'),
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

		$criteria->compare('OBJETO_ID',$this->OBJETO_ID);
		$criteria->compare('LANG_ID',$this->LANG_ID);
		$criteria->compare('CONTENT',$this->CONTENT,true);
		$criteria->compare('TITULO',$this->TITULO,true);
		$criteria->compare('EXCERTO',$this->EXCERTO,true);
		$criteria->compare('KEYWORDS',$this->KEYWORDS,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}