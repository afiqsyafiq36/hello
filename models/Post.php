<?php
namespace app\models;

use cornernote\linkall\LinkAllBehavior;
use yii\db\ActiveRecord;

class Post extends ActiveRecord
{
    public $tag_ids;

    public function rules()
    {
        return [
            [['title', 'body', 'tag_ids'], 'required'],
        ];
    }

    public function behaviors()
    {
        return [
            LinkAllBehavior::className(),
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        $tags = [];
        foreach ($this->tag_ids as $tag_name) {
            $tag = Tag::getTagByName($tag_name);
            if ($tag) {
                $tags[] = $tag;
            }
        }
        $this->linkAll('tags', $tags);
        parent::afterSave($insert, $changedAttributes);
    }

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            //->via('postToTag');
            ->viaTable('post_to_tag', ['post_id' => 'id']);
    }
}