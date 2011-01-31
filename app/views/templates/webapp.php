<!DOCTYPE html>
<html>
    <head>
        <title><?=$title?></title>
        <script type="text/javascript" src="http://use.typekit.com/ksr5hmd.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
        <script type="text/javascript" src="/assets/js/jquery-1.4.4.min.js"></script>
        <script type="text/javascript">
        PacoDB = {
            init: function()
            {
                if ($('#bucket-edit'))
                {
                    $('#bucket-edit a.edit').live(
                        'click',
                        function()
                        {
                            url = $(this).attr('href');
                            $.ajax({
                                'url': url,
                                success:function(data)
                                {
                                    $('#field-data').html(data);
                                }
                            });
                            return false;
                        }
                    );
                }
            }
        }
        $(document).ready(PacoDB.init);
        </script>
        <link href="/assets/css/pacodb.css" rel="stylesheet" />
    </head>
    <body>
        <div id="outer">
            <div id="content">
                <header>
                    <h1 class="tk-gesta"><a href="/">pacoDB</a><br/><span>beta</span></h1>
                    <section>
                        <h4 class="tk-gesta"><?=$strapline?> - <span><a href="/register">try us out for free!</a></span></h4>
                        <?
                        if ($logged_in)
                        {
                        ?>
                            <p style="text-align:right;">Logged in as <?=$user_id?></p>
                        <?
                        }
                        ?>
                        <nav>
                            <ul class="tk-gesta">
                                <li><a href="/login">Log in</a></li>
                                <li class="splitter"> | </li>
                                <li><a href="/pages/features">Features</a></li>
                                <li class="splitter"> | </li>
                                <li><a href="/pages/pricing">Prices</a></li>
                            </ul>
                        </nav>
                    </section>
                </header>
                <div id="main" style="clear:both;">
                    <?=$inner_content?>
                </div>
            </div>
        </div>
        <footer>
            <section>
                <ul>
                    <li><h3 class="tk-gesta">Say hello!</h3></li>
                    <li>
                        <ulclass="tk-gesta">
                            <li><a href="/contact">Contact</a>
                            <li><a href="http://twitter.com/paco_DB">Twitter</a>
                            <li><a href="/blog">Blog</a>
                            <!--<li><br/></li>
                            <li>Powered by <a href="">Piku!</a></li>-->
                        </ul>
                    </li>
                </ul>
                <ul>
                    <li><h3 class="tk-gesta">Developers</h3></li>
                    <li>
                        <ul>
                            <li><a href="/api/docs">The API</a>
                            <li><a href="/api/libraries">Libraries</a>
                        </ul>
                    </li>
                </ul>
                 <ul>
                    <li><h3 class="tk-gesta">Latest tweets</h3></li>
                    <li>
                        <ul id="tweets">
                            <?
                            if (isset($tweets))
                            {
                                foreach($tweets as $tweet)
                                {
                                    echo '<li><a href="">' . $tweet['created_at'] . '</a>: ' . $tweet['text'] . '</li>';
                                }
                            }
                            else
                            {
                                echo '<li>Coming soon</li>';
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </section>
        </footer>
    </body>
</html>