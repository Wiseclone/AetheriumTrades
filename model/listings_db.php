<?php 
    function getDefaultListingQuery() {
        return 'SELECT * 
            FROM quotes
            ORDER BY postdate DESC';
    }

    // Cards people want to trade FOR
    function get_for_listings() {
        global $db;
        $query = "SELECT * 
            FROM listings 
            WHERE type = 'for'
            ORDER BY postdate DESC";
        $statement = $db->prepare($query);
        $statement->execute();
        $listings = $statement->fetchAll();
        $statement->closeCursor();
        return $listings;
    }

    // Cards people have that they want TO trade
    function get_to_listings() {
        global $db;
        $query = "SELECT * 
            FROM listings 
            WHERE type = 'to'
            ORDER BY postdate DESC";
        $statement = $db->prepare($query);
        $statement->execute();
        $listings = $statement->fetchAll();
        $statement->closeCursor();
        return $listings;
    }
    // Listings from the same user
    function get_user_listings($user) {
        global $db;
        $query = 'SELECT * 
            FROM listings 
            WHERE user = :user
            ORDER BY postdate DESC';
        $statement = $db->prepare($query);
        $statement->bindValue(':user', $user);
        $statement->execute();
        $listings = $statement->fetchAll();
        $statement->closeCursor();
        return $listings;
    }
    // Listings of the same card
    function get_card_listings($card) {
        global $db;
        $query = 'SELECT * 
            FROM listings 
            WHERE card = :card
            ORDER BY postdate DESC';
        $statement = $db->prepare($query);
        $statement->bindValue(':card', $card);
        $statement->execute();
        $listings = $statement->fetchAll();
        $statement->closeCursor();
        return $listings;
    }
    // All listings on file
    function get_all_listings() {
        global $db;
        $query = getDefaultListingQuery();
        $statement = $db->prepare($query);
        $statement->execute();
        $listings = $statement->fetchAll();
        $statement->closeCursor();
        return $listings;
    }

    // A specific listing
    function get_listing($id) {
        global $db;
        $query = 'SELECT * FROM listings WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $listing = $statement->fetch();
        $statement->closeCursor();
        return $listing;
    }

    // Increment a post's view count
    function increment_view($id) {
        global $db;
        $query = 'UPDATE listings
            SET viewcount += 1
            WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();
    }

    // Remove a listing
    function delete_listing($id) {
        global $db;
        $query = 'DELETE FROM listings WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $statement->closeCursor();
    }

    // Post a listing
    function add_listing($card, $foil, $type, $poster, $description) {
        global $db;
        $query = 'INSERT INTO listings (card, foil, type, poster, description, postdate)
              VALUES
                 (:card, :foil, :type, :poster, :description, CURDATE())';
        $statement = $db->prepare($query);
        // ID of the card in question (Each version of a card has a unique ID)
        $statement->bindValue(':card', $card);
        // Is it foil? (true/false)
        $statement->bindValue(':foil', $foil);
        // Type of listing (for/to)
        $statement->bindValue(':type', $type);
        // User ID of the person who posted the listing
        $statement->bindValue(':poster', $poster);
        // Any extra info provided by the poster
        $statement->bindValue(':description', $description);
        $statement->execute();
        $statement->closeCursor();
    }
?>