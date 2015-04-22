<?php

/**
 * This is the model base class for the table "empresa".
 * DO NOT MODIFY THIS FILE! It is automatically generated by AweCrud.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Empresa".
 *
 * Columns in table "empresa" available as properties of the model,
 * followed by relations of table "empresa" available as properties of the model.
 *
 * @property integer $id
 * @property string $nome
 * @property string $localidade
 * @property integer $cae
 *
 * @property Cliente[] $clientes
 * @property Cae $cae0
 * @property Simulacao[] $simulacaos
 * @property Visita[] $visitas
 */
abstract class BaseEmpresa extends AweActiveRecord {

    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'empresa';
    }

    public static function representingColumn() {
        return 'nome';
    }

    public function rules() {
        return array(
            array('nome, localidade, cae', 'required'),
            array('cae', 'numerical', 'integerOnly'=>true),
            array('nome, localidade', 'length', 'max'=>50),
            array('id, nome, localidade, cae', 'safe', 'on'=>'search'),
        );
    }

    public function relations() {
        return array(
            'clientes' => array(self::HAS_MANY, 'Cliente', 'empresa'),
            'cae0' => array(self::BELONGS_TO, 'Cae', 'cae'),
            'simulacaos' => array(self::HAS_MANY, 'Simulacao', 'empresa'),
            'visitas' => array(self::HAS_MANY, 'Visita', 'empresa'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
                'id' => Yii::t('app', 'ID'),
                'nome' => Yii::t('app', 'Nome'),
                'localidade' => Yii::t('app', 'Localidade'),
                'cae' => Yii::t('app', 'Cae'),
                'clientes' => null,
                'cae0' => null,
                'simulacaos' => null,
                'visitas' => null,
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nome', $this->nome, true);
        $criteria->compare('localidade', $this->localidade, true);
        $criteria->compare('cae', $this->cae);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function behaviors() {
        return array_merge(array(
        ), parent::behaviors());
    }
}