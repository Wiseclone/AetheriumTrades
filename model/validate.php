<?php
    // Determine whether the card came from our database or Scryfall's
    function validate_card($id) {
        if(array_search($id, $cards) == false) { // Card came from Scryfall
            $name           = $card['name'];
            $thumbnail      = $card['thumbnail'];
            $art            = $card['art'];
            $price          = $card['price'];
            $pricefoil      = $card['pricefoil'];
            $tcgplayerlink  = $card['tcgplayerlink'];

            // Make a copy in our database
            add_card($id, $name, $thumbnail, $art, $price, $pricefoil, $tcgplayerlink);
        }
        // Card is in database, proceed with using it
        return true;
    }
    // Determine if there is a user in our database with a particular username
    function is_user($username) {
        $usernames = get_all_usernames();
        if(array_search($username, $usernames) == false) {
            return false;
        } else {
            return true;
        }
    }
?>