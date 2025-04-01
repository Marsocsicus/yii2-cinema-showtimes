<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "film".
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property string $description
 * @property int $duration
 * @property int $age_limit
 * @property string|null $created_at
 *
 * @property FilmSession[] $filmSessions
 */
class Film extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'film';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'default', 'value' => null],
            [['image'], 'default', 'value' => ''],
            [['age_limit'], 'default', 'value' => 0],
            [['title', 'description', 'duration'], 'required'],
            [['duration', 'age_limit'], 'integer'],
            [['created_at'], 'safe'],
            [['title', 'image', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'image' => 'Image',
            'description' => 'Description',
            'duration' => 'Duration',
            'age_limit' => 'Age Limit',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[FilmSessions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilmSessions()
    {
        return $this->hasMany(FilmSession::class, ['film_id' => 'id']);
    }

}
