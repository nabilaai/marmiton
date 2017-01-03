<?php
namespace Marmiton\Controller;

/**
 * Class ORM
 * @package Marmiton\Controller
 */
abstract class ORM {

//    public function __construct(\PDO $pdo) {
//        $this->_pdo = $pdo;
//    }

    /**
     * @param $obj
     * @param $table
     * @return object
     */
    public function selectAll($obj, $table) {
        $sth = $this->_pdo->prepare('SELECT * FROM ?');
        $sth->execute(array($table));

        $resultObj = $this->_createObjectFromQuery($sth, $obj);

        $sth->closeCursor();

        return $resultObj;
    }

    /**
     * @param $obj
     * @param $id
     * @param $table
     */
    public function findById($obj, $id, $table) {

    }

    /**
     * @param $obj
     * @param $table
     */
    public function insert($obj, $table) {

    }

    /**
     * @param $obj
     * @param $table
     */
    public function update($obj, $table) {

    }

    /**
     * @param $obj
     * @param $table
     */
    public function delete($obj, $table)
    {

    }

    /**
     * @param $sth
     * @param $obj
     * @return mixed
     */
    private function _createObjectFromQuery($sth, $obj)
    {
        $tabResult = [];

        while ($fetch = $sth->fetch()){
            $tabResult[] = $fetch;
        }

        foreach($tabResult as $key => $value) {
            $obj->$key = $value;
        }

        return $obj;
    }

}