<?php

/**
 * This is the model class for table "galerias".
 *
 * The followings are the available columns in table 'galerias':
 * @property integer $ID_GALERIA
 * @property string $NOME
 * @property string $DESCRICAO
 * @property string $DATA_CRIACAO
 *
 * The followings are the available model relations:
 * @property Medias[] $mediases
 */
class Galeria extends CMSActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Galeria the static model class
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
		return 'galerias';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NOME', 'required'),
			array('NOME, DESCRICAO', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_GALERIA, NOME, DESCRICAO, DATA_CRIACAO', 'safe', 'on'=>'search'),
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
			'mediases' => array(self::MANY_MANY, 'Medias', 'media_galeria(ID_GALERIA, ID_MEDIA)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_GALERIA' => t('ID'),
			'NOME' => t('Nome'),
			'DESCRICAO' => t('Descrição'),
			'DATA_CRIACAO' => t('Data Criação'),
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

		$criteria->compare('ID_GALERIA',$this->ID_GALERIA);
		$criteria->compare('NOME',$this->NOME,true);
		$criteria->compare('DESCRICAO',$this->DESCRICAO,true);
		$criteria->compare('DATA_CRIACAO',$this->DATA_CRIACAO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}