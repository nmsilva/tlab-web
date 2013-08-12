<?php

/**
 * This is the model class for table "medias".
 *
 * The followings are the available columns in table 'medias':
 * @property integer $ID_MEDIA
 * @property string $NOME
 * @property string $BODY
 * @property string $PATH
 * @property string $TYPE
 * @property string $DATA_CRIACAO
 *
 * The followings are the available model relations:
 * @property Galerias[] $galeriases
 * @property Objetos[] $objetoses
 */
class Media extends CMSActiveRecord
{
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Media the static model class
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
		return 'medias';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DATA_CRIACAO, PATH, NOME', 'required'),
			array('NOME, PATH', 'length', 'max'=>255),
			array('TYPE', 'length', 'max'=>50),
			array('BODY', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_MEDIA, NOME, BODY, PATH, TYPE, DATA_CRIACAO', 'safe', 'on'=>'search'),
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
			'galeriases' => array(self::MANY_MANY, 'Galerias', 'media_galeria(ID_MEDIA, ID_GALERIA)'),
			'objetoses' => array(self::MANY_MANY, 'Objetos', 'objeto_media(ID_MEDIA, OBJETO_ID)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_MEDIA' => t('ID'),
			'NOME' => t('Nome'),
			'BODY' => t('Descrição'),
			'PATH' => t('Ficheiro'),
			'TYPE' => t('Tipo'),
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

		$criteria->compare('ID_MEDIA',$this->ID_MEDIA);
		$criteria->compare('NOME',$this->NOME,true);
		$criteria->compare('BODY',$this->BODY,true);
		$criteria->compare('PATH',$this->PATH,true);
		$criteria->compare('TYPE',$this->TYPE,true);
		$criteria->compare('DATA_CRIACAO',$this->DATA_CRIACAO,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function getPath()
        {
            return Yii::app()-> getBasePath() . "/../images/uploads";
        }
        
        public static function getPublicUrl(){
            return Yii::app()->getBaseUrl()."/images/uploads";
        }
}