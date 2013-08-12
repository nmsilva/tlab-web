<?php

/**
 * This is the model class for table "idiomas".
 *
 * The followings are the available columns in table 'idiomas':
 * @property integer $LANG_ID
 * @property string $NOME
 * @property string $DESCRI
 * @property integer $ESTADO
 * @property string $SHORT
 * @property integer $REQUIRED
 * @property string $BANDEIRA
 *
 * The followings are the available model relations:
 * @property Categorias[] $categoriases
 * @property MenuItem[] $menuItems
 * @property Objetos[] $objetoses
 */
class Idioma extends CMSActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Idioma the static model class
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
		return 'idiomas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('BANDEIRA, NOME, DESCRI, SHORT','required'),
			array('ESTADO, REQUIRED', 'numerical', 'integerOnly'=>true),
			array('NOME, DESCRI', 'length', 'max'=>255),
			array('SHORT', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('LANG_ID, NOME, DESCRI, ESTADO, SHORT, REQUIRED', 'safe', 'on'=>'search'),
                        array('BANDEIRA', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'update'), // this 
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
			'categoriases' => array(self::MANY_MANY, 'Categorias', 'categoria_idioma(LANG_ID, ID_CAT)'),
			'menuItems' => array(self::MANY_MANY, 'MenuItem', 'item_menu_idioma(LANG_ID, ID_MENU_ITEM)'),
			'objetoses' => array(self::MANY_MANY, 'Objetos', 'objeto_idioma(LANG_ID, OBJETO_ID)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'LANG_ID' => 'ID',
			'NOME' => 'Nome',
			'DESCRI' => 'Descrição',
			'ESTADO' => 'Estado',
			'SHORT' => 'Nome Curto',
			'REQUIRED' => 'Obrigatório',
                        'BANDEIRA' => 'Bandeira',
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
		$criteria->compare('NOME',$this->NOME,true);
		$criteria->compare('DESCRI',$this->DESCRI,true);
		$criteria->compare('ESTADO',$this->ESTADO);
		$criteria->compare('SHORT',$this->SHORT,true);
		$criteria->compare('REQUIRED',$this->REQUIRED);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function getDefaultLang()
        {
            return Opcoes::model()->getDefaultLang();
        }
        
	
}