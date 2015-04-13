<?php
	return array(

		"routes" => array(
			"create" => "wistlist/add/{id}",
			"store" => "wishlist/store",
			"api" => array(
				'delete-ajax' => 'wistlist/api/wistlist-delete-ajax/{id}',
				"index" => "wistlist/api/wistlist", 
			)
		),
		"index-title"=> "wish list",
	);
