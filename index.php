<?php
    require('model/model.php');

    //Null Coalescing Operator
    $action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_vehicles';

    switch ($action) {
        default: //'list_quotes' 
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

            include('view/header.php');
            include('lists/quote_list.php');
            include('view/footer.php');
    }
?> 

   