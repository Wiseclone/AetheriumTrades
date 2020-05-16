<?php include '../view/header-admin.php'; ?>
<main>
    <section>
    <?php if( sizeof($suggestions) != 0 ) { ?>
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
                        <?php foreach ($suggestions as $suggestion) : ?>
                        <tr>
                            <td><?php echo $suggestion['text']; ?></td>
                            <td><?php echo $suggestion['author']; ?></td>
                            <td><?php echo $suggestion['category']; ?></td>
                            <td>
                                <form action="../admin/admin.php" method="post">
                                    <input type="hidden" name="action" value="approve_suggestion">
                                    <input type="hidden" name="suggestion_id"
                                        value="<?php echo $suggestion['id']; ?>">
                                    <input type="submit" value="Approve" class="button blue">
                                </form>
                            </td>
                            <td>
                                <form action="../admin/admin.php" method="post">
                                    <input type="hidden" name="action" value="delete_suggestion">
                                    <input type="hidden" name="suggestion_id"
                                        value="<?php echo $suggestion['id']; ?>">
                                    <input type="submit" value="Deny" class="button red">
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>  
        <?php } else { ?>
            <p>
                There are no matching suggestions in our records. 
            </p>     
        <?php } ?>
    </section>
</main>
