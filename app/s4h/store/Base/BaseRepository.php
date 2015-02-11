<?php namespace s4h\store\Base;


/**
* 
*/
abstract class BaseRepository {

	public $filters = [];

	abstract public function getModel();

	public function search(array $data = array())
	{
		$data = array_only($data, $this->filters);

		$data = array_filter($data,'strlen');

		$query = $this->getModel()->select();

		foreach($data as $field => $value)
		{
			$filterMethod = 'filterBy'.studly_case($field);

			echo "field:".$field.'<br>';
			echo "field:".$value.'<br>';
			echo "Valor:".$filterMethod.'<br>';

			if(method_exists(get_called_class(), $filterMethod))
			{
				/*echo "Entro".'<br>';
				$this->filterMethod($query, $value);*/
				call_user_func_array(array($this, $filterMethod), array($query, $value, $data['operator']));
			}
			else
			{
				if ($data[$field] != $data['operator'])
					$query->where($field, $data[$field]);
			}
		}
		return $query->get();
	}
}

