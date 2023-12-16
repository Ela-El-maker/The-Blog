<?php
include 'partials/header.php';


//fetch featured post from database
$featured_query = "SELECT * FROM posts where is_featured = 1";
$featured_result = mysqli_query($connection,$featured_query);
$featured = mysqli_fetch_assoc($featured_result);


?>
<?php if(mysqli_num_rows($featured_result) ==1 ) : ?>
    <section class="featured">
        <div class="container featured__container">
            <div class="post__thumbnail">
                <img src="./images/<?php echo $featured['thumbnail']?>" alt="">
            </div>
            <div class="post__info">

            <?php //fetch category from ctegories table using category_id of post
            $category_id = $featured['category_id'];
            $category_query = "SELECT * FROM categories  where id = $category_id";
            $category_result = mysqli_query($connection,$category_query);
            $category = mysqli_fetch_assoc($category_result);
            $category_title = $category['title'];
            ?>

            
                <a href="<?php echo ROOT_URL ?>category-posts.php?id=<?php echo $category['id']?>" class="category__button"><?php echo $category['title'] ?></a>
                <h2 class="post__title"><a href="<?php echo ROOT_URL ?>post.php?id=<?php echo $featured['id']?>"><?php echo $featured['title']?></a></h2>
                <p class="post__body">
                    <?php echo substr($featured['body'],0,300)?>...
                </p>
                <div class="post__author">
                    <?php
                    //fetch author from users table using author_id
                    $author_id = $featured['author_id'];
                    $author_query ="SELECT * FROM users where id =$author_id";
                    $author_result = mysqli_query($connection,$author_query);
                    $author = mysqli_fetch_assoc($author_result);
                    ?>
                    <div class="post__author-avatar">
                        <img src="./images/avatar2.jpg" alt="">
                    </div>
                    <div class="post__author-info">
                        <h5>
                            By : <?php echo "{$author['firstname']} {$author['lastname']}" ?>
                        </h5>
                        <small>
                            <?php echo date("M d, Y - H:i", strtotime($featured['date_time'])) ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif ?>

