<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stat_officer_organisation_upgrade_detail".
 *
 * @property integer $id
 * @property integer $doctor_in_total
 * @property integer $doctor_in_women
 * @property integer $doctor_out_total
 * @property integer $doctor_out_women
 * @property integer $master_in_total
 * @property integer $master_in_women
 * @property integer $master_out_total
 * @property integer $master_out_women
 * @property integer $bachelor_in_total
 * @property integer $bachelor_in_women
 * @property integer $bachelor_out_total
 * @property integer $bachelor_out_women
 * @property integer $high_in_total
 * @property integer $high_in_women
 * @property integer $high_out_total
 * @property integer $high_out_women
 * @property integer $middle_in_total
 * @property integer $middle_in_women
 * @property integer $middle_out_total
 * @property integer $middle_out_women
 * @property integer $begin_in_total
 * @property integer $begin_in_women
 * @property integer $begin_out_total
 * @property integer $begin_out_women
 * @property integer $organisation_id
 * @property integer $stat_officer_organisation_upgrade_id
 *
 * @property Organisation $organisation
 * @property StatOfficerOrganisationUpgrade $statOfficerOrganisationUpgrade
 */
class StatOfficerOrganisationUpgradeDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stat_officer_organisation_upgrade_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doctor_in_total', 'doctor_in_women', 'doctor_out_total', 'doctor_out_women', 'master_in_total', 'master_in_women', 'master_out_total', 'master_out_women', 'bachelor_in_total', 'bachelor_in_women', 'bachelor_out_total', 'bachelor_out_women', 'high_in_total', 'high_in_women', 'high_out_total', 'high_out_women', 'middle_in_total', 'middle_in_women', 'middle_out_total', 'middle_out_women', 'begin_in_total', 'begin_in_women', 'begin_out_total', 'begin_out_women', 'organisation_id', 'stat_officer_organisation_upgrade_id'], 'integer'],
            [['organisation_id', 'stat_officer_organisation_upgrade_id'], 'required','message'=>Yii::t('app','Please enter a value for') .Yii::t('app','{attribute}')],
            [['organisation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organisation::className(), 'targetAttribute' => ['organisation_id' => 'id']],
            [['stat_officer_organisation_upgrade_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatOfficerOrganisationUpgrade::className(), 'targetAttribute' => ['stat_officer_organisation_upgrade_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'doctor_in_total' => Yii::t('app', 'Doctor In Total'),
            'doctor_in_women' => Yii::t('app', 'Doctor In Women'),
            'doctor_out_total' => Yii::t('app', 'Doctor Out Total'),
            'doctor_out_women' => Yii::t('app', 'Doctor Out Women'),
            'master_in_total' => Yii::t('app', 'Master In Total'),
            'master_in_women' => Yii::t('app', 'Master In Women'),
            'master_out_total' => Yii::t('app', 'Master Out Total'),
            'master_out_women' => Yii::t('app', 'Master Out Women'),
            'bachelor_in_total' => Yii::t('app', 'Bachelor In Total'),
            'bachelor_in_women' => Yii::t('app', 'Bachelor In Women'),
            'bachelor_out_total' => Yii::t('app', 'Bachelor Out Total'),
            'bachelor_out_women' => Yii::t('app', 'Bachelor Out Women'),
            'high_in_total' => Yii::t('app', 'High In Total'),
            'high_in_women' => Yii::t('app', 'High In Women'),
            'high_out_total' => Yii::t('app', 'High Out Total'),
            'high_out_women' => Yii::t('app', 'High Out Women'),
            'middle_in_total' => Yii::t('app', 'Middle In Total'),
            'middle_in_women' => Yii::t('app', 'Middle In Women'),
            'middle_out_total' => Yii::t('app', 'Middle Out Total'),
            'middle_out_women' => Yii::t('app', 'Middle Out Women'),
            'begin_in_total' => Yii::t('app', 'Begin In Total'),
            'begin_in_women' => Yii::t('app', 'Begin In Women'),
            'begin_out_total' => Yii::t('app', 'Begin Out Total'),
            'begin_out_women' => Yii::t('app', 'Begin Out Women'),
            'organisation_id' => Yii::t('app', 'Organisation ID'),
            'stat_officer_organisation_upgrade_id' => Yii::t('app', 'Stat Officer Organisation Upgrade ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisation()
    {
        return $this->hasOne(Organisation::className(), ['id' => 'organisation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatOfficerOrganisationUpgrade()
    {
        return $this->hasOne(StatOfficerOrganisationUpgrade::className(), ['id' => 'stat_officer_organisation_upgrade_id']);
    }

    /**
     * @inheritdoc
     * @return StatOfficerOrganisationUpgradeDetailQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatOfficerOrganisationUpgradeDetailQuery(get_called_class());
    }
}
