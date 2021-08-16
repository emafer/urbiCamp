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
        echo Html::a('<span class="glyphicon glyphicon-plus"></span>',
            \yii\helpers\Url::toRoute(['/comune/create','via' => 'ajax', 'fid'=>strtolower(str_replace('app\models\\', '', get_class($model))) . '-' . $attribute]),
            [
                'data-toggle'=>'modal',
                'data-target'=>'#modalCreate',
            ]
        );
    }

    public static function creaSelect2Anagrafica(
        ActiveForm $form,
        Model      $model,
        string     $attribute,
        string     $placeholder,
        bool       $multiple = true
    ) {
        $multiple = true;
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
            'content' => Html::a('<span class="glyphicon glyphicon-plus"></span>',
                \yii\helpers\Url::toRoute([
                    '/anagrafica/create',
                    'via' => 'ajax', 'fid'=> 'anagrafica-'.$attribute
                ]),
                [
                    'class' => 'btn btn-primary',
                    'title' => 'Cerca',
                    'data-toggle'=>'modal',
                    'data-target'=>'#modal' . ucfirst($attribute),
                ]
            ),
            'asButton' => true
        ],
    ],
]);
        self::creaCreazioneModale($attribute, $model, 'anagrafica', false);
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
        ]);
        echo '<input type="hidden" name="cambiaInternati" id="cambia-internati" value="0"/>';
    }

    public static function creaPlusButton($modalId, $model, $attribute, $routeName, $fid = '')
    {
        if (!$fid) {
            $fid = strtolower(str_replace('app\models\\', '', get_class($model))) . '-' . $attribute;
        }
        return Html::a('<span class="glyphicon glyphicon-plus"></span>',
            \yii\helpers\Url::toRoute([
                '/' . $routeName . '/create',
                'via' => 'ajax', 'fid'=> $fid
            ]),
            [
                'data-toggle'=>'modal',
                'data-target'=>'#' . $modalId,
            ]
        );
    }

    public static function getEmptyModal($id, $dimensione = '') {
        $style = '';
        if ($dimensione == 'large') {
            $style = ' style="width: 90%; left:5%"';
        }
        return '<div class="modal remote fade" id="' . $id . '"' . $style.'>
        <div class="modal-dialog" style="width: 100%">
            <div class="modal-content  loader-lg">

            </div>
        </div>
    </div>';
    }

    /**
     * @param string $attribute
     * @param Model $model
     */
    public static function creaCreazioneModale(string $attribute, Model $model, $routeName, $plus = true): void
    {
        $modalId = 'modal' . ucfirst($attribute);
        if ($plus) {
            echo self::creaPlusButton($modalId, $model, $attribute, $routeName);
        }
        echo self::getEmptyModal($modalId);
    }
}