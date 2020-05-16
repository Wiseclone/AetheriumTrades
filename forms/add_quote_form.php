<?php include '../view/header-admin.php'; ?>
<main>
    <h2>Add Quote</h2>
    <form action="../admin/admin.php" method="post" id="add_quote_form">
        <input type="hidden" name="action" value="add_quote">

        <label>Text:</label>
        <textarea name="text" maxlength="256" rows="4" cols="64" required></textarea><br>

        <label>Author:</label>
        <input type="text" name="author" maxlength="40" required><br>

        <label>Category:</label>
        <input type="text" name="category" maxlength="40" required><br>

        <label id="blankLabel">&nbsp;</label>
        <input type="submit" value="Add Quote" class="button blue"><br>
    </form>
</main>