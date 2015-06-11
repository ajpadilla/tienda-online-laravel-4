<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Table specific configuration options.
    |--------------------------------------------------------------------------
    |
    */

    'table' => array(

        /*
        |--------------------------------------------------------------------------
        | Table class
        |--------------------------------------------------------------------------
        |
        | Class(es) added to the table
        | Supported: string
        |
        */

        'class' => 'table table-bordered',

        /*
        |--------------------------------------------------------------------------
        | Table ID
        |--------------------------------------------------------------------------
        |
        | ID given to the table. Used for connecting the table and the Datatables
        | jQuery plugin. If left empty a random ID will be generated.
        | Supported: string
        |
        */

        'id' => 'datatable',

        /*
        |--------------------------------------------------------------------------
        | DataTable options
        |--------------------------------------------------------------------------
        |
        | jQuery dataTable plugin options. The array will be json_encoded and
        | passed through to the plugin. See https://datatables.net/usage/options
        | for more information.
        | Supported: array
        |
        */

        'options' => array(

            "sPaginationType" => "full_numbers",

            "bProcessing" => false,

            "retrieve" => true,

            'language' => array(
                'processing'=>     'Procesando...',
                'lengthMenu'=>     'Mostrar: _MENU_',
                'zeroRecords'=>    'No se encontraron resultados',
                'emptyTable'=>     'Ningún dato disponible en esta tabla',
                'info'=>           'Del _START_ al _END_ de _TOTAL_ registros',
                'infoEmpty'=>      'Del 0 al 0 de un total de 0 registros',
                'infoFiltered'=>   '(filtrado de un total de _MAX_ registros)',
                'infoPostFix'=>    '',
                'search'=>         'Buscar: ',
                'url'=>            '',
                'infoThousands'=>  ',',
                'loadingRecords'=> 'Cargando...',
                'paginate'=> array(
                    'first'=>    '<<',
                    'last'=>     '>>',
                    'next'=>     '>',
                    'previous'=> '<'
                ),
                'aria'=> array(
                    'sortAscending' =>  'Ordenar la columna de manera ascendente',
                    'sortDescending' => 'Ordenar la columna de manera descendente'
                ),
            ),            
        ),
        /*
        |--------------------------------------------------------------------------
        | DataTable callbacks
        |--------------------------------------------------------------------------
        |
        | jQuery dataTable plugin callbacks. The array will be json_encoded and
        | passed through to the plugin. See https://datatables.net/usage/callbacks
        | for more information.
        | Supported: array
        |
        */

        'callbacks' => array(),

        /*
        |--------------------------------------------------------------------------
        | Skip javascript in table template
        |--------------------------------------------------------------------------
        |
        | Determines if the template should echo the javascript
        | Supported: boolean
        |
        */

        'noScript' => false,


        /*
        |--------------------------------------------------------------------------
        | Table view
        |--------------------------------------------------------------------------
        |
        | Template used to render the table
        | Supported: string
        |
        */

        'table_view' => 'datatable::template',


        /*
        |--------------------------------------------------------------------------
        | Script view
        |--------------------------------------------------------------------------
        |
        | Template used to render the javascript
        | Supported: string
        |
        */

        'script_view' => 'datatable::javascript',


    ),


    /*
    |--------------------------------------------------------------------------
    | Engine specific configuration options.
    |--------------------------------------------------------------------------
    |
    */

    'engine' => array(

        /*
        |--------------------------------------------------------------------------
        | Search for exact words
        |--------------------------------------------------------------------------
        |
        | If the search should be done with exact matching
        | Supported: boolean
        |
        */

        'exactWordSearch' => false,

    )


);
