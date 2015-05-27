<?php

$date_format = ['label' => 'dd-mm-yy', 'php' => 'd-m-y', 'mysql' => '%d-%m-%y', 'php_output' => 'd M Y',
    'regex' => "/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{2}$/"];

return array(

    'site_name' => 'Unilever CLM',
    'date_format' => $date_format,
    
    'permissions' => [
        'admin',
        'club create',
        'club delete',
        'club edit',
        'club view',
    ],
    
    'tables' => [
        'club'			=> '1',
    	'service'		=> '2',
		'room'			=> '3'              
    ],
    
    'file_types' => [
        'avatar'        => '1',       
    ],
    
    'contact_types' => [
        'office_num'    => '1',
        'mobile_num'    => '2',
        'email'         => '3',
        'fax'           => '4',
    ],
    
    'hcp_categories'  => [
        1 => 'Medical Doctor',
        2 => 'Fitness Coach',
        3 => 'Wellness Expert'
    ],    
);