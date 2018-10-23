    <div class='main-field style='background-color: lightgrey;'>  
        <div class='container-fluid ' >
            <div class='container data-field'>
                <div class='row'>
                    <div class='col-md-8 blog-main'>
                    <div class='blog-post'>
                                        <a class=' none-decored' href='article.php?show=$art_id'>
                                            <h2 class='blog-post-title'> $title </h2>
                                        </a>
                                        <p class='blog-post-meta'>$pub_date автор $screen_name<a class='none-decored' href='#'></a>
                                        </p>
                                        <div style='display: none;'>$art_id</div>
                                        <p>$art_intro</p>
                                        <p><img class='post-preview-img' src='$art_intro_img'></p>
                                        <br>
                                        <div class='post-footer'>
                                            <form class='pull-xs-left ' action='article.php' method='get'>
                                                <button type='submit' class='read-more-btn'>Читать далее...</button>
                                                <input type='hidden' name='show' value='$art_id'>
                               <!--       <button class='read-more-btn' onclick='return deletePost(show)'>Изменить</button>   -->
                                                <button class='read-more-btn' onclick='return deletePost($art_id)'>Удалить</button>
                                      </form>
                                            <a href='article.php?show=$art_id#commentAnchor' class='show-comments none-decored'>
                                                <div class='pull-xs-right comments-link'>Комментарии
                                                </div>
                                            </a>
                                        </div>
                                        <br style='clear: both;'>
                                        <hr>
                                        <br>
                                    </div>

                    </div><!-- /.blog-main -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div>
    </div>

