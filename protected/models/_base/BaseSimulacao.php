<?php

/**
 * This is the model base class for the table "simulacao".
 * DO NOT MODIFY THIS FILE! It is automatically generated by AweCrud.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Simulacao".
 *
 * Columns in table "simulacao" available as properties of the model,
 * followed by relations of table "simulacao" available as properties of the model.
 *
 * @property integer $id
 * @property integer $empresa
 * @property string $data
 * @property double $consumo_total
 * @property integer $equipamento
 *
 * @property Empresa $empresa0
 * @property Equipamento $equipamento0
 */
abstract class BaseSimulacao extends AweActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'simulacao';
    }

    public static function representingColumn() {
        return 'data';
    }

    public function rules() {
        return array(
            array('empresa, data, consumo_total, equipamento', 'required'),
            array('empresa, equipamento', 'numerical', 'integerOnly'=>true),
            array('consumo_total', 'numerical'),
            array('id, empresa, data, consumo_total, equipamento', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
            'empresa0' => array(self::BELONGS_TO, 'Empresa', 'empresa'),
            'equipamento0' => array(self::BELONGS_TO, 'Equipamento', 'equipamento'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'id' => Yii::t('app', 'ID'),
                'empresa' => Yii::t('app', 'Empresa'),
                'data' => Yii::t('app', 'Data'),
                'consumo_total' => Yii::t('app', 'Consumo Total'),
                'equipamento' => Yii::t('app', 'Equipamento'),
                'empresa0' => null,
                'equipamento0' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('empresa', $this->empresa);
        $criteria->compare('data', $this->data, true);
        $criteria->compare('consumo_total', $this->consumo_total);
        $criteria->compare('equipamento', $this->equipamento);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array_merge(array(
        ), parent::behaviors());
    }
}