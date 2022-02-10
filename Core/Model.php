<?php
class Model
{
    //name of database table
    protected string $table_name = '';
    protected string $primary_key = 'id';

    //sql_string. Remeber to change query function when yoy add new sql.
    protected string $select_sql = '';
    protected string $table_sql = '';
    protected string $where_sql = '';
    protected string $order_sql = '';
    protected string $group_sql = '';
    protected string $limit_sql = '';
    protected string $distinct_sql = '';

    /**
     * Change table name of model
     **/
    public function table(string $table_name)
    {
        $this->table_name = $table_name;
        return $this;
    }

    /**
     * Create new instance of model class
     **/
    public static function query(): Model
    {
        $class = get_called_class();
        return new $class();
    }

    public function clone(): Model
    {
        return clone $this;
    }

    public function get_string(): string
    {
        //if select_sql is empty
        if (empty($this->select_sql))
            $this->select_sql = '*';

        //if table_sql is empty
        if (empty($this->table_sql))
            $this->table_sql = "$this->table_name";

        $sql = "SELECT $this->distinct_sql $this->select_sql FROM $this->table_sql $this->where_sql $this->group_sql $this->order_sql $this->limit_sql;";
        return $sql;
    }

    public function get(): array
    {
        $sql = $this->get_string();

        $result = DB::query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find($id)
    {
        $this->where($this->table_name . '.' . $this->primary_key, $id);
        return $this;
    }

    public function select(...$columns): Model
    {
        $index = 0;
        foreach ($columns as $column) {
            if ($index == 0 && empty($this->select_sql))
                $this->select_sql .= "$column";
            else
                $this->select_sql .= ", $column";
        }
        return $this;
    }

    public function distinct()
    {
        $this->distinct_sql = "DISTINCT";
        return $this;
    }

    public function join(string $table_name, $first_column, $second_column, $type = 'JOIN'): Model
    {
        //if table_sql is empty
        if (empty($this->table_sql))
            $this->table_sql = "$this->table_name";

        //join with other table
        $this->table_sql .= " $type $table_name ON $first_column = $second_column";
        return $this;
    }

    public function leftJoin(string $table_name, $first_column, $second_column)
    {
        return $this->join($table_name, $first_column, $second_column, 'LEFT JOIN');
    }

    public function rightJoin(string $table_name, $first_column, $second_column)
    {
        return $this->join($table_name, $first_column, $second_column, 'RIGHT JOIN');
    }

    public function whereRaw($column, $value, $operator = '=', $blockStart = false, $blockEnd = false): Model
    {
        $blockStartString = '';
        if ($blockStart == true)
            $blockStartString = ' (';
        $blockEndString = '';
        if ($blockEnd == true)
            $blockEndString = ')';
        
        //if where_sql is empty
        if (empty($this->where_sql))
            $this->where_sql = "WHERE$blockStartString $column $operator $value$blockEndString";
        else
            $this->where_sql .= " AND$blockStartString $column $operator $value$blockEndString";
        return $this;
    }

    public function where($column, $value, $operator = '=', $blockStart = false, $blockEnd = false): Model
    {
        return $this->whereRaw($column, "'$value'", $operator, $blockStart, $blockEnd);
    }

    public function orWhereRaw($column, $value, $operator = '=', $blockStart = false, $blockEnd = false): Model
    {
        $blockStartString = '';
        if ($blockStart == true)
            $blockStartString = ' (';
        $blockEndString = '';
        if ($blockEnd == true)
            $blockEndString = ')';
        
        //if where_sql is empty
        if (empty($this->where_sql))
            $this->where_sql = "WHERE$blockStartString $column $operator $value$blockEndString";
        else
            $this->where_sql .= " OR$blockStartString $column $operator $value$blockEndString";
        return $this;
    }

    public function orWhere($column, $value, $operator = '=', $blockStart = false, $blockEnd = false): Model
    {
        return $this->orWhereRaw($column, "'$value'", $operator, $blockStart, $blockEnd);
    }

    public function whereIn($column, array $values) {
        $index = 0;
        $in = '(';
        foreach ($values as $value) {
            if ($index < count($values) - 1)
                $in .= "'$value', ";
            else $in .= "'$value'";
            $index++;
        }
        $in .= ')';
        $this->whereRaw($column, $in, 'IN');
        return $this;
    }

    public function orWhereIn($column, $values) {
        $index = 0;
        $in = '(';
        foreach ($values as $value) {
            if ($index < count($values) - 1)
                $in .= "'$value', ";
            else $in .= "'$value'";
            $index++;
        }
        $in .= ')';
        $this->orWhereRaw($column, $in, 'IN');
        return $this;
    }

    public function groupBy($column)
    {
        //if order_sql is empty
        if (empty($this->order_sql))
            $this->group_sql = "GROUP BY $column";
        else
            $this->group_sql .= ", $column";
        return $this;
    }

    public function orderBy($column, $type = 'ASC')
    {
        //if order_sql is empty
        if (empty($this->order_sql))
            $this->order_sql = "ORDER BY $column $type";
        else
            $this->order_sql .= ", $column $type";
        return $this;
    }

    public function orderByDesc($column)
    {
        //if order_sql is empty
        return $this->orderBy($column, 'DESC');
    }

    public function limit(int $row_count, int $offset = 0)
    {
        $this->limit_sql = "LIMIT $offset, $row_count";
        return $this;
    }

    public function first(): array|null
    {
        $result = $this->limit(1)->get();
        if ($result)
            return $result[0];
        else
            return null;
    }

    public function count(): int
    {
        $this->select_sql = 'COUNT(*) as num';
        return $this->get()[0]['num'];
    }

    public function paginate($page = 1, $per_page = 10)
    {
        $count = $this->clone()->count();
        $data = $this->limit($per_page, ($page - 1) * $per_page)->get();
        return ['data' => $data, 'page' => $page, 'per_page' => $per_page, 'total' => ceil($count / $per_page)];
    }

    public function insert(array $input): int
    {
        //get keys and values
        $array_keys = array_keys($input);
        $array_values = array_values($input);
        //format keys and values
        $index = 0;
        foreach ($array_keys as $key) {
            $array_keys[$index] = "$key";
            $index++;
        }
        $index = 0;
        foreach ($array_values as $key) {
            $array_values[$index] = "'$key'";
            $index++;
        }

        //Array to string
        $keys = implode(', ', $array_keys);
        $values = implode(', ', $array_values);

        //insert to database
        $sql = "INSERT INTO $this->table_name ($keys) VALUES ($values);";

        $connection = DB::execute($sql);
        return $connection->insert_id;
    }

    public function update(array $input)
    {
        $array_values = [];

        //format array
        foreach ($input as $key => $value) {
            array_push($array_values, "$key = '$value'");
        }

        //array to string
        $values = implode(', ', $array_values);

        //update to database
        $sql = "UPDATE $this->table_name SET $values $this->where_sql;";

        DB::execute($sql);
    }

    public function delete(): bool
    {
        $sql = "DELETE FROM $this->table_name $this->where_sql;";

        $result = DB::execute($sql);
        if ($result->affected_rows > 0)
            return true;
        else
            return false;
    }
}
