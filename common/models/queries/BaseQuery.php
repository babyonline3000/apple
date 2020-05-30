<?php

namespace common\models\queries;

abstract class BaseQuery extends \yii\db\ActiveQuery
{
	/**
	 * @return BaseQuery
	 */
	public function orderByRandom()
	{
		$random = \Yii::$app->db->driverName == 'pgsql' ? 'RANDOM' : 'RAND';

		return $this->addOrderBy(new \yii\db\Expression("{$random}()"));
	}
}