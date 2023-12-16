<?php
require 'partials/header.php';


if (isset($_GET['search']) && isset($_GET['submit'])) {
    $search =filter_var($_GET['search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $query ="SELECT * FROM posts where title LIKE '%$search%' ORDER BY date_time DESC";
    $posts = mysqli_query($connection, $query);
}else{
    header('location: ' . ROOT_URL .'blog.php');
}
?>

<?php

if(mysqli_num_rows($posts) > 0) : ?>











<section class="posts" <?php echo $posts ? '' : 'section__extra-margin' ?>>
        <div class="container posts__container">
            <?php while($post = mysqli_fetch_assoc($posts)) : ?>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/<?php echo $post['thumbnail'] ?>" alt="">
                </div>
                <div class="post__info">

                <?php //fetch category from ctegories table using category_id of post
                $category_id = $featured['category_id'];
                $category_query = "SELECT * FROM categories  where id = $category_id";
                $category_result = mysqli_query($connection,$category_query);
                $category = mysqli_fetch_assoc($category_result);
                $category_title = $category['title'];
                ?>
                    <a href="<?php echo ROOT_URL ?>category-posts.php?id=<?php echo $post['category_id'] ?>" class="category__button"><?php echo $category['title'] ?></a>
                    <h3 class="post__title">
                        <a href="<?php echo ROOT_URL ?>post.php?id=<?php echo $post['id'] ?>"><?php echo $post['title'] ?></a>
                    </h3>
                    <p class="post__body">
                        <?php echo substr($post['body'],0,159)?>...    
                    </p>
                    <div class="post__author">
                    <?php
                    //fetch author from users table using author_id
                    $author_id = $post['author_id'];
                    $author_query ="SELECT * FROM users where id =$author_id";
                    $author_result = mysqli_query($connection,$author_query);
                    $author = mysqli_fetch_assoc($author_result);
                    ?>

                        <div class="post__author-avatar">
                            <img src="./images/<?php echo $author['avatar'] ?>">
                        </div>
                        <div class="post__author-info">
                            <h5>By: <?php echo "{$author['firstname']} {$author['lastname']}" ?></h5>
                            <small>
                            <?php echo date("M d, Y - H:i", strtotime($post['date_time'])) ?>
                            </small>
                        </div>
                    </div>
                </div>
            </article>
            <?php endwhile ?>
        </div>
    </section>
    <?php else : ?>
        <div class="alert__message error lg section__extra-margin">
            <p>No post found for this search</p>
        </div>
    <?php endif ?> 
    <!-----End of Posts---->

    
    <section class="category__buttons">
        <div class="container category__buttons-container">

        <?php 
        $all_categories_query = "SELECT * FROM categories";
        $all_categories = mysqli_query($connection,$all_categories_query);
        ?>
        <?php while($category = mysqli_fetch_assoc($all_categories))  : ?>
            <a href="" class="category__button"><?php echo $category['title'] ?></a>
            <?php endwhile ?>
        </div>
    </section>


    <!----===========End of Category buttons=======-->

<?php include 'partials/footer.php' ?>