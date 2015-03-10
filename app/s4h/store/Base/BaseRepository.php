<?php namespace s4h\store\Base;


use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;

/**
* 
*/
abstract class BaseRepository 
{

	const PAGINATE = true;

	public $filters = [];

	abstract public function getModel();

	public function search(array $data = array(), $paginate = false, $numItems = 5)
	{
		$language = $this->getCurrentLang();
		
		$data = array_only($data, $this->filters);

		$data = array_filter($data,'count');

		$query = $this->getModel()->select()->with(
			array(
				'languages' => function($q) use ($language){
					$q->where('language_id', '=', $language->id);
				},
				'photos'
			)
		);

		//return $data;

		foreach($data as $field => $value)
		{
			$filterMethod = 'filterBy'.studly_case($field);

			if(method_exists(get_called_class(), $filterMethod))
			{
				call_user_func_array(array($this, $filterMethod), array($query, $data));
			}
		}
		return $paginate ? $query->orderBy('price','desc')->paginate($numItems): $query->get();
	}

	public function getCurrentLang(){
		$isoCode = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$isoCode)->first();
		return $language;
	}

}

