<?php 
/**
 * funciones principales
 */
class Principal{
	private static $instance;
	
	function __construct()
	{
		self::$instance =& $this;
	}
	public static function &get_instance()
	{
		return self::$instance;
	}
	public function hola(){
		echo "amor";
	}
}
?>