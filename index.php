<?php
    require("model/database.php");
    require("model/todoitem_db.php");
    require("model/category_db.php");

    $todoitem_id = filter_input(INPUT_POST, "todoitem_id", FILTER_VALIDATE_INT);
    $title = filter_input(INPUT_POST, "title", FILTER_UNSAFE_RAW);
    $description = filter_input(INPUT_POST, "description", FILTER_UNSAFE_RAW);
    $category_name = filter_input(INPUT_POST, "category_name", FILTER_UNSAFE_RAW);

    $category_id = filter_input(INPUT_POST, "category_id", FILTER_VALIDATE_INT);
    if (!$category_id) {
        $category_id = filter_input(INPUT_GET, "category_id", FILTER_VALIDATE_INT);
    }

    $action = filter_input(INPUT_POST, "action", FILTER_UNSAFE_RAW);
    if (!$action) {
        $action = filter_input(INPUT_GET, "action", FILTER_UNSAFE_RAW);
        if(!$action) {
            $action = "list_todoitems";
        }
    }

    switch ($action) {
        case "list_categories":
            $categories = get_categories();
            include("view/category_list.php");
            break;

        case "add_category":
            add_category($category_name);
            header("Location: .?action=list_categories");
            break;

        case "add_todoitem":
            if ($category_id && $title && $description) {
                add_item($category_id, $title, $description);
                header("Location: .?category_id=$category_id");
            } else {
                $error = "Invalid to-do item data. Check all fields and try again.";
                include("view/error.php");
                exit();
            }
            break;
        
        case "delete_category":
            if ($category_id)
            try {
                delete_category($category_id);
            } catch (PDOException $e) {
                $error = "You cannot delete a category if to-do items exist in the category.";
                include("view/error.php");
                exit();
            }
            header("Location: .?action=list_categories");
            break;

        case "delete_todoitem":
            if ($todoitem_id) {
                delete_item($todoitem_id);
                header("Location: .?category_id=$category_id");
            } else {
                $error = "Missing or incorrect to-do item id.";
                include("view/error.php");
            }
            break;

        default:
            $category_name = get_category_name($category_id);
            $categories = get_categories();
            $todoitems = get_items_by_category($category_id);
            include("view/todoitem_list.php");
    }