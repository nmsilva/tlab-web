<?php

/**
 * This is the model class for table "categorias".
 *
 * The followings are the available columns in table 'categorias':
 * @property integer $ID_CAT
 * @property string $SLUG
 * @property integer $ESTADO
 *
 * The followings are the available model relations:
 * @property Objetos[] $objetoses
 * @property Idiomas[] $idiomases
 * @property MenuItem[] $menuItems
 */
class Categoria extends CMSActiveRecord
{
        public $TITULO;
        public $IDIOMA;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Categorias the static model class
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
		return 'categorias';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SLUG, ESTADO','required','on'=>'update'),
                        array('SLUG','haveSlug','on'=>'update'),
			array('ESTADO', 'numerical', 'integerOnly'=>true),
			array('SLUG', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID_CAT, SLUG, ESTADO, TITULO', 'safe', 'on'=>'search'),
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
			'objeto' => array(self::MANY_MANY, 'Objetos', 'cat_objeto(ID_CAT, OBJETO_ID)'),
			'categoria_idioma' => array(self::HAS_ONE, 'CategoriaIdioma', 'ID_CAT'),
                        'idiomas' => array(self::MANY_MANY, 'Idioma', 'idiomas(LANG_ID)'),
			'menuItems' => array(self::MANY_MANY, 'MenuItem', 'categoria_menu_item(ID_CAT, ID_MENU_ITEM)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID_CAT' => 'ID',
			'SLUG' => 'Identificador',
			'ESTADO' => 'Estado',
                        'TITULO_SEARCH'=>'Titulo',
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

		$criteria->compare('ID_CAT',$this->ID_CAT);
		$criteria->compare('SLUG',$this->SLUG,true);
		$criteria->compare('ESTADO',$this->ESTADO);
                                                
                $criteria->select="t.*,(SELECT titulo FROM categoria_idioma WHERE id_cat= t.id_cat and lang_id='".Idioma::model()->getDefaultLang()."') as TITULO";              
                
                $criteria->with=array('categoria_idioma');
                
                //$criteria->compare('categoria_idioma.ID_CAT',$this->ID_CAT);
                $criteria->compare('categoria_idioma.LANG_ID',Idioma::model()->getDefaultLang());
                $criteria->compare('categoria_idioma.TITULO', $this->TITULO,TRUE);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function haveSlug($attribute)
        {
            $result= Categoria::model()->count('SLUG=:slug and ID_CAT<>:id', array('slug'=>$this->$attribute,'id'=>$this->ID_CAT));
            
            if($result!=0)
              $this->addError($attribute, t('Já existe esta Identificação!'));
        }
        
        public static function getBySlug($slug){
            $model=self::model()->find('SLUG=:slug', array('slug'=>$slug));
            
            if($model)
                return $model;

            return;
        }
        
        public static function getTitleCategoria($id)
        {
            if($id)
            {
                $model= CategoriaIdioma::model()->findByPk(array('ID_CAT'=>$id,'LANG_ID'=>Opcoes::getDefaultLang()));

                return $model->TITULO; 
            }
            else
                return "---";
        }
        
}