<?php
namespace Modular\Constraints;

use Modular\Application;
use Modular\Constraint;
use Modular\Exceptions\Exception;
use Modular\Object;
use Modular\Fields\ModelTag;
use Modular\Models\GridListFilter;

/**
 * Filters limit what models are displayed on page depending on user selection, they can further restrict models after Constraints are applied.
 *
 * @package Modular\GridList
 */
class GridList extends Constraint {

	/**
	 * Return the ID of the current filter.
	 *
	 * @return int|null
	 */
	public function currentFilterID() {
		if ($filterTag = $this->constraint(static::FilterVar)) {
			if ($filter = GridListFilter::get()->filter(ModelTag::SingleFieldName, $filterTag)->first()) {
				return $filter->ID;
			}
		}
	}

	/**
	 * Return array of mode strings in preference order from query string or configuration.
	 *
	 * @return mixed
	 */
	public function modes() {
		$options = [
			$this->getVar(static::ModeGetVar, self::PersistExact),
			\Director::get_current_page()->config()->get('gridlist_default_mode'),
			$this->config()->get('default_mode'),
		];
		return array_filter($options);
	}

}