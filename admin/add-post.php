<?php
include 'partials/header.php';
?>

    <section class="form__section">
        <div class="container form__section-container">
            <h2>Add Post</h2>
            <div class="alert__message error">
                <p>This is a error message</p>
            </div>
            <form action="" enctype="multipart/form-data">
                <input type="text" name="" placeholder="Title" id="">
                <select name="" id="">
                    <option value="1">Travel</option>
                    <option value="1">Art</option>
                    <option value="1">Science</option>
                    <option value="1">Technology</option>
                    <option value="1">Food</option>
                </select>
                <textarea name="" id="" rows="10" placeholder="Body"></textarea>

                <div class="form__control inline">
                    <input type="checkbox" id="is_featured" checked>
                    <label for="is_featured" >Featured</label>
                </div>
                <div class="form__control">
                    <label for="thumbnail">Add Thumbnail</label>
                    <input type="file" name="" id="thumbnail">
                </div>
                <button type="submit" class="btn">Add Post</button>
            </form>
        </div>
    </section>

 <?php
 include '../partials/footer.php';
 ?>