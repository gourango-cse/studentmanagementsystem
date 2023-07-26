<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require 'vendor/autoload.php';
use Illuminate\Blade\Environment;
use Illuminate\Blade\Loader;
use Illuminate\Blade\View;
class MY_Loader extends CI_Loader {
	public function __construct()
	{
		parent::__construct();
	}
	public function blade($view, array $parameters = array())
	{
		$CI =& get_instance();
		$CI->config->load('blade', true);
		return new View(
			new Environment(Loader::make(
				$CI->config->item('views_path', 'blade'),
				$CI->config->item('cache_path', 'blade')
			)),
			$view, $parameters
		);
	}
}