<?php include '../view/header-admin.php'; ?>
<main>
    <nav>
        <form action="../admin/admin.php" method="get" id="author_selection">
            <section id="dropmenus">
                <?php if ( sizeof($authors) != 0) { ?>
                    
                    <label>Author:</label>
                    <select name="author_id">
                        <option value="0">View All Authors</option>
                        <?php foreach ($authors as $author) : ?>
                            <option value="<?php echo $author['id']; ?>">
                                <?php echo $author['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select> 
                <?php } ?>

                <?php if ( sizeof($categories) != 0) { ?>
                    <label>Category:</label>
                    <select name="category_id">
                        <option value="0">View All Categories</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category['id']; ?>">
                                <?php echo $category['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select> 
                <?php } ?>
                <input type="submit" value="Search" class="button blue button-slim">
            </section>
        </form>
    </nav>
    <section>
    <?php if( sizeof($quotes) != 0 ) { ?>
            <div id="table-overflow">
                <table>
                    <thead>
                        <tr>
                            <th>Quote</th>
                            <th>Author</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($quotes as $quote) : ?>
                        <tr>
                            <td><?php echo $quote['text']; ?></td>
                            <td><?php echo getNameFromId($authors,$quote['authorId']); ?></td>
                            <td><?php echo getNameFromId($categories,$quote['categoryId']); ?></td>
                            <td>
                                <form action="../admin/admin.php" method="post">
                                    <input type="hidden" name="action" value="delete_quote">
                                    <input type="hidden" name="quote_id"
                                        value="<?php echo $quote['id']; ?>">
                                    <input type="submit" value="Remove" class="button red">
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>  
        <?php } else { ?>
            <p>
                There are no matching quotes in our records. 
            </p>     
        <?php } ?>
    </section>
</main>
