<?php
/** @var PotenciaController $this */
/** @var Potencia $model */
$this->breadcrumbs=array(
	'Potencias'=>array('index'),
	$model->id,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Potencia::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Potencia::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?php echo Yii::t('AweCrud.app', 'Equipamentos com esta') . ' ' . Potencia::label(); ?> <?php echo CHtml::encode($model) ?></legend>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'equipamento-grid',
    'type' => 'striped condensed',
    'dataProvider' => $child_model->search_Potencia($parentID),
    'columns' => array(
        'id',
		'nome',
        'horas',
        'quantidade',
        'consumo',
        array(
            'name' => 'potencia',
            'value' => 'isset($data->potencia) ? $data->potencia : null',
            'filter' => CHtml::listData(Potencia::model()->findAll(), 'id', Potencia::representingColumn()),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{create}{view}{update}{delete}',
            'buttons' => array(
                'create' => array(
                    'label' => '+', // text label of the button
                    'url' => 'Yii::app()->createUrl("equipamento/create", array("id"=>$data->id))',
                ),
                'view' => array(
                    'label' => 'r', // text label of the button
                    'url' => 'Yii::app()->createUrl("equipamento/view", array("id"=>$data->id))',
                ),
                'update' => array(
                    'label' => 'u', // text label of the button
                    'url' => 'Yii::app()->createUrl("equipamento/update", array("id"=>$data->id))',
                ),
                'delete' => array(
                    'label' => 'd', // text label of the button
                    'url' => 'Yii::app()->createUrl("equipamento/delete", array("id"=>$data->id))',
                ),
            ),
        ),
    )
)); ?>
</fieldset>