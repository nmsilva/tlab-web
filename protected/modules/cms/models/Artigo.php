<?php

/**
 * This is the model class for table "objetos".
 *
 * The followings are the available columns in table 'objetos':
 * @property integer $OBJETO_ID
 * @property string $DATA_CRIACAO
 * @property integer $ESTADO
 * @property integer $COMENTS
 * @property string $TIPO
 * @property string $SLUG
 */
class Artigo extends CMSActiveRecord
{   
        public $TITULO;
        public $IDIOMA;
        public $ID_CAT;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Objeto the static model class
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
		return 'objetos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('SLUG','required','on'=>'update'),
                        array('SLUG','haveSlug','on'=>'update'),
			array('ESTADO, COMENTS', 'numerical', 'integerOnly'=>true),
			array('TIPO', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('OBJETO_ID, DATA_CRIACAO, ESTADO, COMENTS, TIPO, ID_CAT', 'safe', 'on'=>'search'),
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
                    'IMAGEM'=> array(self::BELONGS_TO, 'Media', 'ID_MEDIA'),
                    'CAT_OBJETO' => array(self::BELONGS_TO, 'ArtigoCategoria', 'OBJETO_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'OBJETO_ID' => 'ID',
			'DATA_CRIACAO' => 'Data Criação',
			'ESTADO' => 'Estado',
			'COMENTS' => 'Coments',
			'TIPO' => 'Tipo',
                        'ID_CAT'=>'Categoria',
                        'SLUG' => 'Identifação',
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
		//$criteria->compare('DATA_CRIACAO',$this->DATA_CRIACAO,true);
		$criteria->compare('ESTADO',$this->ESTADO);
		//$criteria->compare('COMENTS',$this->COMENTS);
		$criteria->compare('TIPO',$this->TIPO,true);
                
                $criteria->select="t.*,(SELECT titulo FROM objeto_idioma WHERE OBJETO_ID= t.OBJETO_ID and lang_id='".Idioma::model()->getDefaultLang()."') as TITULO"
                                  .", (SELECT ID_CAT FROM cat_objeto WHERE OBJETO_ID= t.OBJETO_ID LIMIT 1) as ID_CAT";
                
                $criteria->with=array('CAT_OBJETO');
                 
                $criteria->compare('CAT_OBJETO.ID_CAT', $this->ID_CAT);
                
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave() {
	    if ($this->isNewRecord){
                $this->DATA_CRIACAO = new CDbExpression('NOW()');
                $this->COMENTS = "0";
                $this->TIPO = "artigo";
            }
	 
	    return parent::beforeSave();
	}
        
        public function haveSlug($attribute)
        {
            $result=  Artigo::model()->count('SLUG=:slug and OBJETO_ID<>:id', array('slug'=>$this->$attribute,'id'=>$this->OBJETO_ID));
            
            if($result!=0)
              $this->addError($attribute, t('Já existe esta Identificação!'));
        }
        
}