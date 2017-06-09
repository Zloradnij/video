<?php

namespace app\modules\video\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "video".
 *
 * @property integer $id
 * @property string $frame_link
 * @property string $source_link
 * @property string $source
 * @property string $title
 * @property string $description
 * @property string $image
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 */
class Video extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $currentSource;
    public $file;

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
//            BlameableBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['frame_link', 'source_link', 'title', 'status'], 'required'],
            [['description'], 'string'],
            [['status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['frame_link', 'source_link', 'source', 'title', 'image'], 'string', 'max' => 255],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['file'],'file','extensions' => 'png, jpg, jpeg, webp'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'frame_link' => Yii::t('app', 'IFrame Link'),
            'source_link' => Yii::t('app', 'Source Link'),
            'source' => Yii::t('app', 'Source'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     * @return VideoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VideoQuery(get_called_class());
    }
}
