<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'menu-form',
	'enableAjaxValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'NOME',array('class'=>'span5','maxlength'=>255)); ?>   
        <?php echo CHtml::hiddenField('ID_MENU', $model->ID_MENU); ?>
        <br><br>            
        <div style="width: 100%; height: 40px;border-top:1px dotted #CCC;padding-top: 10px;">
            
            <?php echo CHtml::ajaxLink(t('Adicionar Item'),$this->createUrl('/cms/menus/createmenuitem',array('id'=>$model->ID_MENU)),array(
            'onclick'=>'js:openDialog()',
            'update'=>'#jobDialog',
            ),array('id'=>'showJobDialog',
                    'class'=>'button'));?>
            
            <?php echo CHtml::ajaxSubmitButton(t('Apagar Items'),array('menus/ajaxupdateitems','act'=>'delete'), array('success'=>'reloadGrid','error'=>'errorGrid'),array('class'=>'button')); ?>
        </div>
        
        <div class="content-box">
            <div class="content-box-header" style="padding: 5px;">
                <h3><?php echo t('Itens do Menu'); ?></h3>   
                <div style="float: right;">
                    <label style="float: left;margin-right: 15px;margin-top: 5px;"><?php echo t('Idioma:'); ?></label>
                    <?php echo CHtml::dropDownList('LANG_ID', Idioma::model()->getDefaultLang(),  
                    CHtml::listData(Idioma::model()->findAll(),'LANG_ID','DESCRI'),
                            array(
                              'ajax' => array(
                                'type'=>'POST', //request type
                                'url'=>$this->createUrl('/cms/menus/itemsmenu/id/'.$model->ID_MENU), //url to call
                                //'update'=>'#idiomas-content', //selector to update
                                'data'=>array('LANG_ID'=>'js:$(\'#Menu_LANG_ID\').val()'),
                                //'data'=>'js:javascript statement' 
                                //leave out the data key to pass all form values through
                                // another option to update or replace (will supersede those):
                                 'success'=>' function(data) { $(\'#list-content\').html(data) }',
                                 'error'=>'errorGrid',
                              ),//,'confirm' => 'foo',//, 'onchange' => 'alert("foo2")',
                              'id'=>'Menu_LANG_ID'
                          ));?>
                    <?php echo CHtml::ajaxSubmitButton(t('Gravar Items'),array('menus/ajaxupdateitems','act'=>'update'), array('success'=>'reloadGrid','error'=>'errorGrid'),array('class'=>'button','style'=>'margin-top:-9px;')); ?>
                </div>
            </div>
            <script language="javascript">
                
                function reloadGrid(data) {
                    //alert(data);
                    alert("Sucess!");
                    $('#list-content').load('<?php echo $this->createUrl('/cms/menus/itemsmenu/id/'.$model->ID_MENU); ?>', "", function(data){});
                }
                
                function errorGrid(data){
                    alert("<?php echo t('Ocurreu um erro durante o Pedido!'); ?>");
                }
                
                $(document).ready(function (){
                    $('#list-content').load('<?php echo $this->createUrl('/cms/menus/itemsmenu/id/'.$model->ID_MENU); ?>', "", function(data){});
                });
            </script>
            <div id="list-content" class="content-box-content" style="display: block; padding: 0 0 15px 0">
                
                
            </div>
        </div>          
	<div class="form-actions">
            <?php echo CHtml::submitButton(t('Finalizar'),array('name'=>'end','class'=>'bebutton')); ?>
	</div>
        
        <script language="javascript">
            
            function openDialog(){
                $('#jobDialog').dialog('open');
            }
            
            function editItem (url){
                $('#jobDialog').load(url);
                $("#jobDialog").dialog("open"); 
            }
            
        </script>
        
<?php $this->endWidget(); ?>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
        'id'=>'jobDialog',
        'options'=>array(
            'title'=>t('Adicionar Novo Item'),
            'autoOpen'=>false,
            'modal'=>'true',
            'width'=>'450px',
            'height'=>'auto',
        ),
        ));?>
 
<div id="jobDialog"></div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>