<?php

/**
 * Menu class useful for customized menu
 */
class AddNavMenu {

	private static $instance;

	public static function instance()
	{
		if (!isset(self::$instance)) {
			$c = __CLASS__;
			self::$instance = new $c;
		}

		return self::$instance;
	}

	/**
	 * Metodo insert menu no site.
	 * @param Array $argsWPNavMenu Informações que serão agrupadas ao default de wp_nav_menu. array();
	 * @param string $itensAppend Adiciona no fim da lista.
	 * @param string $itensPrepend Adiciona no inicio da lista.
	 * @return AddNavMenu
	 */
	public function add(
		$argsWPNavMenu = null,
		$itensAppend = "",
		$itensPrepend = "",
		$classWalkerMenu = false
	) {
		global $wp;

		$w = (is_object($classWalkerMenu)) ? $classWalkerMenu : new Walker_Quickstart_Menu();
		$w->setRequest(get_the_ID());

		if(empty($argsWPNavMenu)) {
			$argsWPNavMenu = array();
		}

		$argsWPNavMenu = array_merge(array(
				'container'		=> false,
				'container_id'	=> false,
				'echo'			=> false,
				'walker'		=> $w
			), $argsWPNavMenu);

		$menu = wp_nav_menu($argsWPNavMenu);
		$menu = preg_replace('#(^<ul[^>]*>)#', "$1\n\t\t".$itensPrepend, $menu);
		$menu = preg_replace('#(</ul>$)#', "\n\t\t".$itensAppend."\n$1", $menu);

		echo $menu;

		return $this;
	}
}
