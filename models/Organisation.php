<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organisation".
 *
 * @property integer $id
 * @property string $name
 * @property integer $deleted
 * @property integer $position
 *
 * @property StatOfficerOrgDetail[] $statOfficerOrgDetails
 */
class Organisation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'organisation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['deleted', 'position'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'deleted' => Yii::t('app', 'Deleted'),
            'position' => Yii::t('app', 'Position'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatOfficerOrgDetails()
    {
        return $this->hasMany(StatOfficerOrgDetail::className(), ['organisation_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return OrganisationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrganisationQuery(get_called_class());
    }
}
