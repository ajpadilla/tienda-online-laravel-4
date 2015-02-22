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

	public function search(array $data = array(), $paginate = false, $numItems = 15)
	{
		$data = array_only($data, $this->filters);

		$data = array_filter($data,'strlen');

		$query = $this->getModel()->select();

		foreach($data as $field => $value)
		{
			$filterMethod = 'filterBy'.studly_case($field);

			/*echo "field:".$field.'<br>';
			echo "value:".$value.'<br>';
			echo "data:".$data['filterWord'].'<br>';
			echo "method:".$filterMethod.'<br>';*/

			//return  ['method'=>$filterMethod,'data' =>$data];

			if(method_exists(get_called_class(), $filterMethod))
			{
				call_user_func_array(array($this, $filterMethod), array($query, $data));
			}
			/*else
			{
				$query->where($field, $data[$field]);
			}*/
		}
		return $paginate ? $query->paginate($numItems)->appends($data): $query->get();
	}

	public function getCurrentLang(){
		$isoCode = LaravelLocalization::setLocale();
		$language = Language::select()->where('iso_code','=',$isoCode)->first();
		return $language;
	}

	public function filterByfilterWord($query, $value)
	{
		$language = $this->getCurrentLang();
		$query->with('languages')->whereHas('languages', function($q) use ($value, $language){
    		$q->where('language_id', '=', $language->id)->where('products_lang.name', 'LIKE', '%' . $value . '%')->orWhere('products_lang.description', 'LIKE', '%' . $value . '%')->where('language_id', '=', $language->id);
		});
	}

}

