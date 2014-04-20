<?php

require_once "RestServer.php";
require_once "DAO/UserDAO.php";
require_once "DAO/ProductDAO.php";
#require_once "DAO/CommentsDAO.php";
require_once "constants.php";

//error_reporting(E_ALL);
ini_set('display_errors', '1');

class Api {

    //http://domainname/apiv1/api.php?method=getProducts&index=0&userid=40
    public static function getProducts($index, $userid) {
        try {
            $productDAO = new ProductDAO();

            //Get Data
            $result = $productDAO->getProducts($index, CONST_QUANTITY, $userid);

            return array("response" => $result);
        } catch (Exception $e) {
            error_log("Exception in getProducts - " . $e->getMessage() . " " . $e->getTraceAsString() . "\n", 3, LOG_FILE);
            return array("displayerrror" => FAIL_ERROR_MESSAGE);
        }
    }
    
    //http://domainname/apiv1/api.php?method=getProductDetails&productid=1&userid=40
    public static function getProductDetails($productid, $userid) {
        try {
            $productDAO = new ProductDAO();

            //Get Data
            $result = $productDAO->getProductDetails($productid, $userid);

            return array("response" => $result);
            
        } catch (Exception $e) {
            error_log("Exception in getProductDetails - " . $e->getMessage() . " " . $e->getTraceAsString() . "\n", 3, LOG_FILE);
            return array("displayerrror" => FAIL_ERROR_MESSAGE);
        }
    }

    //http://domainname/apiv1/api.php?method=createUser&fname=testfname&lname=testlname&email=testemail&facebookaccesstoken=testtiocketn&dob=1970/10/30&location=testlocation&sex=M&facebookid=testdbid
    public static function createUser($fname, $lname, $email, $facebookaccesstoken, $dob, $location, $sex, $facebookid) {
        try {
            $userDAO = new UserDAO();

            //check if a user with this fb id already exists.
            $resultUser = $userDAO->getUserByFacebookId($facebookid);
            
            //if yes then dont create a new user, and return the curernt user in db
            if(!empty($resultUser))
            {
                return array("response" => $resultUser[0]);
            }
            
            //if fbid not found in DB then Create new User
            $result = $userDAO->createUser($fname, $lname, $email, $facebookaccesstoken, $dob, $location, $sex, $facebookid);

            //if user created successfully then return the user details
            if( ((int)$result) != 0 ) {
                 $resultUser = $userDAO->getUserById($result);
            } else {
                return array("displayerrror" => FAIL_ERROR_MESSAGE);
            }
            
            return array("response" => $resultUser[0]);
            
        } catch (Exception $e) {
            
            echo LOG_FILE;
            error_log("Exception in createUser - " . $e->getMessage() . " " . $e->getTraceAsString() . "\n", 3, LOG_FILE);
            return array("displayerrror" => FAIL_ERROR_MESSAGE);
        }
    }
     
}

$rest = new RestServer(Api);
$rest->handle();
?>
