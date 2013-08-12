<!-- begin main-->
<section id="content-body">

    <!-- begin wrapper-->
    <section class="wrapper">
        <div id="content">

            <div id="login-form">
                <span class="title">Iniciar Sessão na sua conta pessoal do tLab</span>
                <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id'=>'login-content',
                        'enableClientValidation'=>true,
                        'clientOptions'=>array(
                                'validateOnSubmit'=>true,
                        ),
                )); ?>
                
                    <div class="row">
                        <div class="span4">
                            <?php echo $form->error($model,'email',array('style'=>'text-align:left')); ?>
                            <?php echo $form->textField($model,'email',array('placeholder'=>'Email')); ?>
                            <?php echo $form->error($model,'senha',array('style'=>'text-align:left')); ?>
                            <?php echo $form->passwordField($model,'senha',array('placeholder'=>'Palavra Passe')); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="span4">
                            <input type="checkbox" value="">
                            <span class="sessao">Manter Sessão Iniciada</span>
                            <a href="">Recuperar Palavra-Passe</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="span4">
                            <?php  echo CHtml::submitButton(t('Entrar'),array('id'=>'login-content-button','class'=>'btn')); ?>
                        </div>
                    </div>
                
                <?php $this->endWidget(); ?>
                
            </div>
        </div>
    </section>
    <!-- end wrapper-->
</section>
<!-- end main-->