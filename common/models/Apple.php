<?php

namespace common\models;
use common\models\BaseModel;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property string $color
 * @property int $volume
 * @property int $status
 * @property int $created_at
 * @property int|null $fallen_at
 */
class Apple extends BaseModel
{
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
            [['color'], 'string', 'max' => 255],
        ];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
        return [
            'id' => 'ID',
            'color' => 'Color',
            'volume' => 'Volume',
            'status' => 'Status',
            'created_at' => 'Created At',
            'fallen_at' => 'Fallen At',
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
}
