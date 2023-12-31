<?php
 include 'partials/header.php';

 if(isset($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);

    //fetch category from database
    $query = " SELECT * FROM categories WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) == 1){
        $category = mysqli_fetch_assoc($result);
    }
 }else{
    header('location: ' . ROOT_URL . 'admin/manage-categories.php');
    die();
 }
 ?>
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Edit Category</h2>
            <form action="<?php echo ROOT_URL ?>admin/edit-category-logic.php"  method="POST" >
                <input type="hidden" value="<?php echo $category['id'] ?>" name="id" >
                <input type="text" value="<?php echo $category['title'] ?>" name="title" placeholder="Title" id="">
                <textarea name="description" id="" cols="30" rows="4" placeholder="Description"><?php echo $category['description'] ?></textarea>
                <button type="submit" name="submit" class="btn">Update Category</button>
            </form>
        </div>
    </section>
    
<?php
 include '../partials/footer.php';
 ?>