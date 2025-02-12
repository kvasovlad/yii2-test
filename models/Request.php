<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "requests".
 *
 * @property int $id
 * @property string $name Имя пользователя
 * @property string $email Email пользователя
 * @property string|null $status Статус
 * @property string $message Сообщение пользователя
 * @property string|null $comment Ответ ответственного лица
 * @property string|null $created_at Время создания заявки
 * @property string|null $updated_at Время изменения заявки
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'message'], 'required'],
            [['message', 'comment'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя пользователя',
            'email' => 'Email пользователя',
            'status' => 'Статус',
            'message' => 'Сообщение пользователя',
            'comment' => 'Ответ ответственного лица',
            'created_at' => 'Время создания заявки',
            'updated_at' => 'Время изменения заявки',
        ];
    }
}
