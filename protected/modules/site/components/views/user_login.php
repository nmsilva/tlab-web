<?php $this->beginWidget('bootstrap.widgets.TbModal', 
                        array('id'=>'myModal','htmlOptions'=>array('style'=>'width:450px;'))); ?>

<div class="title-modal">
    <span>Entrar no Portal MySanus</span>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
</div>

<?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'login-form',
        'type'=>'horizontal',
    )); ?>

            
            <div class="control-group">
                <?php echo $form->labelEx($model,'Email:',array('class'=>'control-label','style'=>'width:100px;')); ?>
                <div class="controls" style="margin-left:120px;">
                    <?php echo $form->textField($model,'email',array('style'=>'width:80%;','class'=>'email-login')); ?>
                    <br><p class='error-email'></p>
                </div>
            </div>

            <div class="control-group ">
                <?php echo $form->labelEx($model,'Senha:',array('class'=>'control-label','style'=>'width:100px;')); ?>
                <div class="controls" style="margin-left:120px;">
                    <?php echo $form->passwordField($model,'senha',array('style'=>'width:80%;','class'=>'senha-login')); ?>
                    <br><p class='error-senha'></p>
                </div>
            </div>

            <div class="control-group ">
                <div class="controls" style="margin-left:120px;">
                    <?php echo CHtml::link('Esquecime da Senha','#'); ?>
                </div>
            </div>

            <div class="control-group ">
                <div class="controls" style="margin-left:120px;">
                    <?php echo CHtml::Button('Entrar',array('class'=>'button small green','onclick'=>'send();')); ?>
                </div>
            </div>


 
    <?php $this->endWidget(); ?>
 
<?php $this->endWidget(); ?>

<script type="text/javascript">

function send()
 {
 
   var data=$("#login-form").serialize();

  $.ajax({
       type: 'POST',
       url: '<?php echo Yii::app()->createAbsoluteUrl("/site/front/login"); ?>',
       data:data,
       success:function(data){

                $('#login-form input').removeClass('error');
                $('#login-form p').html("");

                if(data.sucess){
                  
                  window.location = "<?php echo Yii::app()->getUrlManager()->createUrl('/portal',array(),'',false);; ?>";
                }
                else{

                  if(data.errors.email){
                    $(".email-login").addClass('error');
                    $(".error-email").html(data.errors.email.toString());
                  }
                  if(data.errors.senha){
                     $(".senha-login").addClass('error');
                     $(".error-senha").html(data.errors.senha.toString());
                  }
                }

        },
        error: function(data) { // if error occured
             alert("Error occured.please try again");
             alert(data);
        },
     
       dataType:'json'
  });
 
}

</script>