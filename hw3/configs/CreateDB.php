<?php 
namespace kareemkevin\hw3\Configs;
use kareemkevin\hw3\Models as Models;
// http://php.net/manual/en/control-structures.alternative-syntax.php regarding use of : and endif 

include "autoloader.php";

$model = new Models\CreateDB();

if( !$model->tablesExist() ):

	$model->createTables();
	$model->insertDummyData();

	echo "Tables created and mock data imported.";

else :

	echo "DB is not empty";

endif;