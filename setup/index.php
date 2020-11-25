<?php
class createDB
{
    public function __construct()
    {
        //Change when in production
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "lamlam";
    }


    public function run(){
        try
        {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = NULL;

            // sql to create table
            $sql .= "CREATE TABLE category (
                        categoryID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        category_name VARCHAR(100) NOT NULL
                    );";

            $sql .= "
                    CREATE TABLE product (
                        productID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        `categoryID` INT(11) UNSIGNED NOT NULL,
                        FOREIGN KEY (`categoryID`) REFERENCES category (`categoryID`),
                        description MEDIUMTEXT NOT NULL,
                        price FLOAT NOT NULL, 
                        stockQTY INT(11) DEFAULT 0,
                        image VARCHAR(255) NULL
                    );
                    ";

            $sql .= "
            CREATE TABLE retailer(
                retailerID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                location VARCHAR(100) NOT NULL,
                tel_no INT(18) NOT NULL
            );
            ";

            $sql .= "
            CREATE TABLE user (
                userID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                retailerID INT(11) UNSIGNED,
                FOREIGN KEY (retailerID) REFERENCES retailer(retailerID),
                role VARCHAR(12) NOT NULL,
                userName VARCHAR(200) NOT NULL,
                userEmail VARCHAR(200) NOT NULL,
                phoneNo INT(18) NOT NULL,
                registeredDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                password VARCHAR(255) NOT NULL
            );
            ";

            $sql .= "
            CREATE TABLE loans (
            loanID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            productID INT(11) UNSIGNED NOT NULL,
            retailerID INT(11) UNSIGNED NOT NULL,
            FOREIGN KEY (productID) REFERENCES product(productID),
            FOREIGN KEY (retailerID) REFERENCES retailer(retailerID),
            qty INT(11) NOT NULL, 
            status VARCHAR(15) DEFAULT 'pending',
            date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            date_status TIMESTAMP NULL
            );
            ";

            $sql .= "
            CREATE TABLE scan_history(
                categoryID INT(11) UNSIGNED,
                productID INT(11) UNSIGNED,
                userID INT(11) UNSIGNED,
                FOREIGN KEY (categoryID) REFERENCES category(categoryID),
                FOREIGN KEY (productID) REFERENCES product(productID),
                FOREIGN KEY (userID) REFERENCES user(userID)
            );
            ";

            $conn->exec($sql);
            echo "Database created successfully";
        }

        catch
        (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

        $conn = null;
    }
}


//Main driver
$setup = new createDB();
$setup->run();
