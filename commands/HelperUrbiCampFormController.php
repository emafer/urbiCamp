<?php

namespace app\commands;

use kartik\select2\Select2;
use yii\base\Model;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

class HelperUrbiCampFormController
{
    public static function creaSelect2Comuni(
        ActiveForm $form,
        Model      $model,
        string     $attribute,
        string     $placeholder,
        string      $nome = '',
        string      $id = ''
    )
    {
        $options = [];
        $options['prompt'] = $placeholder;
        if ($nome) {
            $options['name'] = $nome;
        }
        if ($id) {
            $options['id'] = $id;
        }
        $comuni = \yii\helpers\ArrayHelper::map(\app\models\Comune::find()->all(), 'id', 'nome');
        echo $form->field($model, $attribute)->dropDownList($comuni, $options);
    }
    public static function creaSelect2Anagrafica(
        ActiveForm $form,
        Model      $model,
        string     $attribute,
        string     $placeholder,
        bool       $multiple = true
    ) {
        $items =  \yii\helpers\ArrayHelper::map(\app\models\Anagrafica::find()->all(), 'id', 'nomeCompleto');
        echo $form->field($model, $attribute)->widget(Select2::class, [
    'data' => $items,
    'options' => ['multiple'=> $multiple, 'placeholder' => 'Cerca per cognome/ragione sociale', 'onchange'=>new JsExpression('$("#cambia-' . $attribute . '").val(1);')],
    'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 3,
        'language' => [
            'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
        ],
        'ajax' => [
            'url' => \yii\helpers\Url::to(['anagrafica/list']),
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term}; }')
        ],
        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('function(city) { return city.text; }'),
        'templateSelection' => new JsExpression('function (city) { return city.text; }'),
    ],
    'addon' => [
        'append' => [
            'content' => Html::button('<i class="glyphicon glyphicon-user"></i>', [
                'class' => 'btn btn-primary',
                'title' => 'Mark on map',
                'data-toggle' => 'tooltip'
            ]),
            'asButton' => true
        ],
    ],
]);
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>',
            \yii\helpers\Url::toRoute(['/anagrafica/create','via' => 'ajax']),
            [
                'data-toggle'=>'modal',
                'data-target'=>'#modalAnagCreate',
            ]
        );
        echo '<input type="hidden" name="cambia' . ucfirst($attribute) . '" id="cambia-' . $attribute . '" value="0"/>';
    }
    public static function creaSelect2Internati(
        ActiveForm $form,
        Model      $model,
        string     $attribute,
        string     $placeholder,
        bool       $multiple = true
    )
    {
        $items =  \yii\helpers\ArrayHelper::map(\app\models\Internato::find()->all(), 'id', 'nome');
        echo $form->field($model, 'internati')->widget(Select2::class, [
            'data' => $items,
            'options' => ['multiple'=> $multiple, 'placeholder' => $placeholder, 'onchange'=>new JsExpression('$("#cambia-internati").val(1);')],
            //    'pluginOptions' => [
            //        'allowClear' => true,
            //        'minimumInputLength' => 3,
            //        'language' => [
            //            'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            //        ],
            //        'ajax' => [
            //            'url' => \yii\helpers\Url::to(['list']),
            //            'dataType' => 'json',
            //            'data' => new JsExpression('function(params) { return {q:params.term}; }')
            //        ],
            //        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
            //        'templateResult' => new JsExpression('function(city) { return city.text; }'),
            //        'templateSelection' => new JsExpression('function (city) { return city.text; }'),
            //    ],
        ]);

        echo '<input type="hidden" name="cambiaInternati" id="cambia-internati" value="0"/>';
    }
}