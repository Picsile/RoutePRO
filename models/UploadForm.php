<?php

namespace app\models;

use yii\base\Model;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'imageFile' => 'Ваше изображение',
        ];
    }


    public function upload()
    {
        if ($this->validate()) {
            $path = 'uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($path);
            return $path ?? false;
        } else {
            return false;
        }
    }
}
