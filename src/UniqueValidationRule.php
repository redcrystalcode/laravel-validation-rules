<?php
namespace RedCrystal\ValidationRules;

/**
 * Class UniqueValidationRule
 *
 * @package RedCrystal\ValidationRules
 */
class UniqueValidationRule
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
     * @var string
     */
    protected $primaryKey;

    /**
     * @var mixed
     */
    protected $ignore;

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
     * @param $id
     * @param string $primaryKey
     *
     * @return $this
     */
    public function ignore($id, $primaryKey = 'id')
    {
        $this->ignore = $id;
        $this->primaryKey = $primaryKey;

        return $this;
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
     * @return string
     */
    public function toString()
    {
        $string = 'unique:';

        $string .= $this->table . ',' . $this->column;

        $string .= ',' . ($this->ignore ?: 'NULL') . ',' . ($this->primaryKey ?: 'id');

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
