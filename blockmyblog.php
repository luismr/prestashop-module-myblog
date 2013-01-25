<?php
/*
 * Module ......: blockmyblog
 * File ........: blockmyblog.php
 * Description .: Simple Prestashop Module to publish My Blog Ad links on template
 * Authot ......: Luis Machado Reis <luis.reis@singularideas.com.br>
 * Licence .....: GNU Lesser General Public License V3
 * Created .....: 01/09/2010
 */

class blockmyblog extends Module {

	private $_html = '';

	private $blogName = '';
	private $blogUrl = '';
	private $blogLogo = '';

	function __construct() {
		$this->name = 'blockmyblog';
		parent::__construct();

		$this->tab = 'SingularIdeas.com.br Modules';
		$this->version = '0.1';
		$this->displayName = $this->l('MyBlog Block');
		$this->description = $this->l('MyBlog Logo Block');

		$this->_refresh();
	}

	function install() {
		if (parent::install() == false || $this->registerHook('leftColumn') == false) {
			return false;
		}
				
		return true;
	}

	public function getContent() {
		if (Tools::isSubmit('submit')) {
			$this->_update();
		}

		$this->_displayForm();
		return $this->_html;
	}
	
	public function _displayForm() {
		$this->_refresh();
		$this->_html .= '
			<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
				<fieldset>
					<legend><img src="../modules/'.$this->name.'/logo.gif" />'.$this->l('MyBlog Block').'</legend>
					<label>'.$this->l('My Blog Name').'</label>
					<div class="margin-form">
						<input type="text" size="75" name="blogName" value="'.$this->blogName.'"/>
					</div>
					<label>'.$this->l('URL').'</label>
					<div class="margin-form">
						<input type="text" size="75" name="blogUrl" value="'.$this->blogUrl.'"/>
					</div>
					<label>'.$this->l('Logo URL').'</label>
					<div class="margin-form">
						<input type="text" size="75" name="blogLogo" value="'.$this->blogLogo.'"/>
					</div>

					<input type="submit" name="submit" value="'.$this->l('Update').'" class="button" />
				</fieldset>
			</form>';	
	}

	/**
	* Returns module content for left column
	*
	* @param array $params Parameters
	* @return string Content
	*
	* @todo Links on tags (dedicated page or search ?)
	*/
	function hookLeftColumn($params) {
		global $smarty;

		$smarty->assign('name', $this->blogName);
		$smarty->assign('url', $this->blogUrl);
		$smarty->assign('logo', $this->blogLogo);

		return $this->display(__FILE__, 'blockmyblog.tpl');
	}

	function hookRightColumn($params) {
		return $this->hookLeftColumn($params);
	}

	private function _refresh() {
		$this->blogName = Configuration::get($this->name.'_name');
		$this->blogUrl = Configuration::get($this->name.'_url');
		$this->blogLogo = Configuration::get($this->name.'_logo');
	}
	
	private function _update() {
		Configuration::updateValue($this->name.'_name', Tools::getValue('blogName'));
		Configuration::updateValue($this->name.'_url', Tools::getValue('blogUrl'));
		Configuration::updateValue($this->name.'_logo', Tools::getValue('blogLogo'));
	}
}
