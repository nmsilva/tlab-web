<?php

class MyCViewAction extends CViewAction
{
    public $defaultView="index";
    
    public function resolveView($viewPath)
    {
                    
            // start with a word char and have word chars, dots and dashes only
            if(preg_match('/^\w[\w\.\-]*$/',$viewPath))
            {
                    $view=strtr($viewPath,'.','/');
 
                    if(!empty($this->basePath))
                            $view=$this->basePath.'/'.$view;
                    if($this->getController()->getViewFile($view)!==false)
                    {
                            $categoria= Categoria::model()->find('SLUG=:slug', array('slug'=>$viewPath));                     
                            $model = CategoriaIdioma::model()->find('ID_CAT=:id AND LANG_ID=:lang', array('id'=>$categoria->ID_CAT,'lang'=>$this->controller->lang));
                            
                            if($model){
                                $this->controller->pageTitle=$model->TITULO.' | '.Opcoes::model()->getSEOProperty('title',Yii::app()->language);
                                if($model->KEYWORDS!="")
                                    $this->controller->metaKeywords = $model->KEYWORDS;
                                if($model->DESCRICAO!="")
                                    $this->controller->metaDescription = $model->DESCRICAO;
                            }
                            
                            $this->view=$view;
                            return;
                    }
                    else{

                        $this->controller->redirect(Yii::app()->baseUrl.'/'.Yii::app()->language.'/site/front/categoria/'.$view);
                    }
            }
                
                
    }
}
?>
