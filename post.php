<?php
include 'partials/header.php';

//fetch post from database if id is set
if(isset($_GET['id'])){
    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts where id =$id";
    $result = mysqli_query($connection, $query);
    $post = mysqli_fetch_assoc($result);
}else{
    header('location: ' . ROOT_URL .'blog.php');
    die();
}

?>
    <!----------End of nav-------->
    <section class="singlepost">
        <div class="container singlepost__container">
            <h2>
                <?php echo $post['title']?>
            </h2>
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
            <div class="singlepost__thumbnail">
                <img src="./images/<?php echo $post['thumbnail'] ?>" alt="">
            </div>
            <p>
            <?php echo $post['body'] ?>
            </p>
        </div>
    </section>

    <!-------End of single Post----------->

    
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