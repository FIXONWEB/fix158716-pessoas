<?php
/**
 * Plugin Name:     fix-pessoas
 * Plugin URI:      https://github.com/fixonweb/fix158716-pessoas
 * Description:     Ref 158716 - Cadastro de pessoas.
 * Author:          FIXONWEB
 * Author URI:      https://github.com/fixonweb
 * Text Domain:     fix158716-pessoas
 * Domain Path:     /languages
 * Version:         0.1.11
 *
 * @package         Fix158716_Pessoas
 */

// Código de identificação deste plugin 158716

require 'plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/fixonweb/fix158716-pessoas',
	__FILE__, 
	'fix158716-pessoas/fix158716-pessoas'
);


function fix158716_load_modules($directory, $recursive = true, $listDirs = false, $listFiles = true, $exclude = '') {
    $arrayItems = array();
    $skipByExclude = false;
    $handle = opendir($directory);
    if ($handle) {
        while (false !== ($file = readdir($handle))) {
        preg_match("/(^(([\.]){1,2})$|(\.(svn|git|md))|(Thumbs\.db|\.DS_STORE))$/iu", $file, $skip);
        if($exclude){
            preg_match($exclude, $file, $skipByExclude);
        }
        if (!$skip && !$skipByExclude) {
            if (is_dir($directory. DIRECTORY_SEPARATOR . $file)) {
                if($recursive) {
                    $arrayItems = array_merge($arrayItems, fix158716_load_modules($directory. DIRECTORY_SEPARATOR . $file, $recursive, $listDirs, $listFiles, $exclude));
                }
                if($listDirs){
                    $file = $directory . DIRECTORY_SEPARATOR . $file;
                    $arrayItems[] = $file;
                }
            } else {
                if($listFiles){
                    $file = $directory . DIRECTORY_SEPARATOR . $file;
                    $arrayItems[] = $file;
                }
            }
        }
    }
    closedir($handle);
    }
    return $arrayItems;
}


$path_modules = plugin_dir_path( __FILE__ )."add-in";
$dire = fix158716_load_modules($path_modules);
sort($dire);
foreach ($dire as $key => $value) {
	$extensao = substr($value, -4) ;
	if($extensao=='.php') require_once($value);;
}


function fix158716__file__(){
	return __FILE__;
}
function fix158716_plugin_file(){
	//return __FILE__.$path;
	return plugin_dir_path( __FILE__ );
}

add_action('wp_enqueue_scripts', "fix158716_enqueue_scripts");
function fix158716_enqueue_scripts(){
    wp_enqueue_script( 'jquery-validate-min', plugin_dir_url( __FILE__ ) . '/js/jquery.validate.min.js', array( 'jquery' )  );
}








