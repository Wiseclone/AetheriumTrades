<?php
    session_start();
    //require_once('util/secure_conn.php');
    require_once('../util/valid_admin.php');
    require('../model/model.php');

    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == NULL) {
            $action = 'list_quotes';
        }
    }

    switch($action) {
        case 'list_quotes':
            $author_id = filter_input(INPUT_GET, 'author_id', FILTER_VALIDATE_INT);
            $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);

            if ($author_id != NULL && $author_id != FALSE && $category_id != NULL && $category_id != FALSE) {
                $quotes = get_quotes_by_both($author_id, $category_id);

            } else if ($author_id != NULL && $author_id != FALSE) {
                $quotes = get_quotes_by_author($author_id);

            } else if ($category_id != NULL && $category_id != FALSE) {
                $quotes = get_quotes_by_category($category_id);

            } else {
                $quotes = get_all_quotes();
            }
            // use in drop menus 
            $authors = get_all_authors();
            $categories = get_all_categories();
            include('../lists/quote_list_admin.php');
            include('../view/footer.php');
        break;

        case 'list_authors':
            $authors = get_all_authors();
            include('../lists/author_list.php');
            include('../view/footer.php');
        break;

        case 'list_categories':
            $categories = get_all_categories();
            include('../lists/category_list.php');
            include('../view/footer.php');
        break;

        case 'list_suggestions':
            $suggestions = get_all_suggestions();
            include('../lists/suggestion_list.php');
            include('../view/footer.php');
        break;

        case 'delete_quote':
            $quote_id = filter_input(INPUT_POST, 'quote_id', FILTER_VALIDATE_INT);
            if ($quote_id == NULL || $quote_id == FALSE) {
                $error = "Missing or incorrect quote id.";
                include('../errors/error.php');

            } else {
                delete_quote($quote_id);
                header("Location: admin.php");
            }
        break;

        case 'delete_author':
            $author_id = filter_input(INPUT_POST, 'author_id', FILTER_VALIDATE_INT);
            if ($author_id == NULL || $author_id == FALSE) {
                $error = "Missing or incorrect author id.";
                include('../errors/error.php');

            } else {
                delete_author($author_id);
                header("Location: admin.php?action=list_authors");
            }
        break;

        case 'delete_category':
            $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
            if ($category_id == NULL || $category_id == FALSE) {
                $error = "Missing or incorrect category id.";
                include('../errors/error.php');

            } else {
                delete_category($category_id);
                header("Location: admin.php?action=list_categories");
            }
        break;

        case 'approve_suggestion':
            $suggestion_id = filter_input(INPUT_POST, 'suggestion_id', FILTER_VALIDATE_INT);
            if ($suggestion_id == NULL || $suggestion_id == FALSE) {
                $error = "Missing or incorrect suggestion id.";
                include('../errors/error.php');

            } else {
                approveSuggestion($suggestion_id);
                header("Location: admin.php");
            }
        break;

        case 'delete_suggestion':
            $suggestion_id = filter_input(INPUT_POST, 'suggestion_id', FILTER_VALIDATE_INT);
            if ($suggestion_id == NULL || $suggestion_id == FALSE) {
                $error = "Missing or incorrect suggestion id.";
                include('../errors/error.php');

            } else {
                delete_suggestion($suggestion_id);
                header("Location: admin.php");
            }
        break;

        case 'show_add_form':
            $categories = get_all_categories();
            $authors = get_all_authors();
            include('../forms/add_quote_form.php');
            include('../view/footer.php');
        break;

        case 'add_quote':
            $text = filter_input(INPUT_POST, 'text');
            $author = filter_input(INPUT_POST, 'author');
            $category = filter_input(INPUT_POST, 'category');
            if ($text == NULL || $text == FALSE || $author == NULL || $author == FALSE || $category == NULL || $category == FALSE) {
                $error = "Invalid quote data. Check all fields and try again.";
                include('../errors/error.php');

            } else {
                addEachMissing(array("text"=>$text, "author"=>$author, "category"=>$category));
                header("Location: admin.php");
            }
        break;

        case 'add_author':
            $author_name = filter_input(INPUT_POST, 'author_name');
            add_author($author_name);
            header("Location: admin.php?action=list_authors");
        break;

        case 'add_category':
            $category_name = filter_input(INPUT_POST, 'category_name');
            add_category($category_name);
            header("Location: admin.php?action=list_categories");
        break;

        case 'logout':
            $_SESSION = array();    //Clear all session data from memory
            session_destroy();      //Clean up the session ID
            header("Location: login.php");
    }
?> 

   