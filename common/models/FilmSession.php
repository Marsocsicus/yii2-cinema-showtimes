<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "film_session".
 *
 * @property int $id
 * @property int|null $film_id
 * @property string $start_time
 * @property int $price
 * @property int|null $created_at
 *
 * @property Film $film
 */
class FilmSession extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'film_session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['film_id', 'created_at'], 'default', 'value' => null],
            [['film_id', 'price', 'created_at'], 'integer'],
            [['start_time', 'price'], 'required'],
            [['start_time'], 'safe'],
            [['film_id'], 'exist', 'skipOnError' => true, 'targetClass' => Film::class, 'targetAttribute' => ['film_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'film_id' => 'Film ID',
            'start_time' => 'Start Time',
            'price' => 'Price',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Film]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilm()
    {
        return $this->hasOne(Film::class, ['id' => 'film_id']);
    }

}
