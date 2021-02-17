<?php

mb_internal_encoding('utf-8');

class bot_repkaCommand extends CConsoleCommand
{	public $domain = 'http://repka.ua';

	public function actionIndex() {		require_once(YiiBase::getPathOfAlias('application.components.simple_html_dom').'.php');

		$content = file_get_html($this->domain,false, null, -1, -1, true, true, 'utf-8');
		foreach($content->find('#tabs div.tab-item') as $element) {			foreach($element->find('td.item-title') as $el) {				foreach($element->find('.category div.element') as $el2) {
						$info[strip_tags(trim($el->innertext))][trim($el2->parent->find('div.title')[0]->plaintext)][$this->domain.trim($el2->find('a')[0]->href)] = trim($el2->plaintext);

				}
			}
		}

		print_r($info);
	}}


?>