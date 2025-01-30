<?php
include_once 'DBConnection.php';

class DBNews
{
    private $connection;

    function __construct()
    {
        $conn = new DBConnection;
        $this->connection = $conn;
    }

    function insertNews($news)
    {
        $conn = $this->connection->startConn();

        $id = $news->getId();
        $description = $news->getDescription();
        $category_id = $news->getCategory_id();
        $image = $news->getImage();

        $sql = "INSERT INTO news (id,description,category_id,image) VALUES
        ('$id','$description','$category_id','$image')";
        if (mysqli_query($conn, $sql)) {
        } else {
            echo 'This is an Error' . mysqli_error($conn);
        }


    }
    function getAllNews()
    {
        $conn = $this->connection->startConn();

        $sql = "SELECT * FROM news";

        $news = [];

        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $news[] = new NewsEntity(
                    $row['id'],
                    $row['name'],
                    $row['description'],
                    $row['category_id'],
                    $row['image']
                );
            }
        } else {
            return null;
        }
        return $news;
    }
    function getNewsById($id)
    {
        $conn = $this->connection->startConn();

        $sql = "SELECT * FROM news WHERE id = '$id'";

        if ($statement = $conn->query($sql)) {
            $result = $statement->fetch_row();
            return $result;
        } else {
            return null;
        }
    }

    function getNewsByCategoryAndName($category_id, $name)
    {
        $conn = $this->connection->startConn();

        $sql = "SELECT * FROM news WHERE category_id = '$category_id' and name = '$name'";

        if ($statement = $conn->query($sql)) {
            $result = $statement->fetch_assoc();
            return $result;
        } else {
            return null;
        }
    }

    function getNewsByCategoryAndId($category_id, $id)
    {
        $conn = $this->connection->startConn();

        $sql = "SELECT * FROM news WHERE category_id = '$category_id' or id ='$id'";

        if ($statement = $conn->query($sql)) {
            $result = $statement->fetch_assoc();
            return $result;
        } else {
            return null;
        }
    }
}

?>      