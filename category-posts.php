<?php
include 'partials/header.php';

//fetch post if id is set
if(isset($_GET['id'])){
    $id =filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts where category_id = $id ORDER BY date_time DESC";
    $posts = mysqli_query($connection, $query);

}else{
    header('location: ' .ROOT_URL .'blog.php');
    die();
}

?>

    <header class="category__title">
        <h2>
        <?php //fetch category from ctegories table using category_id of post
        $category_id = $id;
        $category_query = "SELECT * FROM categories  where id = $id";
        $category_result = mysqli_query($connection,$category_query);
        $category = mysqli_fetch_assoc($category_result);
        //$category_title = $category['title'];
        echo $category['title']
        ?>
        </h2>
                   
    </header>


    <!----------End of Category Title-------->
    <?php if(mysqli_num_rows($posts) > 0) : ?>
    <section class="posts">
        <div class="container posts__container">
            <?php while($post = mysqli_fetch_assoc($posts)) : ?>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/<?php echo $post['thumbnail'] ?>" alt="">
                </div>
                <div class="post__info">
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
    <?php else: ?>
        <div class="alert__message error lg">
            <p>
                No posts found in this Category
            </p>
        </div>
        <?php endif ?>
    <!-----End of Posts---->
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

        <footer>
            <div class="footer__socials">
                <a href="https://youtube.com/ela--kali" target="_blank"><i class="uil uil-youtube"></i></a>
                <a href="https://facebook.com/ela--kali" target="_blank"><i class="uil uil-facebook-f"></i></a>
                <a href="https://instagram.com/ela--kali" target="_blank"><i class="uil uil-instagram-alt"></i></a>
                <a href="https://linkedin.com/ela--kali" target="_blank"><i class="uil uil-linkedin"></i></a>
                <a href="https://x.com/ela--kali" target="_blank"><i class="uil uil-twitter"></i></a>

            </div>
            <div class="container footer__container">
                <article>
                    <h4>Categories</h4>
                    <ul>
                        <li><a href="">Art</a></li>
                        <li><a href="">Science</a></li>
                        <li><a href="">Technology</a></li>
                        <li><a href="">Travel</a></li>
                        <li><a href="">Music</a></li>
                        
                    </ul>
                </article>
                <article>
                    <h4>Permalinks</h4>
                    <ul>
                        <li><a href="">Home</a></li>
                        <li><a href="">Blog</a></li>
                        <li><a href="">About</a></li>
                        <li><a href="">Services</a></li>
                        <li><a href="">Contact</a></li> 
                    </ul>
                </article>
                <article>
                    <h4>Support</h4>
                    <ul>
                        <li><a href="">Online Support</a></li>
                        <li><a href="">call Numbers</a></li>
                        <li><a href="">Emails</a></li>
                        <li><a href="">Social Support</a></li>
                        <li><a href="">Location</a></li>                   
                    </ul>
                </article>
                <article>
                    <h4>Blog</h4>
                    <ul>
                        <li><a href="">Safety</a></li>
                        <li><a href="">Repair</a></li>
                        <li><a href="">Recent</a></li>
                        <li><a href="">Popular</a></li>
                        <li><a href="">Categoris</a></li>
                    </ul>
                </article>
            </div>


            <div class="footer__copyright">
                <small>Copyright &copy; Ela Kali</small>
            </div>
        </footer>
    <script src="./main.js"></script>
</body>
</html>