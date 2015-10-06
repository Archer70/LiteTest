<?php
spl_autoload_register(function($classNamespace) {
	$path = str_replace(['\\', 'LiteTest/'], ['/', ''], $classNamespace);
	$path = sprintf('%s/../%s.php', __DIR__, $path);
	if (file_exists($path)) {
		require $path;
	} 
});
