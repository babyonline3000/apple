<?php

namespace common\models;
use common\models\BaseModel;

/**
 * This is the model class for table "{{%apple}}".
 *
 * @property int $id
 * @public string $color
 * @property int $volume
 * @property int $status
 * @property int $created_at
 * @property int|null $fallen_at
 */
class Apple extends BaseModel
{
    const TYPE_ACTION_EAT = 10;
    const TYPE_ACTION_FALL = 20;

    const TYPE_STATUS_HANGING_ON_A_TREE = 10;
    const TYPE_STATUS_LYING_ON_THE_GROUND = 20;
    const TYPE_STATUS_ROTTEN = 30;

    public  $_volume;

    /**
     * @return array
     */
    public static function typeActionLabels()
    {
        return [
            self::TYPE_ACTION_EAT => 'Кушать',
            self::TYPE_ACTION_FALL => 'Упасть',
        ];
    }

    /**
     * @return array
     */
    public static function typeStatusLabels()
    {
        return [
            self::TYPE_STATUS_HANGING_ON_A_TREE => 'Висит на дереве',
            self::TYPE_STATUS_LYING_ON_THE_GROUND => 'Лежит на земле',
            self::TYPE_STATUS_ROTTEN => 'Гнилое',
        ];
    }

    /**
	 * {@inheritdoc}
	 */
	public static function tableName()
	{
		return '{{%apple}}';
	}

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
        return [
            [['color', 'created_at'], 'required'],
            [['volume', 'status', 'created_at', 'fallen_at'], 'integer'],
            [['color'], 'string', 'max' => 30],
            [['status'], 'in', 'range' => [self::TYPE_STATUS_HANGING_ON_A_TREE, self::TYPE_STATUS_LYING_ON_THE_GROUND, self::TYPE_STATUS_ROTTEN]]
        ];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
        return [
            'id' => '',
            'color' => 'Цвет',
            'volume' => 'Объем',
            'status' => 'Статус',
            'created_at' => 'Создано',
            'fallen_at' => 'Упало',
        ];
	}

	/**
	 * {@inheritdoc}
	 * @return \common\models\queries\Apple the active query used by this AR class.
	 */
	public static function find()
	{
		return new \common\models\queries\Apple(get_called_class());
	}

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => ['created_at'],
                    self::EVENT_BEFORE_UPDATE => ['fallen_at'],
                ],
                'value' => date('U'),
            ],
        ];
    }

}
