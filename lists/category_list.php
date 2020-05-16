<?php include '../view/header-admin.php'; ?>
<main>
    <h2>Category List</h2>
    <section>
        <?php if ( sizeof($categories) != 0) { ?>
            <table>
                <tr>
                    <th colspan="2">Name</th>
                </tr>        
                <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?php echo $category['name']; ?></td>
                    <td>
                        <form action="../admin/admin.php" method="post">
                            <input type="hidden" name="action" value="delete_category">
                            <input type="hidden" name="id"
                                value="<?php echo $category['id']; ?>"/>
                            <input type="submit" value="Remove" class="button red" />
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>    
            </table>
        <?php } else { ?>
            <p>
                There are no categories in your database.
            </p>
        <?php } ?>
    </section>
    <section>
        <h2>Add Author</h2>
        <form action="../admin/admin.php" method="post" id="add_category_form">
            <input type="hidden" name="action" value="add_category">

            <label>Name:</label>
            <input type="text" name="category_name" max="20" required><br>

            <label id="blankLabel">&nbsp;</label>
            <input id="add_category_button" type="submit" class="button blue" value="Add Author"><br>
        </form>
    </section>
</main>
