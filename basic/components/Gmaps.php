<?php 
	namespace app\components;
	use yii\base\Component;

	/**
	* 
	*/
	class Gmaps extends Component
	{
		public function tes($value='')
		{
			$longlat = (new \yii\db\Query())
                    ->select(['longitude', 'latitude'])
                    ->from('koordinat_objek')
                    ->all();
             return $longlat;
		}
	}
?>