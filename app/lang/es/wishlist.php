<?php
	return array(
		"routes" => array(
			"create" => "deseos/agregar/{id}",
			"store" => "deseos/guardar",
			"api" => array(
				'delete-ajax' => 'deseos/api/deseos-eliminar-ajax/{id}',
				"index" => "deseos/api/lista-deseos",
			),
		),
		"index-title"=> "Lista de deseo",
	);
