<?php namespace s4h\store\Classifieds;

use s4h\store\Classifieds\Classified;
use s4h\store\Languages\Language;
use s4h\store\Photos\ClassifiedPhotos;
use s4h\store\ClassifiedsLang\ClassifiedsLang;
use s4h\store\Base\BaseRepository;
/**
* 
*/
class ClassifiedRepository extends BaseRepository
{

	function __construct() {
		$this->columns = [
			trans('classifieds.list.photo'),
			trans('classifieds.list.Name'),
			trans('classifieds.list.Description'),
			trans('classifieds.list.Address'),
			trans('products.list.price'),
			trans('classifieds.list.User'),
			trans('products.list.category'),
			trans('classifieds.list.Classifieds_types'),
			trans('classifieds.list.Classified_condition'),
			trans('classifieds.list.Actions')
		];
		$this->setModel(new Classified);
		$this->setListAllRoute('classifieds.routes.api.list');
	}

	public $filters = ['filterWord','price','priceRange','firstValue','secondValue','categories','conditionsClassifieds',
    'cityId','countryId','stateId','classifiedType','operator','orderBy'];

	public function filterByPrice($query, $data = array()){
		$query->where('price',$data['operator'],$data['price']);
	}

    public function filterByPriceRange($query, $data = array()){
		$query->whereBetween('price',[$data['firstValue'], $data['secondValue']]);
	}

	public function filterByConditionsClassifieds($query, $data = array()){
		if($data['conditionsClassifieds'] > 0)
			$query->where('classified_condition_id','=',$data['conditionsClassifieds']);
	}

	public function filterByFilterWord($query, $data = array())
	{
		$language = $this->getCurrentLang();
		$query->whereHas('languages', function($q) use ($data, $language){
    		$q->where('language_id', '=', $language->id)
    			->where('classifieds_lang.name', 'LIKE', '%' . $data['filterWord'] . '%');
    			/*->orWhere('classifieds_lang.description', 'LIKE', '%' . $data['filterWord'] . '%')
    			->where('language_id', '=', $language->id);*/
		});
	}

	public function filterByCategories($query, $data = array())
	{
		$query->whereHas('categories', function($q) use ($data){
    		$q->whereIn('classified_classification.category_id', $data['categories']);
		});
	}

	public function filterByClassifiedType($query, $data = array()){
		if($data['classifiedType'] > 0)
			$query->where('classified_type_id','=',$data['classifiedType']);
	}

	public function filterByCountryId($query, $data = array()){
		if($data['countryId'] > 0)
			$query->join('address as addressC','classifieds.address_id','=','addressC.id')
			->join('cities as citiesC', 'addressC.city_id', '=', 'citiesC.id')
			->join('states as statesC', 'citiesC.states_id', '=', 'statesC.id')
			->join('countries', 'statesC.country_id', '=', 'countries.id')
			->where('countries.id','=',$data['countryId'])
			->select('classifieds.*');
	}


	public function filterByStateId($query, $data = array()){
		if($data['stateId'] > 0)
			$query->join('address as dir','classifieds.address_id','=','dir.id')
			->join('cities as citiesS', 'dir.city_id', '=', 'citiesS.id')
			->join('states as statesS', 'citiesS.states_id', '=', 'statesS.id')
			->where('statesS.id','=',$data['stateId'])
			->select('classifieds.*');
	}

	public function filterByCityId($query, $data = array()){
		if( $data['cityId'] > 0)
			$query->whereHas('address', function($q) use ($data){
	    		$q->where('city_id', '=', $data['cityId']);
			});
	}

	public function orderByName($query, $order)
	{
		$language = $this->getCurrentLang();
		$ids = $query->lists('id');
		$language = $this->getCurrentLang();
		$query->join('classifieds_lang as lang','classifieds.id','=','lang.classified_id')
		->where('lang.language_id','=',$language->id)
		->whereIn('classifieds.id',$ids)
		->orderBy('lang.name', $order)
		->select('classifieds.*');
	}

