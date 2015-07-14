<?php namespace s4h\store\PaymentCredentialDetails;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\Base\BaseRepository;
use s4h\store\PaymentCredentialDetails\PaymentCredentialDetails;

class PaymentCredentialDetailsRepository extends BaseRepository
{

    public function create($data = array())
    {
        $data['credit_cart_expire_date'] = date("Y-m-d",strtotime($data['credit_cart_expire_date']));
    	return PaymentCredentialDetails::create($data);
    }

    public function update($data = array())
    {
        $credential = $this->getById($data['credential_id']);
        $data['credit_cart_expire_date'] = date("Y-m-d",strtotime($data['credit_cart_expire_date']));
    	return $credential->update($data);
    }

    public function delete($credentialId)
    {
    	 $credential = $this->getById($credentialId);
         $credential->delete();
    }

    public function getById($credentialId)
    {
        return PaymentCredentialDetails::findOrFail($credentialId);
    }
}