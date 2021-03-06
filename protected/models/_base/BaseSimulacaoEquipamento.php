<?php

/**
 * This is the model base class for the table "simulacao_equipamento".
 * DO NOT MODIFY THIS FILE! It is automatically generated by AweCrud.
 * If any changes are necessary, you must set or override the required
 * property or method in class "SimulacaoEquipamento".
 *
 * Columns in table "simulacao_equipamento" available as properties of the model,
 * followed by relations of table "simulacao_equipamento" available as properties of the model.
 *
 * @property integer $id
 * @property integer $simulacao
 * @property integer $equipamento
 *
 * @property Simulacao $simulacao0
 * @property Equipamento $equipamento0
 */
abstract class BaseSimulacaoEquipamento extends AweActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'simulacao_equipamento';
    }

    public static function representingColumn() {
        return 'id';
    }

    public function rules() {
        return array(
            array('simulacao, equipamento', 'required'),
            array('simulacao, equipamento', 'numerical', 'integerOnly'=>true),
            array('id, simulacao, equipamento', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
            'simulacao0' => array(self::BELONGS_TO, 'Simulacao', 'simulacao'),
            'equipamento0' => array(self::BELONGS_TO, 'Equipamento', 'equipamento'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'id' => Yii::t('app', 'ID'),
                'simulacao' => Yii::t('app', 'Simulacao'),
                'equipamento' => Yii::t('app', 'Equipamento'),
                'simulacao0' => null,
                'equipamento0' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('simulacao', $this->simulacao);
        $criteria->compare('equipamento', $this->equipamento);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
	
	public function search_Simulacao($parentID) {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('simulacao', $parentID);
        $criteria->compare('equipamento', $this->equipamento);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function search_Equipamento($parentID) {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('simulacao', $this->simulacao);
        $criteria->compare('equipamento', $parentID);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array_merge(array(
        ), parent::behaviors());
    }
}