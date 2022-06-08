<?php

use GroceryCrud\Core\Model;

class UsuarioGrocerycrudModel extends Model {

    protected $ci;
    protected $db;

    function __construct($databaseConfig) {
        $this->setDatabaseConnection($databaseConfig);

        $this->ci = & get_instance();
        $this->db = $this->ci->db;
    }

    public function getList() {

        $order_by = $this->orderBy;
        $sorting = $this->sorting;

        // Your own custom query with a specific select!

        if ($order_by !== null) {
            $this->db->order_by($order_by. " " . $sorting);
        }

        if (!empty($this->_filters)) {
            foreach ($this->_filters as $filter_name => $filter_value) {
                $this->db->like($filter_name, $filter_value);
            }
        }

        if (!empty($this->_filters_or)) {
            foreach ($this->_filters_or as $filter_name => $filter_value) {
                $this->db->or_like($filter_name, $filter_value);
            }
        }

        $this->db->limit($this->limit, ($this->limit * ($this->page - 1)));
        $results = $this->db->get($this->tableName)->result_array();

        return $results;

    }

    public function insert($data, $tableName = null) {

        if ($tableName === null) {
            $tableName = $this->tableName;
        }

        $this->db->insert($tableName, $data);

        $returnObject = new StdClass;
        $returnObject->insertId = $this->db->insert_id();

        return $returnObject;
    }

    public function update($primaryKeyValue, $data) {
        if (empty($primaryKeyValue)) {
            throw new \Exception("The primaryKeyValue can't be empty or 0");
        }

        $primaryKeyField = $this->getPrimaryKeyField();

        $updateResult = $this->db->update($this->tableName, $data, [
            $primaryKeyField => $primaryKeyValue
        ]);

        return $updateResult;
    }
}