	public function orderByPrice($query, $order){
		$query->orderBy('price',$order);
	}

	public function create($data = array())
	{
		$classified = $this->model->create($data);
		
		$classified->languages()->attach($data['language_id'], array('name'=> $data['name'],
			'description'=> $data['description'],
			'address' => $data['address']
		));

		if (!is_null($data['categories']))
			$classified->categories()->sync($data['categories']);

		return $classified;
	}

	public function updateClassified($data = array())
	{
		$classified = $this->get($data['classified_id']);
		$classified->price = $data['price'];
		$classified->user_id = 1;
		$classified->classified_type_id = $data['classified_type_id'];
		$classified->classified_condition_id = $data['classified_condition_id'];
		$classified->save();

		if (count($classified->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$classified->languages()->updateExistingPivot($data['language_id'], array('name'=> $data['name'],
				'description'=> $data['description'],
				'address' => $data['address']
			));
		}else{
			$classified->languages()->attach($data['language_id'], array('name'=> $data['name'],
				'description'=> $data['description'],
				'address' => $data['address']
			));
		}

		if (isset($data['categories'])){
			$classified->categories()->sync($data['categories']);
		}else{
			$classified->categories()->detach();
		}

		return $classified;
	}

	public function delteClassified($classifiedId)
	{
		$classified = $this->get($classifiedId);
		$classified->delete();
 	}

	public function getName($data)
	{
		$language = Language::select()->where('id','=',$data['language_id'])->first();
		if (count($language) > 0) {
			return $language->classifieds()->wherePivot('name','=',$data['name'])->first();
		}else{
			return $language;
		}
	}

	public function getNameForEdit($data = array())
	{
		return ClassifiedsLang::select()->where('classified_id','!=',$data['classified_id'])->where('name','=',$data['name'])->first();
	}

	public function filterClassifieds($filterWord, $language_id) {
		$query = ClassifiedsLang::select();
		if (!empty($filterWord)) {
			$query->where('language_id', '=', $language_id)->where('name', 'LIKE', '%' . $filterWord . '%')->orWhere('description', 'LIKE', '%' . $filterWord . '%');
		}
		return $query->get();
	}


	public function updateAttributeLang(Classified $classified, $data = array()){

		if (count($classified->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$classified->languages()->updateExistingPivot($data['language_id'], array('name'=> $data['name'],
				'description'=> $data['description'],
				'address' => $data['address']
			));
		}else{
			$classified->languages()->attach($data['language_id'], array('name'=> $data['name'],
				'description'=> $data['description'],
				'address' => $data['address']
			));
		}

	}

	public function getNewClassifieds($quantity = 4)
	{
		return Classified::orderBy('created_at', 'DESC')->take($quantity)->get();
	}

	public function getTopClassifieds($quantity = 4)
	{
		/*
		SELECT p.id, sum(r.points) / count(p.id) AS avg FROM products p 
		JOIN ratings r ON (p.id=r.product_id)
		group by p.id
		order by AVG DESC, r.updated_at DESC
		*/
		/*return Product::join('ratings', 'products.id', '=', 'ratings.product_id')
			->select(['products.*', DB::raw('SUM(ratings.points)/COUNT(products.id) AS AVG')])
			->groupBy('products.id')
			->orderBy('AVG', 'DESC')
			->orderBy('ratings.updated_at', 'DESC')
			->take($quantity)
			->get();*/
	}	

	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Actions', function($model)
		{
			$language = $this->getCurrentLang();

			$this->cleanActionColumn();
			$this->addActionColumn("<form action='".route('classifieds.show',$model->id)."' method='get'>
						<button href='#'  class='btn btn-success btn-outline dim col-sm-8 show' style='margin-left: 20px;' type='submit' data-toggle='tooltip' data-placement='top' title='".trans('classifieds.actions.Show')."'  data-original-title='".trans('classifieds.actions.Show')."' ><i class='fa fa-check fa-2x'></i></button><br/>
					  </form>");
			$this->addActionColumn("<button href='#fancybox-edit-classified' id='edit_classified_".$model->id."' class='btn btn-warning btn-outline dim col-sm-8 edit' style='margin-left: 20px; ' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Edit')."'  data-original-title='".trans('products.actions.Edit')."' ><i class='fa fa-pencil fa-2x'></i>
					 </button><br/>");
			$this->addActionColumn("<button href='#' class='btn btn-danger btn-outline dim col-sm-8 delete' id='delet_".$model->id."' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Delete')."'  data-original-title='".trans('products.actions.Delete')."' ><i class='fa fa-times fa-2x'></i>
					 </button><br/>");
			if($model->active)
				$this->addActionColumn("<button href='#' class='btn btn-primary btn-outline dim col-sm-8 deactivated' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Activate')."'  data-original-title='".trans('products.actions.Deactivated')."'> <i class='fa fa-check fa-2x'></i></button><br />");
			else
				$this->addActionColumn("<button href='#' class='btn btn-danger btn-outline dim col-sm-8 activate' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Deactivated')."'  data-original-title='".trans('products.actions.Activate')."'> <i class='fa fa-check fa-2x'></i></button><br />");
			
			$this->addActionColumn("<form action='".route('photoClassified.create',array($model->id, $language->id))."' method='get'>
							<button href='#' class='btn btn-info btn-outline dim col-sm-8 photo' style='margin-left: 20px' type='submit' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Photo')."'  data-original-title='".trans('products.actions.Photo')."'> <i class='fa fa-camera fa-2x'></i></button><br />
					  </form>");
			$this->addActionColumn("<button href='#fancybox-edit-language-classified' id='language_classified_".$model->id."'  class='btn btn-success btn-outline dim col-sm-8 language' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Language')."'  data-original-title='".trans('products.actions.Language')."'> <i class='fa fa-pencil fa-2x'></i></button><br />");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('name','description', 'address');
		$this->collection->orderColumns('name','description', 'address');

		$this->collection->addColumn('photo', function($model)
		{
			$links = '';
			
			$photo = $model->FirstPhoto;

			if ($photo != false) {
				$links .= "	<a href='#'>
									<img class='mini-photo' alt='" . $photo->filename . "' src='" . asset($photo->complete_path) . "'>
				</a>";
			}
				
			return $links;
		});

		$this->collection->addColumn('name', function($model)
		{
			return $model->InCurrentLang->name;
		});
		
		$this->collection->addColumn('description', function($model)
		{
			return $model->InCurrentLang->description;
		});

		$this->collection->addColumn('address', function($model)
		{
			return $model->address->description;
		});

		$this->collection->addColumn('price', function($model)
		{
			return $model->price;
		});

		
		$this->collection->addColumn('user', function($model)
		{
			return $model->user->username;
		});

		$this->collection->addColumn('categories', function($model)
		{
			if($model->hasCategories())
			{
				$categoryNames = $model->getCategoryNames();
				$links = '<select class="form-control m-b">';
				foreach ($categoryNames as $category) {
					$links .= '<option>'.$category.'</option>';
				}
				$links .='</select>';
				return $links;
			}
			return '';	
		});

		$this->collection->addColumn('classified_type', function($model)
		{
			$language = $this->model->getCurrentLang();
			$classifiedTypeLanguage = $model->classifiedType->languages()->where('language_id','=',$language->id)->first();
			return $classifiedTypeLanguage->pivot->name;
		});

		$this->collection->addColumn('classified_condition', function($model)
		{
			$language = $this->model->getCurrentLang();
			$classifiedConditionLanguage = $model->classifiedCondition->languages()->where('language_id','=',$language->id)->first();
			return $classifiedConditionLanguage->pivot->name;
		});
	}

}