<!-----END OF FEATURED-------->
    <section class="posts">
        <div class="container posts__container">
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/blog2.jpg" alt="">
                </div>
                <div class="post__info">
                    <a href="category-posts.php" class="category__button">Wild Life</a>
                    <h3 class="post__title">
                        <a href="post.php">Lorem ipsum dolor sit amet consectetur adipisicing.</a>
                    </h3>
                    <p class="post__body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ex necessitatibus reprehenderit ipsam facere dolore?
                    </p>
                    <div class="post__author">
                        <div class="post__author-avatar">
                            <img src="./images/avatar3.jpg" alt="">
                        </div>
                        <div class="post__author-info">
                            <h5>By: Julia Nickles</h5>
                            <small>
                                June 18,2022 - 10:34
                            </small>
                        </div>
                    </div>
                </div>
            </article>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/blog3.jpg" alt="">
                </div>
                <div class="post__info">
                    <a href="category-posts.php" class="category__button">Wild Life</a>
                    <h3 class="post__title">
                        <a href="post.php">Lorem ipsum dolor sit amet consectetur adipisicing.</a>
                    </h3>
                    <p class="post__body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ex necessitatibus reprehenderit ipsam facere dolore?
                    </p>
                    <div class="post__author">
                        <div class="post__author-avatar">
                            <img src="./images/avatar4.jpg" alt="">
                        </div>
                        <div class="post__author-info">
                            <h5>By: Bing Wissle</h5>
                            <small>
                                June 18,2022 - 10:34
                            </small>
                        </div>
                    </div>
                </div>
            </article>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/blog4.jpg" alt="">
                </div>
                <div class="post__info">
                    <a href="category-posts.php" class="category__button">Wild Life</a>
                    <h3 class="post__title">
                        <a href="post.php">Lorem ipsum dolor sit amet consectetur adipisicing.</a>
                    </h3>
                    <p class="post__body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ex necessitatibus reprehenderit ipsam facere dolore?
                    </p>
                    <div class="post__author">
                        <div class="post__author-avatar">
                            <img src="./images/avatar5.jpg" alt="">
                        </div>
                        <div class="post__author-info">
                            <h5>By: Ones Keisha</h5>
                            <small>
                                June 18,2022 - 10:34
                            </small>
                        </div>
                    </div>
                </div>
            </article>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/blog5.jpg" alt="">
                </div>
                <div class="post__info">
                    <a href="category-posts.php" class="category__button">Wild Life</a>
                    <h3 class="post__title">
                        <a href="post.php">Lorem ipsum dolor sit amet consectetur adipisicing.</a>
                    </h3>
                    <p class="post__body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ex necessitatibus reprehenderit ipsam facere dolore?
                    </p>
                    <div class="post__author">
                        <div class="post__author-avatar">
                            <img src="./images/avatar6.jpg" alt="">
                        </div>
                        <div class="post__author-info">
                            <h5>By: Collins Kay</h5>
                            <small>
                                June 18,2022 - 10:34
                            </small>
                        </div>
                    </div>
                </div>
            </article>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/blog6.jpg" alt="">
                </div>
                <div class="post__info">
                    <a href="category-posts.php" class="category__button">Wild Life</a>
                    <h3 class="post__title">
                        <a href="post.php">Lorem ipsum dolor sit amet consectetur adipisicing.</a>
                    </h3>
                    <p class="post__body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ex necessitatibus reprehenderit ipsam facere dolore?
                    </p>
                    <div class="post__author">
                        <div class="post__author-avatar">
                            <img src="./images/avatar7.jpg" alt="">
                        </div>
                        <div class="post__author-info">
                            <h5>By: Bill Kehmar</h5>
                            <small>
                                June 18,2022 - 10:34
                            </small>
                        </div>
                    </div>
                </div>
            </article>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/blog7.jpg" alt="">
                </div>
                <div class="post__info">
                    <a href="category-posts.php" class="category__button">Wild Life</a>
                    <h3 class="post__title">
                        <a href="post.php">Lorem ipsum dolor sit amet consectetur adipisicing.</a>
                    </h3>
                    <p class="post__body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ex necessitatibus reprehenderit ipsam facere dolore?
                    </p>
                    <div class="post__author">
                        <div class="post__author-avatar">
                            <img src="./images/avatar8.jpg" alt="">
                        </div>
                        <div class="post__author-info">
                            <h5>By: Tao Ki Sung</h5>
                            <small>
                                June 18,2022 - 10:34
                            </small>
                        </div>
                    </div>
                </div>
            </article>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/blog8.jpg" alt="">
                </div>
                <div class="post__info">
                    <a href="category-posts.php" class="category__button">Wild Life</a>
                    <h3 class="post__title">
                        <a href="post.php">Lorem ipsum dolor sit amet consectetur adipisicing.</a>
                    </h3>
                    <p class="post__body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ex necessitatibus reprehenderit ipsam facere dolore?
                    </p>
                    <div class="post__author">
                        <div class="post__author-avatar">
                            <img src="./images/avatar9.jpg" alt="">
                        </div>
                        <div class="post__author-info">
                            <h5>By: Hueng Yu</h5>
                            <small>
                                June 18,2022 - 10:34
                            </small>
                        </div>
                    </div>
                </div>
            </article>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/blog2.jpg" alt="">
                </div>
                <div class="post__info">
                    <a href="category-posts.php" class="category__button">Wild Life</a>
                    <h3 class="post__title">
                        <a href="post.php">Lorem ipsum dolor sit amet consectetur adipisicing.</a>
                    </h3>
                    <p class="post__body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ex necessitatibus reprehenderit ipsam facere dolore?
                    </p>
                    <div class="post__author">
                        <div class="post__author-avatar">
                            <img src="./images/avatar3.jpg" alt="">
                        </div>
                        <div class="post__author-info">
                            <h5>By: James Kucha</h5>
                            <small>
                                June 18,2022 - 10:34
                            </small>
                        </div>
                    </div>
                </div>
            </article>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/blog2.jpg" alt="">
                </div>
                <div class="post__info">
                    <a href="category-posts.php" class="category__button">Wild Life</a>
                    <h3 class="post__title">
                        <a href="post.php">Lorem ipsum dolor sit amet consectetur adipisicing.</a>
                    </h3>
                    <p class="post__body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ex necessitatibus reprehenderit ipsam facere dolore?
                    </p>
                    <div class="post__author">
                        <div class="post__author-avatar">
                            <img src="./images/avatar3.jpg" alt="">
                        </div>
                        <div class="post__author-info">
                            <h5>By: Paul Bilings</h5>
                            <small>
                                June 18,2022 - 10:34
                            </small>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
    <!-----End of Posts---->

    <section class="category__buttons">
        <div class="container category__buttons-container">
            <a href="" class="category__button">Art</a>
            <a href="" class="category__button">Science</a>
            <a href="" class="category__button">Technology</a>
            <a href="" class="category__button">Music</a>
            <a href="" class="category__button">Food</a>
            <a href="" class="category__button">Travel</a>
        </div>
    </section>


    <!----===========End of Category buttons=======-->
<?php
include 'partials/footer.php';
