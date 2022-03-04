<?php
    function get_items_by_category ($category_id) {
        global $db;
        if ($category_id) {
            $query = "SELECT T.ItemNum, T.Title, T.Description, C.CategoryName FROM todoitems T LEFT JOIN categories C ON T.categoryID = C.categoryID WHERE T.categoryID = :category_id ORDER BY ItemNum";
        } else {
            $query = "SELECT T.ItemNum, T.Title, T.Description, C.CategoryName FROM todoitems T LEFT JOIN categories C ON T.categoryID = C.categoryID ORDER BY ItemNum";
        }
        $statement = $db->prepare($query);
        if ($category_id) {
            $statement->bindValue(":category_id", $category_id);
        }
        $statement->execute();
        $items = $statement->fetchAll();
        $statement->closeCursor();
        return $items;
    }

    function delete_item ($itemNum) {
        global $db;
        $query = "DELETE FROM todoitems WHERE ItemNum = :itemNum";
        $statement = $db->prepare($query);
        $statement->bindValue(":itemNum", $itemNum);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_item ($category_id, $title, $description) {
        global $db;
        $query = "INSERT INTO todoitems (Title, Description, CategoryID) VALUES (:title, :description, :category_id)";
        $statement = $db->prepare($query);
        $statement->bindValue(":title", $title);
        $statement->bindValue(":description", $description);
        $statement->bindValue(":category_id", $category_id);
        $statement->execute();
        $statement->closeCursor();
    }