
<div class="form-wrapper">
    <div id="form-sidebar" style="height: 50px;">
        
    </div>
    <div id="form-body">
        <div id="form-body-content">
        
            <p><?php echo t('O que é que deseja fazer hoje?'); ?></p>
            
            <ul class="shortcut-buttons-set">

                    <li>
                            <a href="<?php echo $this->createUrl('artigos/create'); ?>" class="shortcut-button">
                                    <span>
                                            <img alt="icon" src="<?php echo $this->module->assetsUrl .'/images/richtext.png'; ?>"><br />
                                            <?php echo t('Criar Artigo');?>
                                    </span>
                            </a>
                    </li>


                    <li>
                            <a href="<?php  echo $this->createUrl('menus/index'); ?>" class="shortcut-button">
                                    <span>
                                            <img alt="icon" src="<?php echo $this->module->assetsUrl.'/images/paper.png'; ?>"><br />
                                            <?php echo t('Gerir Lista Menus');?>
                                    </span>
                            </a>
                    </li>

                    <li>
                            <a href="<?php  echo $this->createUrl('media/create'); ?>" class="shortcut-button">
                                    <span>
                                            <img alt="icon" src="<?php echo $this->module->assetsUrl.'/images/upload_file.png'; ?>"><br />
                                            <?php echo t('Upload Ficheiro');?>
                                    </span>
                            </a>
                    </li>

            </ul>
            <div style="clear:both"></div>

            <div class="closed-box content-box">
                    <div class="content-box-header">
                        <h3><?php echo t('Estatisticas do Site');?></h3>                             
                    </div> 
                    <div class="content-box-content" style="display: block;">

                            <div class="tab-content default-tab" id="extra_box">
                                <?php echo t('Utilizadores Online: ').Yii::app()->counter->getOnline(); ?><br />
                                <?php echo t('Numero de Visitas Hoje: ').Yii::app()->counter->getToday(); ?><br />
                                <?php echo t('Numero de Visitas Ontem: ').Yii::app()->counter->getYesterday(); ?><br />
                                <?php echo t('Total de Visitas: ').Yii::app()->counter->getTotal(); ?><br />
                                <?php echo t('Máximo: ').Yii::app()->counter->getMaximal(); ?><br />

                            </div>                                     
                    </div>
            </div>

        </div>
    </div>
</div>
