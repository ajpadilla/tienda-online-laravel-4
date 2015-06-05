<?php namespace s4h\store\Base;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Datatable;
use Illuminate\Database\Eloquent\Collection;
use s4h\store\Languages\Language;

/**
* 
*/
class BaseRepository 
{

	protected $model;
	protected $columns;	
	protected $actionColums = array();
	protected $collection;
	protected $listAllRoute;
	const PAGINATE = true;
	public $filters = [];

	public function getColumnCount()
	{
		return count($this->columns);
	}

	public function setListAllRoute($listAllRoute)
	{
		$this->listAllRoute = $listAllRoute;
	}

	public function getListAllRoute()
	{
		return $this->listAllRoute;
	}

	public function setModel($model)
	{
		$this->model = $model;
	}

	public function getModel()
	{
		return $this->model;
	}

	public function create($data = array())
	{
		$model = $this->model->create($data); 
		return $model;
	}

	public function  getAll($exclude = null)
	{
		if($exclude)
			return $this->getModel()->whereNotIn('id', $exclude)->get();
		return $this->getModel()->all();
	}	

	public function getAllForSelect()
	{
		return $this->getAll()->lists('name', 'id');
	}	
	
	public function delete($id)
	{
		$model = $this->get($id); 
		return $model->delete();
	}

	public function get($id)
	{
		return $this->model->findOrFail($id);
	}	

	public function update($data = array()){}

	public function getAllForCurrentLang(){}

	public function getCurrentLang(){
		$isoCode = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$isoCode)->first();
		return $language;
	}

	public function search(array $data = array(), $paginate = false, $numItems = 10)
	{
		$language = $this->getCurrentLang();
		
		$data = array_only($data, $this->filters);

		$data = array_filter($data);

		$query = $this->getModel()->select();

		foreach($data as $field => $value)
		{
			$filterMethod = 'filterBy'.studly_case($field);

			if(method_exists(get_called_class(), $filterMethod))
			{
				call_user_func_array(array($this, $filterMethod), array($query, $data));
			}
		}

		$this->sortResults($query, $data);

		return $paginate ? $query->paginate($numItems): $query->get();
	}

	public function sortResults($query, array $data = array())
	{
		if (isset($data['orderBy'])) 
		{
			$value = explode('-',$data['orderBy']);

			$field = $value[0];

			$order = $value[1];

			$orderByMethod = 'orderBy'.studly_case($field);

			if(method_exists(get_called_class(), $orderByMethod))
			{
				call_user_func_array(array($this, $orderByMethod), array($query, $order));
			}
		}
	}

}

