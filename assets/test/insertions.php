<?
session_start();

include('../../codebase/core/database.inc');
include('../../codebase/core/encryption.inc');

$db = new Database();
$db->set_credentials('localhost', 'paco', 'hello', 'paco');
//$db->select_db('paco');

/*$db->insert(
	'sites', 
	array(
		'site_name'=>rand(),
		'credentials'=>array(
				'ftp'=>array(
					'ftp_host'=>'localhost',
					'ftp_port'=>22,
					'ftp_username'=>'dave',
					'ftp_password'=>utf8_encode(Encryption::encrypt('dave'))
				),
				'ssh'=>array(
					'ssh_user'=>'dave'
				)
			),
		'users'=>array(
			'_id'=>new MongoID($_SESSION['id']),
			'permissions'=>array('admin', 'editor')
		)
	)
);*/

/*db->update(
	'sites',
	array('_id'=>new MongoID('4caa00c28ead0ed30f030000')),
	array(
		'modules'=>array('news', 'images', 'cms')
	)
);*/

/*$db->update(
	'users',
	array('_id'=>new MongoID('4ca605bb8ead0e5005020000')),
	array(
		'api'=>array(
			'key'=>md5('motherfucker'),
			'secret'=>md5('cunt'),
		),
		'name'=>'Dave Bullough',
		'email'=>'dave@agsc.co.uk'
	)
);*/

$db->insert(
	'pages',
	array(
		'site_id'=>new MongoId('4ce3ea8dff507872e15cdce7'),
		'url'=>'/',
		'title'=>'Welcome to ACME Corp',
		'parent'=>null
	)
);
?>
