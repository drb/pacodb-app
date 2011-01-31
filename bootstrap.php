<?php
require_once('library/piku/piku.php');

// init the page loader to try and execute the page
try
{
	$piku = Piku::factory();
	$piku->bootstrap('library/piku/codebase/');
	$piku->production(false);
	$piku->alias("/([\-]+)/", "_");
	$piku->routes(
		array(
                    /*array(
                        'path'=>'',
			'route'=>'holding'
                    ),*/
		    array(
			'path'=>'',
			'route'=>array('class'=>'cms', 'method'=>'index')
		    ),
		    array(
                        'regex'=>"pages\/([a-z])",
                        'route'=>array('class'=>'cms', 'method'=>'$1')
                    ),
                    array(
                        'path'=>'login',
                        'route'=>array('class'=>'cms', 'method'=>'login')
                    ),
		    array(
                        'path'=>'logout',
                        'redirect'=>'/cms/logout'
                    ),
		     array(
                        'path'=>'register',
                        'route'=>array('class'=>'cms', 'method'=>'register')
                    ),
		    array(
			'path'=>'sitemap.xml',
			'route'=>array('class'=>'cms', 'method'=>'sitemap')
		    )
                )
            );
	$piku->page();
}
catch (Exception $e)
{
    $piku->fail($e);
}
?>