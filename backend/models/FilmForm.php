<?php

namespace backend\models;

use Yii;
use yii\base\Model;

use common\models\Film;

class FilmForm extends Model
{
    const MAX_TITLE_LENGHT = 50;
    const MAX_DESCRIPTION_LENGHT = 1000;
    const MAX_DURATION = 500;
    const MAX_AGE_LIMIT = 18;

    public $title;
    public $image;
    public $description;
    public $duration;
    public $age_limit;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => self::MAX_TITLE_LENGHT],
            [['image'], 'file',
                'skipOnEmpty' => false,
                'extensions' => ['jpg', 'png', 'jpeg', 'webp'],
                'checkExtensionByMimeType' => true,
                'maxSize' => $this->getMaxFileSize()],
            [['description'], 'string', 'max' => self::MAX_DESCRIPTION_LENGHT],
            [['duration'], 'integer', 'max' => self::MAX_DURATION],
            [['age_limit'], 'integer', 'max' => self::MAX_AGE_LIMIT],
        ];
    }

    public function getMaxFileSize()
    {
        return Yii::$app->params['maxFileSize'];
    }

    public function save()
    {
        if ($this->validate()) {
            $film = new Film();
            $film->title = $this->title;
            $film->description = $this->description;
            $film->duration = $this->duration;
            $film->age_limit = $this->age_limit;

            $imageName = uniqid() . '.' . $this->image->extension;
            $imagePath = Yii::getAlias('@frontend/web/images/film/') . $imageName;

            if ($this->image->saveAs($imagePath)) {
                $film->image = $imageName;
                return $film->save(false);
            }
        }
    }
}
