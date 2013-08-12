<?php

class FrontController extends Controller
{
        public $lang;
        
        public function __construct($id, $module = null) {
                parent::__construct($id, $module);
                
                Yii::app()->counter->refresh();
                
                $app = Yii::app();
                if (isset($_GET['lang']))
                {
                    $app->language = $_GET['lang'];
                    $app->session['_lang'] = $app->language;
                    
                    
                    //$this->redirect(Yii::app()->request->getUrlReferrer(true));
                }
                else if (isset($app->session['_lang']))
                {
                    $app->language = $app->session['_lang'];
                }
                else{
                    $app->session['_lang'] = Idioma::model()->findByPk(Opcoes::model()->getDefaultLang())->SHORT;
                    $app->language = $app->session['_lang'];
                }
                
                $this->lang=$this->getAppLanguage();
                
                $this->pageTitle=Opcoes::model()->getSEOProperty('title',Yii::app()->language);
                $this->metaKeywords = Opcoes::model()->getSEOProperty('keywords',Yii::app()->language);
                $this->metaDescription = Opcoes::model()->getSEOProperty('desc',Yii::app()->language);
                $this->addMetaProperty('fb:app_id',Yii::app()->params['fbAppId']);

        }
        
        public function getAppLanguage()
        {
            $result= Idioma::model()->find('SHORT=:short',array('short' => Yii::app()->language));
            return $result->LANG_ID;
        }
        
	public function actions()
	{
               
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'MyCViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{       
                $this->redirect($this->createUrl('/site/front/page', array('view'=>Opcoes::model()->getDefaultIndexPage())));
	}
        
        public function actionCategoria()
	{                   
                $categoria=Categoria::model()->getBySlug($_GET['pages']);
                
                $artigo=null;
                if($categoria){
                    $artigo=ArtigoCategoria::model()->find('ID_CAT=:id', array('id'=>$categoria->ID_CAT));
                    $cat_idioma = CategoriaIdioma::model()->find('ID_CAT=:id AND LANG_ID=:lang', array('id'=>$categoria->ID_CAT,'lang'=>$this->lang));
                }
                
                $model=null;
                if($artigo){
                    $model=ArtigoIdioma::model()->findByPk(array('OBJETO_ID'=>$artigo->OBJETO_ID,'LANG_ID'=> $this->lang));
                }
                else
                    $model=new ArtigoIdioma;
                
                if(!$cat_idioma or $categoria->ESTADO==0)
                    $this->redirectError();
                
                $this->setPageProperties($cat_idioma);
                
		$this->render('categoria',array('model'=>$model,'cat_idioma'=>$cat_idioma));
	}
        
        private function setPageProperties($model)
        {
            $this->pageTitle = $model->TITULO.' | '.Opcoes::model()->getSEOProperty('title',Yii::app()->language);
            
            if(is_a($model, 'CategoriaIdioma'))
            {
                if($model->KEYWORDS!="")
                    $this->metaKeywords = $model->KEYWORDS;
                if($model->DESCRICAO!="")
                    $this->metaDescription = $model->DESCRICAO;
            }
        }
        
        public function redirectError()
        {
            $this->redirect($this->createUrl('/site/front/error'));
        }
        
        public function actionArtigo($name)
        {
            $artigo= Artigo::model()->find('SLUG=:slug', array('slug'=>$name));
            
            $model=null;
            if($artigo)
                $model= ArtigoIdioma::model()->findByPk (array('OBJETO_ID'=>$artigo->OBJETO_ID,'LANG_ID'=>$this->lang));
            
            if(!$model or $artigo->ESTADO==0)
                $this->redirectError();
            
            $this->setPageProperties($model);
            
            $this->render('artigo',array('model'=>$model,
                                         'artigo'=>$artigo));
        }
        
        public function actionError()
	{                   
		$this->render('error');
	}
        
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				// send email
				//mail(Yii::app()->params['adminEmail'],$subject,$model->mensage,$headers);

				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
                
                $cat_idioma = CategoriaIdioma::model()->find('ID_CAT=:id AND LANG_ID=:lang', array('id'=>'15','lang'=>$this->lang));

                if(!$cat_idioma)
                     $this->redirectError();

                $this->setPageProperties($cat_idioma);
                
		$this->render('contact',array('model'=>$model,'cat_idioma'=>$cat_idioma));
	}


	public function actionEntrar()
	{   
                $model=new PortalLoginForm;
                
                if(user()->isGuest)
		{
                    // if it is ajax validation request
                    if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
                    {
                            echo CActiveForm::validate($model);
                            Yii::app()->end();
                    }

                    // collect user input data
                    if(isset($_POST['PortalLoginForm']))
                    {

                            $model->attributes=$_POST['PortalLoginForm'];
                            // validate user input and redirect to the previous page if valid
                            if($model->validate() && $model->login())
                                    $this->redirect(Yii::app()->getUrlManager()->createUrl('/portal',array(),'',false));
                    }
                    

                    $this->render('entrar',array('model'=>$model));
                }
                else{
                        $this->redirect(Yii::app()->getUrlManager()->createUrl('/portal',array(),'',false));
                }
	}
        
        public function behaviors()
        {
            return array(
                'seo'=>array('class'=>'ext.seo.components.SeoControllerBehavior'),
            );
        }


}