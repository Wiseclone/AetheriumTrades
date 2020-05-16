<?php 
    function getDefaultCardQuery() {
        return 'SELECT * 
        FROM cards';
    }

    function get_all_cards() {
        global $db;
        $query = getDefaultCardQuery();
        $statement = $db->prepare($query);
        $statement->execute();
        $cards = $statement->fetchAll();
        $statement->closeCursor();
        return $cards;
    }

    function get_card($card_id) {
        global $db;
        $query = 'SELECT * FROM cards WHERE id = :card_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':card_id', $card_id);
        $statement->execute();
        $card = $statement->fetch();
        $statement->closeCursor();
        return $card;
    }

    function delete_card($card_id) {
        global $db;
        $query = 'DELETE FROM cards WHERE id = :card_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':card_id', $card_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_card($id, $name, $thumbnail, $art, $price, $pricefoil, $tcgplayerlink) {
        global $db;
        $query = 'INSERT INTO cards (id, name, thumbnail, art, price, pricefoil, tcgplayerlink)
            VALUES
                (:id, :name, :thumbnail, :art, :price, :pricefoil, :tcgplayerlink)';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':thumbnail', $thumbnail);
        $statement->bindValue(':art', $art);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':pricefoil', $pricefoil);
        $statement->bindValue(':tcgplayerlink', $tcgplayerlink);
        $statement->execute();
        $statement->closeCursor();
    }
    function update_card_price($id, $price, $pricefoil) {
        global $db;
        $query = 'UPDATE cards
            SET price = :price, pricefoil = :pricefoil
            WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':pricefoil', $pricefoil);
        $statement->execute();
        $statement->closeCursor();
    }
?>