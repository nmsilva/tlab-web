<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'inverse', // null or 'inverse'
    'brand'=>'',
    'brandUrl'=>'#',
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
            array(
                    'class'=>'bootstrap.widgets.TbMenu',
                    'items'=>array(
                            array('label'=>'Dashboard', 'url'=>$this->createUrl('/portal'),),
                            array('label'=>'Instituições', 'url'=>'#', 'items'=>array(
                                    array('label'=>'Listar Instituições', 'url'=> $this->createUrl('/portal/instituicoes/index')),
                            )),
                            array('label'=>'Sensores', 'url'=>'#', 'items'=>array(
                                    array('label'=>'Consultar Sensores', 'url'=> $this->createUrl('/portal/sensores/index')),
                                    
                            )),
                            array('label'=>'Relatórios', 'url'=>'#', 'items'=>array(
                                    array('label'=>'Gerar Relatório', 'url'=>$this->createUrl('/portal/relatorios/index')),
                            )),
                    ),
            ),
            array(
                    'class'=>'bootstrap.widgets.TbMenu',
                    'htmlOptions'=>array('class'=>'pull-right'),
                    'items'=>array(
                            array('label'=> user()->name, 'url'=>'#', 'items'=>array(
                                    array('label'=>'Opções de Conta', 'icon'=>'icon-user','url'=>$this->createUrl('/portal/conta/index')),
                                    array('label'=>'Alterar Palavra Passe', 'icon'=>'icon-lock', 'url'=>$this->createUrl('/portal/conta/password')),
                                    array('label'=>'Detalhes da Entidade', 'icon'=>'icon-pencil', 'url'=>$this->createUrl('/portal/conta/entidade')),
                                    '---',
                                    array('label'=>'Sair', 'icon'=>'icon-off','url'=> $this->createUrl('/portal/dashboard/logout')),
                            )),
                    ),
            ),
    ),
)); ?>