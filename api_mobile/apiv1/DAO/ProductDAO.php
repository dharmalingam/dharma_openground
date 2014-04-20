<?php

require_once "BaseDAO.php";

class ProductDAO {

    public function getProducts($index, $quantity, $userid) {
        //open DB        
        $database = new Database();

        
 
        // Query
        $database->query("SELECT * FROM   product WHERE productid NOT IN 
                          (SELECT productid FROM user_product_action
                           WHERE  userid = :userid) 
                           ORDER BY productid DESC 
                           LIMIT :index, :quantity ");

        // Bind data
        $database->bind(':index', (int) $index);
        $database->bind(':quantity', (int) $quantity);
        $database->bind(':userid', (int) $userid);
        
        //Execute Query	
        $result = $database->resultset();

        return $result;
    }

    public function getProductDetails($productid, $userid) {
        //open DB        
        $database = new Database();

        // Query for product details
        $database->query("SELECT * FROM product WHERE productid = :productid ");

        // Bind data
        $database->bind(':productid', (int) $productid);

        //Execute Query	
        $resultdetails = $database->resultset();


        // Query for product size
        $database->query("SELECT * FROM productsize WHERE productid = :productid ");

        // Bind data
        $database->bind(':productid', (int) $productid);

        //Execute Query	
        $resultsize = $database->resultset();


        // Query for product color
        $database->query("SELECT * FROM productcolor WHERE productid = :productid ");

        // Bind data
        $database->bind(':productid', (int) $productid);

        //Execute Query	
        $resultcolor = $database->resultset();
        
        
        $database1 = new Database();

        // Query for is favorite
        $database1->query("SELECT favdate FROM userfavorite WHERE productid = :productid AND userid = :userid ");

        // Bind data
        $database1->bind(':productid', (int) $productid);
        $database1->bind(':userid', (int) $userid);

        //Execute Query	
        $resultfavorite = $database1->resultset();

        $retData = array(
            "productdetails" => $resultdetails,
            "productsize" => $resultsize,
            "productcolor" => $resultcolor,
            "isfav" => $resultfavorite            
        );

        return $retData;
    }

}

?>
