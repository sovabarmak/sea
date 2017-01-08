<?php
    header('Content-Type: text/html; charset=UTF-8');    
    session_start();
	
    if(isset($_POST["fn"])) {        
        switch ($_POST["fn"]) {
        case "get":            
            echo get_mychange();
            break;
        case "add":            
            add_mychange($_POST["id"], $_POST["name"], $_POST["url"]);
            echo get_mychange();
            break;
        case "del":
            del_mychange($_POST["id"]);
            echo get_mychange();
            break;
        }
    }
    
    function get_mychange(){
        $json = "";
        if(isset($_SESSION['item'])) {            
            foreach ($_SESSION['item'] as $k=>$item) {                                
                if($json != "") {
                    $json .= ",";
                }
                $json .= '{"id":'.$k.',"name":"'.$item["name"].'","url":"'.$item["url"].'"}';
            }
        }                
        if($json != "") {
            $json = '{"mychange":['.$json.']}';
        }
        return $json;
    }    
    function add_mychange($id, $name, $url) {                
        if(!isset($_SESSION['item'])) {
            $_SESSION['item'] = array();
        }        
        if(!isset($_SESSION['item'][$id])) {             
            $_SESSION['item'][$id] = array();            
            $_SESSION['item'][$id]["name"] = $name;
            $_SESSION['item'][$id]["url"] = $url;
        }        
    }
    function del_mychange($id) {            
        if(isset($_SESSION['item'][$id])) {             
            unset($_SESSION['item'][$id]);                        
        } 
    }
?>