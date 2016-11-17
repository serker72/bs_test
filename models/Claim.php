<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "{{%claim}}".
 *
 * @property integer $id
 * @property string $phone
 * @property string $text
 * @property string $created_at
 */
class Claim extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%claim}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'phone'], 'required'],
            [['text'], 'string'],
            [['created_at'], 'safe'],
            [['phone'], 'string', 'min' => 7, 'max' => 255],
            //[['phone'], 'validatePhoneEmpty', 'skipOnEmpty'=> false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'phone' => Yii::t('app', 'Phone'),
            'text' => Yii::t('app', 'Text'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
    
    // функция для проверки phone посетитель
    public function validatePhoneEmpty()
    {
        if(empty($this->phone))
        {
            $errorMsg = 'Укажите ваш телефон';
            $this->addError('phone', $errorMsg);
            //$this->addError('email', $errorMsg);
        }
        
        if(!empty($this->phone) && (strlen($this->phone)<7))
        {
            $errorMsg = 'Слишком мало цифр в номере телефона';
            $this->addError('phone', $errorMsg);
        }
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
