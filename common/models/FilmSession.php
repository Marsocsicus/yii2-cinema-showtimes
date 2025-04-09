<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['film_id', 'price'], 'integer'],
            [['start_time', 'price', 'film_id'], 'required'],
            [['film_id'], 'exist', 'skipOnError' => false, 'targetClass' => Film::class, 'targetAttribute' => ['film_id' => 'id']],
            ['start_time', 'validateStartTime'],
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
            'updated_at' => 'Updated At',
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

    public function validateStartTime($attribute, $params)
    {
        $lastSession = self::find()
            ->where(['<', 'start_time', $this->start_time])
            ->orderBy(['start_time' => SORT_DESC])
            ->one();

        if ($lastSession) {
            $lastEnd = $lastSession->start_time + $lastSession->film->duration * 60;
            $minStart = $lastEnd + 30 * 60;

            if ($this->start_time < $minStart) {
                $this->addError($attribute, 'Сеанс должен начинаться минимум через 30 минут после окончания предыдущего.');
            }

        }
    }
}


/*

-Время и дата. Время между сеансами должно быть не менее 30 минут.
Вариации:

start_time + duration = end_time + 30min = nearest_avaliable_time

*/