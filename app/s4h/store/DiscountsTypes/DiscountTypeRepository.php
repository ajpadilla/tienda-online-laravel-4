<?php namespace s4h\store\DiscountsTypes;

use s4h\store\DiscountsTypes\DiscountType;
use s4h\store\Languages\Language;
use s4h\store\DiscountTypesLang\DiscountTypeLang;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Base\BaseRepository;

class DiscountTypeRepository extends BaseRepository{

	function __construct() {
		$this->columns = [
			trans('discountType.list.Name'),
			trans('discountType.list.Actions')
		];
		$this->setModel(new DiscountType);
		$this->setListAllRoute('discountType.api.list');
	}

	public function getName($data)
	{
		$language = Language::select()->where('id','=',$data['language_id'])->first();
		if (count($language) > 0) {
			return $language->discounts_types()->wherePivot('name','=',$data['name'])->first();
		}else{
			return $language;
		}
	}
	
	public function getAllForCurrentLang()
	{
		$language = $this->getCurrentLang();
		if (!empty($language))
			return $language->discounts_types()->lists('name','discount_type_id');
		else
			return array();
	}

	public function create($data = array())
	{
		$discountType = $this->model->create([]);
		$discountType->languages()->attach($data['language_id'], array('name'=> $data['name']));	
		return $discountType;
	}

	public function updateDiscountType($data = array())
	{
		$discount_type = $this->getDiscountTypeId($data['discount_type_id']);
		$discount_type->save();

		if (count($discount_type->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$discount_type->languages()->updateExistingPivot($data['language_id'], array('name' => $data['name']));
		}else{
			$discount_type->languages()->attach($data['language_id'], array('name' => $data['name']));
		}
	}

	public function deletediscountType($discount_type_id)
	{
		$discount_type = $this->getDiscountTypeId($discount_type_id);
		$discount_type->delete();
	}

	public function getDiscountTypeId($discount_type_id)
	{
		return DiscountType::find($discount_type_id);
	}


	public function getNameForEdit($data = array())
	{
		return DiscountTypeLang::select()->where('discount_type_id','!=',$data['discount_type_id'])->where('name','=',$data['name'])->first();
	}

	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Actions', function($model)
		{
			$language = $this->getCurrentLang();

			$this->cleanActionColumn();
			$this->addActionColumn("<form action='".route('products.show',$model->id)."' method='get'>
						<button href='#'  class='btn btn-success btn-outline dim col-sm-8 show' style='margin-left: 20px;' type='submit' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Show')."'  data-original-title='".trans('products.actions.Show')."' ><i class='fa fa-check fa-2x'></i></button><br/>
					  </form>");
			$this->addActionColumn("<button href='#fancybox-edit-product' id='edit_product_".$model->id."' class='edit-product btn btn-warning btn-outline dim col-sm-8' style='margin-left: 20px; ' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Edit')."'  data-original-title='".trans('products.actions.Edit')."' ><i class='fa fa-pencil fa-2x'></i>
					 </button><br/>");
			$this->addActionColumn("<button href='#' class='delete-product btn btn-danger btn-outline dim col-sm-8' id='delet_product_".$model->id."' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Delete')."'  data-original-title='".trans('products.actions.Delete')."' ><i class='fa fa-times fa-2x'></i>
					 </button><br/>");
			if($model->active)
				$this->addActionColumn("<button href='#' class='btn btn-primary btn-outline dim col-sm-8 deactivated' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Activate')."'  data-original-title='".trans('products.actions.Deactivated')."'> <i class='fa fa-check fa-2x'></i></button><br />");
			else
				$this->addActionColumn("<button href='#' class='btn btn-danger btn-outline dim col-sm-8 activate' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Deactivated')."'  data-original-title='".trans('products.actions.Activate')."'> <i class='fa fa-check fa-2x'></i></button><br />");
			
			$this->addActionColumn("<form action='".route('photoProduct.create',array($model->id, $language->id))."' method='get'>
							<button href='#' class='btn btn-info btn-outline dim col-sm-8 photo' style='margin-left: 20px' type='submit' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Photo')."'  data-original-title='".trans('products.actions.Photo')."'> <i class='fa fa-camera fa-2x'></i></button><br />
					  </form>");
			$this->addActionColumn("<button href='#fancybox-edit-language-product' id='language_product_".$model->id."'  class='edit-product-lang btn btn-success btn-outline dim col-sm-8' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Language')."'  data-original-title='".trans('products.actions.Language')."'> <i class='fa fa-pencil fa-2x'></i></button><br />");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('name');
		$this->collection->orderColumns('name');

		$this->collection->addColumn('name', function($model)
		{
			return $model->InCurrentLang->name;
		});
	}

}