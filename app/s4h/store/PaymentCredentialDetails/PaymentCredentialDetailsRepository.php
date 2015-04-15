<?php namespace s4h\store\PaymentCredentialDetails;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\Base\BaseRepository;
use s4h\store\PaymentCredentialDetails\PaymentCredentialDetails;

class PaymentCredentialDetailsRepository extends BaseRepository
{
	public function getModel()
    {
      return new PaymentCredentialDetails;
    }

    public function getAll()
    {
        return PaymentCredentialDetails::all();
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
}