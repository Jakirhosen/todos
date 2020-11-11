<?php
use Todos\operation;
require_once ('../vendor/autoload.php');
$opt = new operation;
if(isset($_POST['action'])){
unset($_POST['action']);
$_POST['createdat'] = date('d-m-Y').' '.date("h:i:s a");
$_POST['updatedat'] = date('d-m-Y').' '.date("h:i:s a");
$opt->dataStore('todolist', $_POST);
$return = array('stats' => 'success');
echo json_encode($return);
}

if(isset($_POST['actiondelete'])){
  if($_POST['actiondelete'] == 'single'){
   $getID =  $opt->escapeData($_POST['id']);
   $opt->todoCustomdelete('todolist', "id = $getID");
   $return = array('stats' => 'success');
   echo json_encode($return);
  }
  if($_POST['actiondelete'] == 'all'){
   $opt->todoCustomdelete('todolist', "status = 0");
   $return = array('stats' => 'success');
   echo json_encode($return);
  }
}

if(isset($_POST['action-edit'])){
	$id = $_POST['id'];
	unset($_POST['id']);
	unset($_POST['action-edit']);
	$_POST['updatedat'] = date('d-m-Y').' '.date("h:i:s a");
	$opt->dataUpdate('todolist', $_POST, "id = $id");
	$return = array('stats' => 'success');
    echo json_encode($return);
}

if(isset($_POST['action-complete'])){
	$id = $_POST['id'];
	unset($_POST['id']);
	unset($_POST['action-complete']);
	$_POST['status'] = 0;
	$_POST['updatedat'] = date('d-m-Y').' '.date("h:i:s a");
	$opt->dataUpdate('todolist', $_POST, "id = $id");
	$return = array('stats' => 'success');
    echo json_encode($return);
}

?>