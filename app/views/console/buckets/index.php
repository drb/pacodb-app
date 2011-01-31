<h2 class="title tk-gesta">Your buckets</h2>
<section class="wrapper" id="buckets">
    <ul>
        <?
        if (isset($error))
        {
            echo '<li class="message error">' . $error . '</li>';
        }
        else if (isset($buckets))
        {
            foreach($buckets as $bucket)
            {
                ?>
                <li>
                    <h4><a href="./bucket/<?=$bucket['id']?>"><?=$bucket['name']?></a></h4>
                    <p><?=$bucket['description']?></p>
                </li>
                <?
            }
        }
        else
        {
            ?>
            <li>You don't appear to have any buckets configured. <a href="/console/buckets/create">Create one</a>.</li>
            <?
        }
        ?>
    </ul>
</section>