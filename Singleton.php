<?php
class Singleton
{
	/**
	 * Retorna la instancia Singleton de esta clase
	 */
	public static function getInstance()
	{
		static $instance = null;
		if (null === $instance) {
			$instance = new static();
		}
		return $instance;
	}

	/**
	 * constructor protegido para evitar la creacion de otra instancia
	 * usando el operador new desde fuera de la clase
	 */
	protected function __construct()
	{
	}

	/**
	 * clone es privado para evitar la clonacion de la isntancia
	 */
	private function __clone()
	{
	}

	/**
	 * metodo wakepup privado para eviar la deserializacion del objeto dede fuera
	 */
	private function __wakeup()
	{
	}
}

$obj = Singleton::getInstance();
var_dump($obj === Singleton::getInstance());  // bool(true)

$anotherObj = Singleton::getInstance();
var_dump($anotherObj === $obj);      // bool(true)

?>