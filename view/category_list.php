<?php include("header.php") ?>

<header class="list__row list__header">
    <h1>
        Category List
    </h1>
</header>

<?php if ($categories) { ?>
    <section id="list" class="list">
        <div class="scrollable">
            <table class="item_row_container">
                <thead>
                    <tr class="list_item list_item_heading">
                        <th>Category Name</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody class="list_item">
                    <?php foreach ($categories as $category) : ?>
                        <tr>
                            <td><?= $category["categoryName"] ?></td>
                            <td class="list__removeItem">
                                <form action="." method="POST">
                                    <input type="hidden" name="action" value="delete_category">
                                    <input type="hidden" name="category_id" value="<?= $category["categoryID"] ?>">
                                    <button class="remove-button">❌</button>
                                </form>
                            </td>
                        <tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </section>
<?php } else { ?>
    <p class="no-items no-categories">No categories exist yet.</p>
<?php } ?>

<section id="add" class="add">
    <h2>Add Category</h2>
    <form action="." method="post" id="add__form" class="add_form">
        <input type="hidden" name="action" value="add_category">
        <div class="add__inputs">
            <input type="text" name="category_name" maxlength="50" placeholder="Name" autofocus required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>

<br>

<p class="navigation"><a href=".">View & Add To-Do Items</a></p>

<?php include("footer.php") ?>