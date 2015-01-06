<?php
namespace projectx\core\vendor\orm;
use projectx\core\database;
/**
 * Description of db
 *
 * @author bart
 */
class db {

    private $db;

    public function __construct() 
    {
        $this->db = new database;
    }

    public function insert($table, $data) {
        $bind = ':' . implode(',:', array_keys($data));

        $sql = 'INSERT INTO ' . $table . '(' . implode(',', array_keys($data)) . ') ' . 'VALUES (' . $bind . ')';

        $stmt = $this->db->prepare($sql);

        $stmt->execute(array_combine(explode(',', $bind), array_values($data)));      
    }

    public function update($table, $data, $idname, $where) {

        $updates = array_filter($data, function ($value) 
        {
            return null !== $value;
        });

        $query = 'UPDATE ' . $table . ' SET';
        $values = array();

        foreach ($updates as $name => $value) 
        {
            $query .= ' ' . $name . ' = :' . $name . ','; // the :$name part is the placeholder, e.g. :zip
            $values[':' . $name] = $value; // save the placeholder
        }

        $query = rtrim($query, ',');
        $query.= ' WHERE '.$idname.' = ';
        $query.= is_int($where);
        $query.=';';

        $stmt = $this->db->prepare($query);

        $stmt->execute($values); // bind placeholder array to the query and execute everything
    }
    
    public function delete($table, $what, $id)
    {
        $stmt = $this->db->prepare("DELETE FROM $table WHERE $what = ?");
        $stmt->execute(array($id));
    }
    
    public function query($query)
    {
        //$sql = "SELECT * FROM $table"; 
        
        $result = $this->db->query($query);
        
        return $result;
        
    }
    
    public function escape($input)
    {
        $input = $this->db->quote($input);
        return $input;
    }
}