<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 hmmh Team TYPO3 <typo3@hmmh.de>, hmmh multimediahaus AG
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/


/**
 * TurnJS Controller
 *
 * @package turnjs
 */
class Tx_Turnjs_Controller_TurnjsController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	* t3lib_queryGenerator is needed to recursively fetch a page tree
	*
	* @var t3lib_queryGenerator
	*/
	protected $queryGenerator;

	/**
	* Inject query generator
	*
	* @param t3lib_queryGenerator $queryGenerator
	* @return void
	*/
	public function injectQueryGenerator(t3lib_queryGenerator $queryGenerator) {
		$this->queryGenerator = $queryGenerator;
	}

	/**
	 * action index
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->mergeTypoScript2FlexForm();
		$this->addHeaderData();

		switch ($this->settings['mode']) {
			case 1:
				$pages = explode(',', $this->settings['selectPages']);
				break;
			default:
				$startingPoint = empty($this->settings['startingPoint'])?$GLOBALS['TSFE']->id:$this->settings['startingPoint'];
				$pages = $this->queryGenerator->getTreeList($startingPoint, $this->settings['treelevel'], 0, 'doktype = 1');
				$pages = explode(',', $pages);
		}

		if ($this->settings['excludeStartingPoint']) {
			array_shift($pages);
		}

		$pages1 = array_slice($pages, 0, 2, TRUE);
		$options = $this->settings['options'];

		$this->view->assign('pages', $pages);
		$this->view->assign('pages1', $pages1);
		$this->view->assign('count', count($pages));
		$this->view->assign('options', $options);
	}


	/**
	 * Add addtional header data
	 *
	 * @return void
	 */
	protected function addHeaderData() {
		// Include jQuery
		if ($this->settings['includeJquery']) {
			$this->response->addAdditionalHeaderData('<script type="text/javascript" src="' .
				t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) .
				'Resources/Public/Scripts/jquery-1.7.1.min.js"></script>');
		}

		// Include Turn.js
		if ($this->settings['includeTurnjs']) {
			$this->response->addAdditionalHeaderData('<script type="text/javascript" src="' .
				t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) .
				'Resources/Public/Scripts/turn.min.js" /></script>');
		}

		// Include Hash.js
		if ($this->settings['includeHashjs']) {
			$this->response->addAdditionalHeaderData('<script type="text/javascript" src="' .
				t3lib_extMgm::siteRelPath($this->request->getControllerExtensionKey()) .
				'Resources/Public/Scripts/hash.js" /></script>');
		}
	}

	/**
	 * Merge TypoScript and Flexform values (Flexform has the priority)
	 *
	 * @return	void
	 */
	protected function mergeTypoScript2FlexForm() {
		$tmpSettings = $this->settings;
		if (isset($this->settings['flexform']) && is_array($this->settings['flexform'])) {
			$this->mergeArray($this->settings['flexform'], $tmpSettings);
		}
		unset($tmpSettings['flexform']);
		$this->settings = $tmpSettings;
	}

	/**
	 * Merge Arrays recursively ($arr1 has the priority)
	 *
	 * @return	void
	 */
	protected function mergeArray(&$arr1, &$arr2) {
		foreach ((array) $arr1 as $key => $value) {
			if (is_array($value)) {
				$this->mergeArray($value, $arr2[$key]);
			} elseif (strlen($value) > 0) {
				// overwrite settings if not empty
				$arr2[$key] = $value;
			}
		}
	}

}

?>