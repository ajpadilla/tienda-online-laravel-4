<?php 
	
return array(
	"routes" => array(
		"show" => "DetallesdecredencialesDePago/ver/{id}",
		"create" => "DetallesdecredencialesDePago/crear",
		"store" => "DetallesdecredencialesDePago/agregar",
		'edit' => 'DetallesdecredencialesDePago/editar/{id}',
		'update' => 'DetallesdecredencialesDePago/actualizar',
		'destroy' => 'DetallesdecredencialesDePago/eliminar/{id}',
		"api" => array(
			'index'=>'DetallesdecredencialesDePago/api/lista-DetallesdecredencialesDePago',
			"delete-ajax" =>"DetallesdecredencialesDePago/api/eliminar-DetallesdecredencialesDePago",
			"saveLang" => 'DetallesdecredencialesDePago/api/actualizar-idioma',
			),
		),
)

