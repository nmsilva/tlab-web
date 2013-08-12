<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'categorias-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="form-wrapper">
    <div id="form-sidebar">
        <?php if(!$model->isNewRecord): ?>

            <?php echo $this->renderPartial('_dados_gerais',array('form'=>$form,
                                                'model'=>$model,)); ?>   

        <?php endif; ?>
    </div>
    <div id="form-body">
            <div id="form-body-content">
                    
                    <?php echo $form->errorSummary($model); ?>
                
                    <?php if($model->isNewRecord): ?>
                
                            <?php echo $this->renderPartial('_dados_gerais',array('form'=>$form,
                                                                'model'=>$model,)); ?>
                    <?php endif; ?>
                
                
                    <?php if(!$model->isNewRecord): ?>

                        <div id="language-zone">
    
                            <div class="closed-box content-box">
                                    <div class="content-box-header" style="padding: 5px 5px;">
                                        <h3><?php echo t('Idiomas');?></h3> 
                                        <?php echo CHtml::dropDownList('LANG_ID', Idioma::model()->getDefaultLang(),  
                                        CHtml::listData(Idioma::model()->findAll(),'LANG_ID','DESCRI'),
                                                array(
                                                  'ajax' => array(
                                                    'type'=>'POST', //request type
                                                    'url'=>$this->createUrl('/cms/categorias/idiomas/'), //url to call
                                                    //'update'=>'#idiomas-content', //selector to update
                                                    'data'=>array('LANG_ID'=>'js:$(\'#CategoriaIdioma_LANG_ID\').val()','ID_CAT'=> $model->ID_CAT),
                                                    //'data'=>'js:javascript statement' 
                                                    //leave out the data key to pass all form values through
                                                    // another option to update or replace (will supersede those):
                                                     'success'=>' function(data) { $(\'#idiomas-content\').html(data) }',
                                                  ),//,'confirm' => 'foo',//, 'onchange' => 'alert("foo2")',
                                                  'id'=>'CategoriaIdioma_LANG_ID',
                                                  'style'=>'float:right;',
                                              ));?>
                                    </div> 
                                    <div class="content-box-content" style="display: block;">

                                            <div class="tab-content default-tab" id="idiomas-content">
                                                    <?php echo $this->renderPartial('_idiomas_content',array('form'=>$form,
                                                                'model'=>$model,
                                                                'categoria_idioma'=>$categoria_idioma,)); ?>
                                            </div>                                     
                                    </div>
                                     <?php if($categoria_idioma->isNewRecord):?>
                        
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
                            </div>

                        </div>
                    <?php endif; ?>  
                        
                    <div class="form-actions">
                            <?php echo CHtml::submitButton(t('Gravar'),array('name'=>'save','class'=>'bebutton')); ?>
                            <?php echo CHtml::submitButton(t('Finalizar'),array('name'=>'end','class'=>'bebutton')); ?>
                    </div>
                    
            </div>
    </div>
						
</div>

<?php $this->endWidget(); ?>
