<?php
use app\models\Tag;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>


    <fieldset>
        <legend><?= Yii::t('app','Post') ?></legend>
        <?= $form->field($model, 'title')->textInput() ?>
        <?= $form->field($model, 'body')->textarea() ?>
    </fieldset>

    <fieldset>
        <legend><?= Yii::t('app','Tags') ?></legend>
        <?= $form->field($model, 'tag_ids')->widget(Select2::className(), [
            'model' => $model,
            'attribute' => 'tag_ids',
            'data' => ArrayHelper::map(Tag::find()->all(), 'name', 'name'),
            'options' => [
                'multiple' => true,
            ],
            'pluginOptions' => [
                'tags' => true,
            ],
        ]); ?>
    </fieldset>

    <?= Html::submitButton(Yii::t('app','Save')); ?>
    <?php ActiveForm::end(); ?>

</div>