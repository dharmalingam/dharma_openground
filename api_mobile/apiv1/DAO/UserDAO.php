<?php

require_once "BaseDAO.php";

class UserDAO {

    public function createUser($fname, $lname, $email, $facebookaccesstoken, $dob, $location, $sex, $facebookid) {

        //open DB        
        $database = new Database();

        $database->beginTransaction();

        try {

            // Query
            $database->query("INSERT INTO user(fname, lname, email, facebookaccesstoken,dob, location, gender, facebookid, createdate, updatedate) 
                                      VALUES (:fname, :lname, :email, :facebookaccesstoken,:dob, :location, :sex, :facebookid, now(), now())");

            // Bind data
            $database->bind(':fname', $fname);
            $database->bind(':lname', $lname);
            $database->bind(':email', $email);
            $database->bind(':facebookaccesstoken', $facebookaccesstoken);
            $database->bind(':dob', $dob);
            $database->bind(':location', $location);
            $database->bind(':sex', $sex);
            $database->bind(':facebookid', $facebookid);

            //Execute Query	
            $result = $database->execute();

            if ($result == true) {
                //get last insert id
                $returnlastInsertId = $database->lastInsertId();

                //commit changes
                $database->endTransaction();

                //return last insert id
                return $returnlastInsertId;
            } else {
                $database->cancelTransaction();
                throw new Exception("Exception in createUser - " . "\n", null, null);
            }
        } catch (Exception $e) {

            $database->rollBack();
            throw new Exception("Exception in createUser - " . $e->getMessage() . " " . $e->getTraceAsString() . "\n", $e->getCode(), null);
        }
    }

    public function getUserById($userid) {
        //open DB        
        $database = new Database();

        // Query
        $database->query("SELECT * FROM user WHERE userid = :userid");

        // Bind data
        $database->bind(':userid', (int) $userid);

        //Execute Query	
        $result = $database->resultset();

        return $result;
    }

    public function getUserByFacebookId($facebookid) {
        //open DB        
        $database = new Database();

        // Query
        $database->query("SELECT * FROM user WHERE facebookid = :facebookid");

        // Bind data
        $database->bind(':facebookid', $facebookid);

        //Execute Query	
        $result = $database->resultset();

        return $result;
    }
}

?>
