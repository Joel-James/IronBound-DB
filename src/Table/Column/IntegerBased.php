<?php
/**
 * Contains the class definition for IntegerBased column types.
 *
 * @author    Iron Bound Designs
 * @since     2.0
 * @license   MIT
 * @copyright Iron Bound Designs, 2016.
 */

namespace IronBound\DB\Table\Column;

use IronBound\DB\Exception\InvalidDataForColumnException;

/**
 * Class IntegerBased
 * @package IronBound\DB\Table\Column
 */
class IntegerBased extends BaseColumn {

	/**
	 * @var string
	 */
	protected $type;

	/**
	 * IntegerBased constructor.
	 *
	 * @param string $type         String column type.
	 * @param string $name         Name of this column.
	 * @param array  $options      Additional options for this column. For example, 'NOT NULL'.
	 * @param array  $type_options Type options. For example '20' in 'BIGINT(20)'.
	 */
	public function __construct( $type, $name, array $options = array(), array $type_options = array() ) {
		parent::__construct( $name, $options, $type_options );

		$this->type = $type;
	}

	/**
	 * @inheritDoc
	 */
	public function get_mysql_type() {
		return $this->type;
	}

	/**
	 * @inheritDoc
	 */
	public function convert_raw_to_value( $raw ) {
		return $raw === null ? $raw : (int) $raw;
	}

	/**
	 * @inheritDoc
	 */
	public function prepare_for_storage( $value ) {

		if ( is_null( $value ) ) {
			return $value;
		}

		if ( ! is_scalar( $value ) ) {
			throw new InvalidDataForColumnException( 'Non-scalar value encountered.', $this, $value );
		}

		return (int) $value;
	}
}
