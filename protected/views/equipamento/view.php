<?php
/** @var EquipamentoController $this */
/** @var Equipamento $model */
$this->breadcrumbs=array(
	'Equipamentos'=>array('index'),
	$model->id,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Equipamento::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Equipamento::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?php echo Yii::t('AweCrud.app', 'Simulacoes com este') . ' ' . Equipamento::label(); ?> <?php echo CHtml::encode($model) ?></legend>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'simulacao-equipamento-grid',
    'type' => 'striped condensed',
    'dataProvider' => $child_model->search_Equipamento($parentID),
    'columns' => array(
        'id',
        array(
            'name' => 'simulacao',
            'value' => 'isset($data->simulacao0) ? $data->simulacao0 : null',
            'filter' => CHtml::listData(Simulacao::model()->findAll(), 'id', Simulacao::representingColumn()),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{create}{view}{update}{delete}',
            'buttons' => array(
                'create' => array(
                    'label' => '+', // text label of the button
                    'url' => 'Yii::app()->createUrl("simulacaoEquipamento/create", array("id"=>$data->id))',
                ),
                'view' => array(
                    'label' => 'r', // text label of the button
                    'url' => 'Yii::app()->createUrl("simulacaoEquipamento/view", array("id"=>$data->id))',
                ),
                'update' => array(
                    'label' => 'u', // text label of the button
                    'url' => 'Yii::app()->createUrl("simulacaoEquipamento/update", array("id"=>$data->id))',
                ),
                'delete' => array(
                    'label' => 'd', // text label of the button
                    'url' => 'Yii::app()->createUrl("simulacaoEquipamento/delete", array("id"=>$data->id))',
                ),
            ),
        ),
    )
));?>
</fieldset>