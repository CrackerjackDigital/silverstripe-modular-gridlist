<?php
namespace Modular\GridList;

use Modular\GridList\Interfaces\Service\Service as ServiceInterface;
use Modular\Object;
use Modular\Traits\owned;

class Service extends \Modular\Service implements ServiceInterface {
	use owned;

	const FiltersClassName = 'Modular\GridList\Constraints';

	public function constraint($name, $persistance = null) {
		return $this->Filters()->constraint($name, $persistance);
	}

	public function mode() {
		return $this->Filters()->mode();
	}

	public function sort() {
		return $this->Filters()->sort();
	}

	public function start() {
		return $this->Filters()->start();
	}

	public function limit() {
		return $this->Filters()->limit();
	}

	/**
	 * @param $params
	 * @return string
	 */
	public function filterLink($params) {
		$params = is_array($params) ? $params : [$params];
		return \Director::get_current_page()->Link() . '?filter=' . implode(',', $params);
	}

	/**
	 * Allow calls statically through to Filters as it's easier then
	 *
	 * @return Constraints
	 */
	public function Filters() {
		return \Injector::inst()->get(static::FiltersClassName);
	}
}
