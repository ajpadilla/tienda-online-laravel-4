<?php namespace s4h\store\PaymentsTypes;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\Base\BaseRepository;
use s4h\store\PaymentsTypes\PaymentsTypes;

class PaymentsTypesRepository extends BaseRepository
{
	public function getModel()
    {
      return new PaymentsTypes;
    }

    public function create($data = array())
    {
    	//
    }

    public function update($data = array())
    {
    	//
    }

    public function delete($id)
    {
    	//
    }

    public function getNameForLanguage()
    {
        $language = $this->getCurrentLang();
        return $language->paymentsTypes()->lists('name','payments_types_id');
    }
}