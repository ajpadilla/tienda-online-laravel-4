<?php namespace s4h\store\Discounts;

use s4h\store\Discounts\Discount;
use s4h\store\Languages\LanguageRepository;
use s4h\store\DiscountTypesLang\DiscountTypeLang;
use s4h\store\DiscountsLang\DiscountLang;
use s4h\store\Base\BaseRepository;

class DiscountRepository extends BaseRepository{

	function __construct() {
		$this->columns = [
			trans('discounts.list.Code'),
			trans('discounts.list.Name'),
			trans('discounts.list.Discount_type'),
			trans('discounts.list.Value'),
			trans('discounts.list.Percent'),
			trans('discounts.list.Active'),
			trans('discounts.list.From'),
			trans('discounts.list.To'),
			trans('discounts.list.Actions')
		];
		$this->setModel(new Discount);
		$this->setListAllRoute('discounts.routes.api.list');
	}


	public function create($data = array())
	{
		$data['from'] = date("Y-m-d",strtotime($data['from']));
		$data['to'] = date("Y-m-d",strtotime($data['to']));

		$discount = $this->model->create($data);

		$discount->languages()->attach($data['language_id'], array('name' => $data['name'], 'description' => $data['description']));
	}

	public function update($data = array())
	{
		$data['from'] = date("Y-m-d",strtotime($data['from']));
		$data['to'] = date("Y-m-d",strtotime($data['to']));

		$discount = $this->get($data['discount_id']);
		$discount->update($data);

		if (count($discount->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$discount->languages()->updateExistingPivot($data['language_id'], array('name' => $data['name'], 'description' => $data['description']));
		}else{
			$discount->languages()->attach($data['language_id'], array('name' => $data['name'], 'description' => $data['description']));
		}
		
	}

	public function getArrayInCurrentLangData($discountId)
	{
		$discount = $this->get($discountId);
		$discountLanguage = $discount->InCurrentLang;
		return[
			'attributes' => $discount, 
			'from' => $discount->FromShow,
			'to' => $discount->ToShow, 
			'language' => $discountLanguage
		];
	}

	public function getCode($code)
	{
		return Discount::select()->where('code','=',$code)->first();
	}

	public function getDiscountId($discount_id)
	{
		return Discount::find($discount_id);
	}

	public function getCodeEdit($data = array())
	{
		return Discount::select()->where('id','!=',$data['discount_id'])->where('code','=',$data['code'])->first();
	}

	public function deleteDiscount($discount_id)
	{
		$discount = $this->getDiscountId($discount_id);
		$discount->delete();
	}

	public function setBodyTableSettings()
	{

		$this->collection->searchColumns('code','discount_type_id', 'value', 'percent', 'active', 'from', 'to');
		$this->collection->orderColumns('code','discount_type_id','value', 'percent', 'active', 'from', 'to');

		$this->collection->addColumn('code', function ($model) {
			return $model->code;
		});

		$this->collection->addColumn('name', function ($model) {
			return $model->InCurrentLang->name;
		});

		$this->collection->addColumn('discount_type_id', function($model)
		{
			return $model->discountType->InCurrentLang->name;
		});

		$this->collection->addColumn('value', function ($model) {
			return $model->value;
		});

		$this->collection->addColumn('percent', function ($model) {
			return $model->percent;
		});

		$this->collection->addColumn('active', function ($model) {
			return $model->ActivoShow;
		});

		$this->collection->addColumn('from', function($model)
		{
			return $model->FromShow;
		});

		$this->collection->addColumn('to', function($model)
		{
			return $model->ToShow;
		});
	}

	public function setDefaultActionColumn()
	{
		$this->addColumnToCollection('Actions', function($model)
		{
			$language = $this->getCurrentLang();

			$this->cleanActionColumn();
			$this->addActionColumn("<form action='".route('discounts.show',$model->id)."' method='get'>
				<button href='#'  class='btn btn-success btn-outline dim col-sm-6 show' style='margin-left: 20px;' type='submit' data-toggle='tooltip' data-placement='top' title='".trans('discounts.actions.Show')."'  data-original-title='".trans('discounts.actions.Show')."' ><i class='fa fa-check fa-2x'></i></button><br/>
			</form>");
			$this->addActionColumn("<button href='#fancybox-edit-discount' id='edit_discount_".$model->id."' class='edit-discount btn btn-warning btn-outline dim col-sm-6' style='margin-left: 20px; ' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discounts.actions.Edit')."'  data-original-title='".trans('discounts.actions.Edit')."' ><i class='fa fa-pencil fa-2x'></i>
		</button><br/>");
			$this->addActionColumn("<button href='#' class='delete-discount btn btn-danger btn-outline dim col-sm-6' id='delet_discount_".$model->id."' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discounts.actions.Delete')."'  data-original-title='".trans('discounts.actions.Delete')."' ><i class='fa fa-times fa-2x'></i>
		</button><br/>");
			$this->addActionColumn("<button href='#fancybox-edit-language-discount' id='language_discount_".$model->id."'  class='edit-discount-lang btn btn-success btn-outline dim col-sm-6' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('discounts.actions.Language')."'  data-original-title='".trans('discounts.actions.Language')."'> <i class='fa fa-pencil fa-2x'></i></button><br />");
			return implode(" ", $this->getActionColumn());
		});
	}

}