<?php

/**
 * This is the model class for table "media_galeria".
 *
 * The followings are the available columns in table 'media_galeria':
 * @property integer $ID_MEDIA
 * @property integer $ID_GALERIA
 */
class MediaGaleria extends CMSActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MediaGaleria the static model class
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
		return 'media_galeria';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID_MEDIA, ID_GALERIA', 'required'),
			array('ID_MEDIA, ID_GALERIA', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_MEDIA, ID_GALERIA', 'safe', 'on'=>'search'),
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
			'ID_MEDIA' => 'Id Media',
			'ID_GALERIA' => 'Id Galeria',
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
		$criteria->compare('ID_GALERIA',$this->ID_GALERIA);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function getImagensGaleria($id_galeria)
        {
            
            $imagens=MediaGaleria::model()->findAll('ID_GALERIA=:id', array('id'=>$id_galeria));
            
            $result=array();
            foreach ($imagens as $key => $imagem) {
                
                $model=Media::model()->findByPk($imagem->ID_MEDIA);
                $filename=  Media::model()->getPublicUrl()."/".$model->PATH;
                
                $result[$key]['image']=$filename;
                $result[$key]['name']=$model->NOME;
                $result[$key]['desc']=$model->BODY;
                
            }
            
            return $result;
        }
}