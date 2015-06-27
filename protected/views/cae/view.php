<?php
/** @var CaeController $this */
/** @var Cae $model */
$this->breadcrumbs=array(
	'Caes'=>array('index'),
	$model->id,
);

$this->menu=array(
    //array('label' => Yii::t('AweCrud.app', 'List') . ' ' . Cae::label(2), 'icon' => 'list', 'url' => array('index')),
    array('label' => Yii::t('AweCrud.app', 'Create') . ' ' . Cae::label(), 'icon' => 'plus', 'url' => array('create')),
	array('label' => Yii::t('AweCrud.app', 'Update'), 'icon' => 'pencil', 'url' => array('update', 'id' => $model->id)),
    array('label' => Yii::t('AweCrud.app', 'Delete'), 'icon' => 'trash', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => Yii::t('AweCrud.app', 'Are you sure you want to delete this item?'))),
    array('label' => Yii::t('AweCrud.app', 'Manage'), 'icon' => 'list-alt', 'url' => array('admin')),
);
?>

<fieldset>
    <legend><?php echo Yii::t('AweCrud.app', 'Empresas com esta') . ' ' . Cae::label(); ?> <?php echo CHtml::encode($model) ?></legend>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'empresa-grid',
    'type' => 'striped condensed',
    'dataProvider' => $child_model->search_Cae($parentID),
    'columns' => array(
        'id',
		'nome',
		'latitude',
		'longitude',
		'localidade',
        array(
            'name' => 'cae',
            'value' => 'isset($data->cae) ? $data->cae : null',
            'filter' => CHtml::listData(Cae::model()->findAll(), 'id', Cae::representingColumn()),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{create}{view}{update}{delete}',
            'buttons' => array(
                'create' => array(
                    'label' => '+', // text label of the button
                    'url' => 'Yii::app()->createUrl("empresa/create", array("id"=>$data->id))',
                ),
                'view' => array(
                    'label' => 'r', // text label of the button
                    'url' => 'Yii::app()->createUrl("empresa/view", array("id"=>$data->id))',
                ),
                'update' => array(
                    'label' => 'u', // text label of the button
                    'url' => 'Yii::app()->createUrl("empresa/update", array("id"=>$data->id))',
                ),
                'delete' => array(
                    'label' => 'd', // text label of the button
                    'url' => 'Yii::app()->createUrl("empresa/delete", array("id"=>$data->id))',
                ),
            ),
        ),
    )
));?>
</fieldset>