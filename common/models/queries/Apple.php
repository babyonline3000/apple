<?php

namespace common\models\queries;

/**
 * This is the ActiveQuery class for [[\common\models\Apple]].
 *
 * @see \common\models\Apple
 */
class Apple extends \common\models\queries\BaseQuery
{
	public function active()
	{
		return $this->andWhere(['is_active' => true]);
	}

	/**
	 * @param string $search
	 * @return $this
	 */
	public function search($search)
	{
		return $this->andWhere([
			'or',
			['like', 'name', $search],
			['like', 'color', $search],
		]);
	}

	/**
	 * {@inheritdoc}
	 * @return \common\models\Apple[]|array
	 */
	public function all($db = null)
	{
		return parent::all($db);
	}

	/**
	 * {@inheritdoc}
	 * @return \common\models\Apple|array|null
	 */
	public function one($db = null)
	{
		return parent::one($db);
	}
}
