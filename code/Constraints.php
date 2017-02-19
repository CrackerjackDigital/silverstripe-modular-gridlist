<?php
namespace Modular\GridList;

use Member;
use Modular\Interfaces\Service;
use Modular\Object;
use Modular\Traits\owned;

class Constraints extends Object implements Service {
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

	/**
	 * Make a request of a service, which generally calls request by extensions on Request extensions added to the service.
	 * Service request extensions should only do something with the request if the serviceName requested matches their own
	 * serviceName (which is generally their class name).
	 *
	 * @param string      $serviceName ignored in this case
	 * @param mixed       $data        data override the default data if set
	 * @param null        $options     options for request, e.g. to queue the data, process immediately etc
	 * @param Member|null $requester   who requested the service, or null if current logged in member
	 * @return array of values decoded from the request
	 */
	public function request($serviceName, $data, $options = null, $requester = null) {
		return array_merge(
			[
				'Mode' => $this->mode(),
			    'Start' => $this->start(),
			    'Limit' => $this->limit(),
			    'Sort' => $this->sort(),
			],
			is_array($data) ? $data : []
		);
	}
}
