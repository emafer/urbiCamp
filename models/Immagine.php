<?php

namespace app\models;

use app\query\FaldoneImmagineQuery;
use app\query\FaldoneQuery;
use app\query\FascicoloImmagineQuery;
use app\query\FascicoloQuery;
use app\query\ImmagineQuery;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "immagine".
 *
 * @property int $id
 * @property UploadedFile $path
 * @property string $lato
 * @property string $nome
 * @property string|null $descrizione
 *
 * @property FaldoneImmagine[] $faldoneImmagines
 * @property Faldone[] $faldones
 * @property FascicoloImmagine[] $fascicoloImmagines
 * @property Fascicolo[] $fascicolos
 */
class Immagine extends UrbiModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'immagine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path', 'nome', 'lato'], 'required'],
//            [['path'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Immagine',
            'nome' => 'Nome',
            'lato' => 'Lato',
            'descrizione' => 'Descrizione',
        ];
    }

    public function upload()
    {
        var_dump($_FILES);
        if ($this->validate()) {
            $nome = uniqid(). '.' . $this->path->extension;
            $this->path->saveAs(PATHURBI . '/web/uploads/' . $nome );
            $post = Yii::$app->request->post('Immagine');;
            $this->descrizione = filter_var( $post['descrizione'], FILTER_SANITIZE_STRING);
            $this->path = $nome;
            return true;
        } else {
            var_dump($this->errors);
            return false;
        }
    }
    /**
     * Gets query for [[FaldoneImmagines]].
     *
     * @return \yii\db\ActiveQuery|FaldoneImmagineQuery
     */
    public function getFaldoneImmagines()
    {
        return $this->hasMany(FaldoneImmagine::class, ['immagine_id' => 'id']);
    }

    /**
     * Gets query for [[Faldones]].
     *
     * @return \yii\db\ActiveQuery|FaldoneQuery
     */
    public function getFaldones()
    {
        return $this->hasMany(Faldone::class, ['id' => 'faldone_id'])->viaTable('faldone_immagine', ['immagine_id' => 'id']);
    }

    /**
     * Gets query for [[FascicoloImmagines]].
     *
     * @return \yii\db\ActiveQuery|FascicoloImmagineQuery     *
     */
    public function getFascicoloImmagines()
    {
        return $this->hasMany(FascicoloImmagine::class, ['immagine_id' => 'id']);
    }

    /**
     * Gets query for [[Fascicolos]].
     *
     * @return \yii\db\ActiveQuery|FascicoloQuery
     */
    public function getFascicolos()
    {
        return $this->hasMany(Fascicolo::class, ['id' => 'fascicolo_id'])->viaTable('fascicolo_immagine', ['immagine_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ImmagineQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImmagineQuery(get_called_class());
    }

    public function beforeDelete()
    {
        return unlink(PATHURBI . '/web/uploads/' . $this->path ) && parent::beforeDelete();
    }
}
