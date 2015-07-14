<?php namespace s4h\store\CardBrands;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\Base\BaseRepository;
use s4h\store\CardBrands\CardBrands;

class CardBrandsRepository extends BaseRepository
{
	
    public function listAll()
    {
        return CardBrands::all()->lists('name','id');
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