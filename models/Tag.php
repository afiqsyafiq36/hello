<?php
namespace app\models;

use yii\db\ActiveRecord;

class Tag extends ActiveRecord
{
    public static function getTagByName($name)
    {
        $tag = Tag::find()->where(['name' => $name])->one();
        if (!$tag) {
            $tag = new Tag();
            $tag->name = $name;
            $tag->save(false);
        }
        return $tag;
    }
}