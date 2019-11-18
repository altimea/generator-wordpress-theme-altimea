<?php
/**
 * Custom menu wp
 */
class Walker_Quickstart_Menu extends Walker {

	public $db_fields = array(
		'parent' => 'menu_item_parent',
		'id'     => 'db_id'
	);

	private $r;

	public function setRequest($str){
		$this->r = $str;
	}

	/**
	 * At the start of each element, output a <li> and <a> tag structure.
	 *
	 * Note: Menu objects include url and title properties, so we will use those.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$stringFormater = "\n<li class=\"nav__container--items_list--items\">";
		$stringFormater .= "<a href='%s'>";
		$stringFormater .= "<div class=\"item %s \">";
		$stringFormater .= "<span>%s</span>";
		$stringFormater .= "</div>";
		$stringFormater .= "</a>";
		$stringFormater .= "</li>\n";

		$output .= sprintf($stringFormater,
			$item->url,
			( $item->object_id == $this->r ) ? ' active-item-menu-desktop' : '',
			$item->title
		);
	}
};

?>
<nav>
	<div class="nav__container--items">
		<!-- print Menú list ul>li -->
		<?php
			$menu = AddNavMenu::instance();
			$menu->add(array(
				'menu_class'	=> 'nav__container--items_list',
				'theme_location'=> 'menu-primary',
				'depth'			=> 0
			));
		?>
	</div>
</nav>
