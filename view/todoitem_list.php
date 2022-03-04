<?php include("header.php") ?>

<section id="list" class="list">
    <header class="list__row list__header">
        <h1>To-Do Items</h1>
        <form action="." method="get" id="list_header_select" class="list__header_select">
            <input type="hidden" name="action" value="list_todoitems">
            <label id="category-label">Category:</label>
            <select name="category_id" required>
                <option value="0">View All</option>
                <?php foreach ($categories as $category) : ?>
                    <?php $selected = $category["categoryID"] ?>
                    <?php if ($category_id == $category["categoryID"]) { ?>
                        <option value="<?= $category["categoryID"]?>" selected>
                    <?php } else { ?>
                        <option value="<?= $category["categoryID"] ?>">
                    <?php } ?>
                    <?= $category["categoryName"] ?>
                    </option>
                    <?php endforeach ?>
            </select>
            <button class="add-button bold">GO</button>
        </form>
    </header>
    <?php if ($todoitems) { ?>
        <div class="scrollable">
            <table class="item_row_container">
                <thead>
                    <tr class="list_item list_item_heading">
                        <th>Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody class="list_items">
                    <?php foreach ($todoitems as $todoitem) : ?>
                        <tr class="list_item">
                            <td><?= $todoitem["Title"] ?></td>
                            <td><?= $todoitem["Description"] ?></td>
                            <td><?= $todoitem["CategoryName"] ?></td>
                            <td class="list__removeItem">
                                <form action="." method="POST">
                                    <input type="hidden" name="action" value="delete_todoitem">
                                    <input type="hidden" name="todoitem_id" value="<?= $todoitem["ItemNum"] ?>">
                                    <button class="remove-button">❌</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <br>
        <?php if ($category_id) { ?>
            <p class="no-items">No to-do items exist for this category.</p>
        <?php } else { ?>
            <p class="no-items">No to-do items yet.</p>
        <?php } ?>
        <br>
    <?php } ?>
</section>

<section id="add" class="add">
    <h2>Add To-Do Item</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_todoitem">
        <div class="add_inputs">
                <select name="category_id" required>
                    <option value="">Select Category</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category["categoryID"] ?>">
                            <?= $category["categoryName"] ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <input type="text" name="title" maxlength="20" placeholder="Title" required>

                <input type="text" name="description" maxlength="50" placeholder="Description" required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>

<p class="navigation"><a href="./?action=list_categories">View/Edit Categories</a></p>


<?php include("footer.php") ?>