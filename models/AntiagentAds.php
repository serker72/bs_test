<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "{{%antiagent_ads}}".
 *
 * @property integer $id
 * @property string $ads_id
 * @property double $ads_price
 * @property string $ads_img_link
 * @property string $ads_header
 * @property string $ads_link
 * @property string $ads_text
 * @property string $ads_owner
 * @property double $ads_option_price
 * @property string $ads_option_owner
 * @property string $ads_option_owner_phone
 * @property string $ads_option_owner_email
 * @property string $ads_option_dt_create
 * @property string $ads_option_dt_last_update
 * @property string $ads_option_views
 * @property string $ads_option_district
 * @property string $ads_option_address
 * @property string $ads_option_apartment_area
 * @property string $ads_option_floor
 * @property string $ads_option_wall material
 * @property string $ads_option_year built
 * @property string $created_at
 */
class AntiagentAds extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%antiagent_ads}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ads_id'], 'integer'],
            [['ads_price', 'ads_option_price'], 'number'],
            [['ads_text'], 'required'],
            [['ads_text'], 'string'],
            [['created_at'], 'safe'],
            [['ads_img_link', 'ads_header', 'ads_link', 'ads_owner', 'ads_option_owner', 'ads_option_owner_phone', 'ads_option_owner_email', 'ads_option_dt_create', 'ads_option_dt_last_update', 'ads_option_views', 'ads_option_district', 'ads_option_address', 'ads_option_apartment_area', 'ads_option_floor', 'ads_option_wall_material', 'ads_option_year_built'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ads_id' => Yii::t('app', 'Ads ID'),
            'ads_price' => Yii::t('app', 'Ads Price'),
            'ads_img_link' => Yii::t('app', 'Ads Img Link'),
            'ads_header' => Yii::t('app', 'Ads Header'),
            'ads_link' => Yii::t('app', 'Ads Link'),
            'ads_text' => Yii::t('app', 'Ads Text'),
            'ads_owner' => Yii::t('app', 'Ads Owner'),
            'ads_option_price' => Yii::t('app', 'Ads Option Price'),
            'ads_option_owner' => Yii::t('app', 'Ads Option Owner'),
            'ads_option_owner_phone' => Yii::t('app', 'Ads Option Owner Phone'),
            'ads_option_owner_email' => Yii::t('app', 'Ads Option Owner Email'),
            'ads_option_dt_create' => Yii::t('app', 'Ads Option Dt Create'),
            'ads_option_dt_last_update' => Yii::t('app', 'Ads Option Dt Last Update'),
            'ads_option_views' => Yii::t('app', 'Ads Option Views'),
            'ads_option_district' => Yii::t('app', 'Ads Option District'),
            'ads_option_address' => Yii::t('app', 'Ads Option Address'),
            'ads_option_apartment_area' => Yii::t('app', 'Ads Option Apartment Area'),
            'ads_option_floor' => Yii::t('app', 'Ads Option Floor'),
            'ads_option_wall_material' => Yii::t('app', 'Ads Option Wall Material'),
            'ads_option_year built' => Yii::t('app', 'Ads Option Year Built'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
    
    
    /**
     * @return boolean
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->created_at = new Expression('NOW()');
            }
            
            return true;
        } else {
            return false;
        }
    }
    
}
