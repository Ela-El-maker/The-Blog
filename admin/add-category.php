<?php
include 'partials/header.php';

//get back form data if invalid
$title = $_SESSION['add-category-data']['title'] ?? null;
$description = $_SESSION['add-category-data']['description'] ?? null;

unset($_SESSION['add-category-data']);

?>

    <section class="form__section">
        <div class="container form__section-container">
            <h2>Add Category</h2>
            <?php if(isset($_SESSION['add-category'])) : ?>
            <div class="alert__message error">
                <p>
                    <?php echo $_SESSION['add-category'];
                    unset($_SESSION['add-category']) ?>
                </p>
            </div>
            <?php endif ?>
            <form action="<?php echo ROOT_URL ?>admin/add-category-logic.php" method="POST">
                <input type="text" value="<?php echo $title ?>" name="title" placeholder="Title" id="">
                <textarea name="description" value="<?php echo $description ?>" id="" cols="30" rows="4" placeholder="Description"></textarea>
                <button type="submit" name="submit" class="btn">Add Category</button>
            </form>
        </div>
    </section>

 <?php
 include '../partials/footer.php';
 ?>