 <?php
                    $mycs=Yii::app()->getClientScript();                    
                    if(YII_DEBUG)
                        $ckeditor_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.cms.assets.ckeditor'), false, -1, true);                    
                    else
                        $ckeditor_asset=Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.cms.assets.ckeditor'), false, -1, false);                    
                    
                    $urlScript_ckeditor= $ckeditor_asset.'/ckeditor.js';
                    $urlScript_ckeditor_jquery=$ckeditor_asset.'/adapters/jquery.js';
                    $mycs->registerScriptFile($urlScript_ckeditor, CClientScript::POS_HEAD);
                    $mycs->registerScriptFile($urlScript_ckeditor_jquery, CClientScript::POS_HEAD);                    
?>

<div class="form">


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'object-form',
        'enableAjaxValidation'=>false,       
        )); 
?>
    
<div class="form-wrapper">
    <div id="form-sidebar">
            <?php  $this->renderPartial('_sidebar_form',array(
                                        'form'=>$form,
                                        'model'=>$model,
                                        'terms'=>$terms,
                                        'selected_terms'=>$selected_terms,
                                        'imagens'=>$imagens,
                                        'imagem'=>$imagem,)); ?>
    </div>
    <div id="form-body">
            <div id="form-body-content">
                    <?php echo $form->errorSummary($model); ?>
                
                    <script language="javascript">
                        function CKupdate(data){
                            
                            for ( instance in CKEDITOR.instances ){
                                if(data==null)
                                    data="";
                                CKEDITOR.instances[instance].updateElement();
                                CKEDITOR.instances[instance].setData(data);
                            }
                        }
                    </script>
            		<!-- //Render Partial for Object Language Zone & Name & Content-->
                    <?php  //$this->render('application.modules.cms.components.views.objeto.artigo_idiomas_content_widget',array('model'=>$model,'form'=>$form)); ?>
                    <div id="language-zone">
                        <label>Idioma: </label>
                        <?php echo CHtml::dropDownList('LANG_ID', Idioma::model()->getDefaultLang(),  
                            CHtml::listData(Idioma::model()->findAll(),'LANG_ID','DESCRI'),
                            array(
                                    'ajax' => array(
                                      'type'=>'POST', //request type
                                      'url'=>$this->createUrl('/cms/artigos/idiomas/'), //url to call
                                      //'update'=>'#idiomas-content', //selector to update
                                      'data'=>array('LANG_ID'=>'js:$(\'#ArtigoIdioma_LANG_ID\').val()','OBJETO_ID'=> $model->OBJETO_ID),
                                      'dataType'=>'json',
                                      //'data'=>'js:javascript statement' 
                                      //leave out the data key to pass all form values through
                                      // another option to update or replace (will supersede those):
                                       'success'=>' function(data) { $(\'#txt_title\').val(data.titulo); CKupdate(data.content); }',
                                    ),//,'confirm' => 'foo',//, 'onchange' => 'alert("foo2")',
                                    'id'=>'ArtigoIdioma_LANG_ID'
                                  ));?>
                        
                       

                    </div>
                        
                    <?php //echo $form->textFieldRow($model,'SLUG',array('class'=>'span5','maxlength'=>255)); ?>
                    
                    <div id="titlewrap">
                            <?php echo $form->textFieldRow($idioma_artigo,'TITULO',array('class'=>'specialTitle','tabindex'=>'1','id'=>'txt_title')); ?>								
                    </div>
                        
                    <?php if($idioma_artigo->isNewRecord):?>
                        
                        <script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/jquery.textchange.min.js"></script>
                        
                        <script language="javascript">
                            $('#txt_title').bind('textchange', function (event, previousText) {
                                var text=$(this).val().toLowerCase();
                                
                                text = text.replace(new RegExp(/\s/g),"_");
                                text = text.replace(new RegExp(/[àáâãäå]/g),"a");
                                text = text.replace(new RegExp(/æ/g),"ae");
                                text = text.replace(new RegExp(/ç/g),"c");
                                text = text.replace(new RegExp(/[èéêë]/g),"e");
                                text = text.replace(new RegExp(/[ìíîï]/g),"i");
                                text = text.replace(new RegExp(/ñ/g),"n");                
                                text = text.replace(new RegExp(/[òóôõö]/g),"o");
                                text = text.replace(new RegExp(/œ/g),"oe");
                                text = text.replace(new RegExp(/[ùúûü]/g),"u");
                                text = text.replace(new RegExp(/[ýÿ]/g),"y");
                                text = text.replace(new RegExp(/\W/g),"_");
            
                                $('#txt_slug').val(text);
                            });
                        </script>
                        
                    <?php endif;?>
                        
                    <div id="bodywrap">     
                        
                            <?php echo $form->textArea($idioma_artigo,'CONTENT',array('tabindex'=>'2','class'=>'specialContent','id'=>'ckeditor_content')); ?>  
                        
                    </div>
                    
                    <div class="row">

                    
                        <div class="form-actions">
                                <?php echo CHtml::submitButton(t('Gravar'),array('name'=>'save','class'=>'bebutton')); ?>
                                <?php echo CHtml::submitButton(t('Finalizar'),array('name'=>'end','class'=>'bebutton')); ?>
                        </div>

                    </div>

            </div>
    </div>
						
</div>
<br class="clear" />
<?php $this->endWidget(); ?>
</div><!-- form -->

                         
<!-- //Render Partial for Javascript Stuff -->
<?php  $this->renderPartial('_form_javascript',array('model'=>$model,'form'=>$form)); ?>

