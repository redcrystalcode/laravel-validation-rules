<?php
namespace RedCrystal\ValidationRules;

/**
 * Class ExistsValidationRule
 *
 * @package RedCrystal\ValidationRules
 */
class ExistsValidationRule
{
    /**
     * @var string
     */
    protected $table;

    /**
     * @var string
     */
    protected $column;

    /**
     * @var array
     */
    protected $whereClauses = [];

    /**
     * @param $table
     * @param $column
     */
    public function __construct($table, $column)
    {
        $this->table = $table;
        $this->column = $column;
    }

    /**
     * @param $column
     * @param $value
     *
     * @return $this
     */
    public function where($column, $value)
    {
        $this->whereClauses[] = [$column, $value];

        return $this;
    }

    /**
     * @param $column
     *
     * @return $this
     */
    public function whereNull($column)
    {
        $this->where($column, 'NULL');

        return $this;
    }

    /**
     * @param $column
     *
     * @return $this
     */
    public function whereNotNull($column)
    {
        $this->where($column, 'NOT_NULL');

        return $this;
    }

    /**
     * @return string
     */
    public function toString()
    {
        $string = 'exists:';

        $string .= $this->table . ',' . $this->column;

        foreach ($this->whereClauses as $pair) {
            list($column, $value) = $pair;
            $string .= ',' . $column . ',' . ($value ?: 'NULL');
        }

        return $string;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

}
