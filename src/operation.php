<?php  

/**
 * 
 */
namespace Todos;

class operation 
{
  private $host = 'localhost';
  private $dbUser = ''; //enter your database username here
  private $dbPass = ''; //enter your database password here
  private $dbName = ''; //enter your database name here
  private $dbCon;
  
	function __construct()
	{
		$this->dbCon = mysqli_connect($this->host, $this->dbUser, $this->dbPass, $this->dbName);
		if(mysqli_connect_errno($this->dbCon)){
		 die("Database configuration needed! Read carefully readme.md or readme.html file.");
		}
	}
	public function dataStore($table, array $data){
     $getColumn = array_keys($data);
     $getValue = $this->escapeData(array_values($data));
     $getFinalColumn = implode(',', $getColumn);
     $getFinalValue = "'".rtrim(implode("','", $getValue), ',')."'";
     $insertData = mysqli_query($this->dbCon, "INSERT INTO $table ($getFinalColumn) VALUES ($getFinalValue)");
	}

  public function dataUpdate($table, array $data, $where){
     $first = true;
     $appender = '';
     foreach ($data as $columName => $value):
      if($first):
       $first = false;
      else:
       $appender .=', ';
      endif;
     $appender .= $columName." = '".$this->escapeData($value)."'"; 
     endforeach;
     $updateData = mysqli_query($this->dbCon, "UPDATE $table SET $appender WHERE $where");
  }


	public function escapeData($data){
	  if(is_array($data)){
	   $temp = array();
	    foreach ($data as $value) {
	     array_push($temp, mysqli_real_escape_string($this->dbCon, $value));
	    }  
        return $temp;
	  }else{
	  	$dataChecked = mysqli_real_escape_string($this->dbCon, $data);
	  	return $dataChecked;
	  }

	}
	public function todoDisplay($table, $condition='', $order='ASC'){
        if(strtolower($condition) == 'all'){
          $condition = '';
        }else if(strtolower($condition) == 'active'){
          $condition = 'WHERE status = 1';
        }else if(strtolower($condition) == 'completed'){
          $condition = 'WHERE status = 0';
        }
        $output = '';
        $sqlRetrive = mysqli_query($this->dbCon, "SELECT id, todolist, status FROM $table $condition ORDER BY id $order");
        if(mysqli_num_rows($sqlRetrive) > 0){
        	while ($row = mysqli_fetch_array($sqlRetrive)) {
        		$output .= "<div class='custom-row'>";
        		$output .= ($row[2] == 1 ? "<label class='custom-check-container' onclick='todoComplete(event, $(this))'>".$row[1]."<input type='checkbox' value='".$row[0]."' name='todoid'><span class='checkmark'></span></label><div class='row-hidden-btn'><a href='javascript:void(0)' class='text-success data-edit' data-id='".$row[0]."'><i class='fa fa-edit'></i></a> <a href='javascript:void(0)' class='text-danger data-delete' data-id='".$row[0]."' onclick='todoClear(event, $(this), \"single\")'><i class='fa fa-trash'></i></a></div>" : "<label class='custom-check-container completed-todos'>".$row[1]."<input type='checkbox' disabled checked><span class='checkmark'></span></label><div class='row-hidden-btn'> <a href='javascript:void(0)' class='text-danger data-delete' data-id='".$row[0]."' onclick='todoClear(event, $(this), \"single\")'><i class='fa fa-trash'></i></a></div>");
            $output .= "</div>";
        		
        	}
        }else{
        	$output .= '<span>Table is empty!</span>';
        }
        echo $output;
        
	}

  public function todoCustomdelete($table, $where){
    $sqlDelete = mysqli_query($this->dbCon, "DELETE FROM $table WHERE $where");
  }

	public function dataCount($table, $condition=''){
        $sqlCount = mysqli_query($this->dbCon, "SELECT COUNT(*) FROM $table $condition");
        $totaldata = mysqli_fetch_array($sqlCount);
        return $totaldata[0];
	}

  function __destruct() {
    if($this->dbCon){
      mysqli_close($this->dbCon);
    }
  }
}
?>
