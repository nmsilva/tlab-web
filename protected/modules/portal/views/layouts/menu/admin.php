<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'inverse', // null or 'inverse'
    'brand'=>'',
    'brandUrl'=>'#',
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
            array(
                    'class'=>'bootstrap.widgets.TbMenu',
                    'items'=>array(
                            array('label'=>t('Dashboard'), 'url'=>$this->createUrl('/portal'),),
                            array('label'=>t('Utilizadores'), 'url'=>'#', 'items'=>array(
                                    array('label'=>t('Criar Conta'), 'url'=> $this->createUrl('/portal/utilizadores/create')),
                                    array('label'=>t('Listar Utilizadores'), 'url'=> $this->createUrl('/portal/utilizadores/index')),
                            )),
                            array('label'=>t('Entidades'), 'url'=>'#', 'items'=>array(
                                    array('label'=>t('Adicionar Entidade'), 'url'=> $this->createUrl('/portal/entidades/create')),
                                    array('label'=>t('Listar Entidades'), 'url'=> $this->createUrl('/portal/entidades/index')),
                            )),
                            array('label'=>t('Sensores'), 'url'=>'#', 'items'=>array(
                                    array('label'=>t('Configurar Novo'), 'url'=> $this->createUrl('/portal/configuracao/index')),
                                    array('label'=>t('Consultar Sensores'), 'url'=> $this->createUrl('/portal/sensores/index')),
                                    
                            )),
                            array('label'=>t('Relatórios'), 'url'=>'#', 'items'=>array(
                                    array('label'=>t('Gerar Relatório'), 'url'=>$this->createUrl('/portal/relatorios/index')),
                                    array('label'=>t('Relatório de Erros'), 'url'=>$this->createUrl('/portal/relatorios/index')),
                            )),
                            array('label'=>t('Definições'), 'url'=>'#', 'items'=>array(
                                    array('label'=>t('Unidades de Sensores'), 'url'=>$this->createUrl('/portal/definicoes/index')),
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
                                    '---',
                                    array('label'=>'Sair', 'icon'=>'icon-off','url'=> $this->createUrl('/portal/dashboard/logout')),
                            )),
                    ),
            ),
    ),
)); ?>