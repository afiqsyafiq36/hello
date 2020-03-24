<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string $message
 * @property int $permissions
 * @property int $created_at
 * @property int $updated_at
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const PERMISSION_PRIVATE =10;
    const PERMISSION_PUBLIC = 20;

    public function getPermissions() {
        return array (self::PERMISSION_PRIVATE => 'Private', self::PERMISSION_PUBLIC => 'Public');
    }

    public function getPermissionsLabel($permissions) {

        if ($permissions == self::PERMISSION_PRIVATE){
            return 'Private';
        } else {
            return 'Public';
        }
    }

    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['message', 'permissions','created_at', 'updated_at'], 'required'],
            [['message'], 'string'],
            [['permissions', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'message' => Yii::t('app', 'Message'),
            'permissions' => Yii::t('app', 'Permissions'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}

//Model without db connection
// class Status extends Model
// {
//     const PERMISSION_PRIVATE = 10;
//     const PERMISSION_PUBLIC =20;

//     public $text;
//     public $permissions;

//     public function rules()
//     {
//         return [
//             [['text','permissions'], 'required'],
//         ];
//     }

//     public function getPermissions() {
//         return array (self::PERMISSION_PRIVATE => 'Private', self::PERMISSION_PUBLIC => 'Public');
//     }

//     public function getPermissionsLabel($permissions) {
//         if ($permissions == self::PERMISSION_PUBLIC) {
//             return 'Public';
//         } else {
//             return 'Private';
//         }
//     }
// }
