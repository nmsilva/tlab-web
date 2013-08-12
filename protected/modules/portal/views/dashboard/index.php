<div class="span3">
    
    <?php echo  $this->renderPartial('sidebar'); ?>
    
</div><!--/span-->
<div class="span9">

    <h1 class="page-title">
        <i class="icon-home icon-white"></i>
        <?php echo $this->pageTitle;?>                   
    </h1>
    
    
    <div class="stat-container">
        <div class="stat-holder">                       
            <div class="stat">                          
                <span><?php echo $stats['entidades']; ?></span> 
                Entidades           
            </div> <!-- /stat -->                       
        </div> <!-- /stat-holder -->

        <div class="stat-holder">                       
            <div class="stat">                          
                <span><?php echo $stats['instituicoes']; ?></span>                            
                Instituições                           
            </div> <!-- /stat -->                       
        </div> <!-- /stat-holder -->

        <div class="stat-holder">                       
            <div class="stat">                          
                <span><?php echo $stats['compartimentos']; ?></span>                          
                Compartimentos                   
            </div> <!-- /stat -->                       
        </div> <!-- /stat-holder -->

        <div class="stat-holder">                       
            <div class="stat">                          
                <span><?php echo $stats['equipamentos']; ?></span>                         
                Equipamentos                           
            </div> <!-- /stat -->                       
        </div> <!-- /stat-holder -->
    </div>
    
    <div class="stat-container">
        <div class="stat-holder">                       
            <div class="stat">                          
                <span><?php echo $stats['sensores']; ?></span> 
                Sensores 
            </div> <!-- /stat -->                       
        </div> <!-- /stat-holder -->

        <div class="stat-holder">                       
            <div class="stat">                          
                <span><?php echo $stats['utilizadores']; ?></span>                            
                Utilizadores                           
            </div> <!-- /stat -->                       
        </div> <!-- /stat-holder -->

        <div class="stat-holder">                       
            <div class="stat">                          
                <span>0</span>                          
                                   
            </div> <!-- /stat -->                       
        </div> <!-- /stat-holder -->

        <div class="stat-holder">                       
            <div class="stat">                          
                <span>0</span>                         
                                           
            </div> <!-- /stat -->                       
        </div> <!-- /stat-holder -->
    </div>
    
    
    
    <?php $this->beginWidget('bootstrap.widgets.TbBox', array(
                'title' => t('Erros de Sensores'),
                'headerIcon' => 'icon-list-alt',
            )); ?>
    
        <div style="min-height: 200px; width: 100%;">

        </div>
    
    <?php $this->endWidget(); ?>
</div><!--/span-->
            
