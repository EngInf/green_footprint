<?php
/** @var EmpresaController $this */
/** @var Empresa $model */
$this->breadcrumbs=array(
	'Empresas'=>array('index'),
	$model->id,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Empresa::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Empresa::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
   <legend><?php echo Yii::t('AweCrud.app', 'Clientes e Simulacoes com esta') . ' ' . Empresa::label(); ?> <?php echo CHtml::encode($model) ?></legend>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'cliente-grid',
    'type' => 'striped condensed',
    'dataProvider' => $child_model->search_Empresa($parentID),
    'columns' => array(
        'id',
        'nome',
        'password',
        array(
            'name' => 'empresa',
            'value' => 'isset($data->empresa) ? $data->empresa : null',
            'filter' => CHtml::listData(Empresa::model()->findAll(), 'id', Empresa::representingColumn()),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{create}{view}{update}{delete}',
            'buttons' => array(
                'create' => array(
                    'label' => '+', // text label of the button
                    'url' => 'Yii::app()->createUrl("cliente/create", array("id"=>$data->id))',
                ),
                'view' => array(
                    'label' => 'r', // text label of the button
                    'url' => 'Yii::app()->createUrl("cliente/view", array("id"=>$data->id))',
                ),
                'update' => array(
                    'label' => 'u', // text label of the button
                    'url' => 'Yii::app()->createUrl("cliente/update", array("id"=>$data->id))',
                ),
                'delete' => array(
                    'label' => 'd', // text label of the button
                    'url' => 'Yii::app()->createUrl("cliente/delete", array("id"=>$data->id))',
                ),
            ),
        ),
    )
));

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'simulacao-grid',
    'type' => 'striped condensed',
    'dataProvider' => $child_model2->search_Empresa($parentID),
    'columns' => array(
        'id',
		'data',
        'consumo_total',
        'habitantes',
        'divisoes',
        array(
            'name' => 'empresa',
            'value' => 'isset($data->empresa) ? $data->empresa : null',
            'filter' => CHtml::listData(Empresa::model()->findAll(), 'id', Empresa::representingColumn()),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{create}{view}{update}{delete}',
            'buttons' => array(
                'create' => array(
                    'label' => '+', // text label of the button
                    'url' => 'Yii::app()->createUrl("simulacao/create", array("id"=>$data->id))',
                ),
                'view' => array(
                    'label' => 'r', // text label of the button
                    'url' => 'Yii::app()->createUrl("simulacao/view", array("id"=>$data->id))',
                ),
                'update' => array(
                    'label' => 'u', // text label of the button
                    'url' => 'Yii::app()->createUrl("simulacao/update", array("id"=>$data->id))',
                ),
                'delete' => array(
                    'label' => 'd', // text label of the button
                    'url' => 'Yii::app()->createUrl("simulacao/delete", array("id"=>$data->id))',
                ),
            ),
        ),
    )
)); ?>
</fieldset>