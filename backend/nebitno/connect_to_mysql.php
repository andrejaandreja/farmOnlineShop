<?php
class Database{
private $hostname="localhost";
private $username = "farma";
private $password="farmafarma";
private $dbname;
private $dblink;
private $result;
private $records;
private $affected;

function __construct($dbname){
	$this->dbname=$dbname;
	$this->Connect();
	
}
function Connect(){
	$this->dblink=new mysqli($this->hostname,$this->username,$this->password,$this->dbname);
	if($this->dblink->connect_errno){
		printf("Konekcija neuspesna",$mysqli->connect_error);
	}
	$this->dblink->set_charset("utf8");
}
public function getResult(){ 
	return $this->result;
}
function ExecuteQuery($query){
	if($this->result=$this->dblink->query($query)) 
		$this->records=$this->result->num_rows;
		$this->affected=$this->dblink->affected_rows;
}
function select($table="admin", $rows='*',$where=null, $order=null){
	$q='SELECT '.$rows.' FROM '.$table.$where;
	$this->ExecuteQuery($q);
}

}
?>
