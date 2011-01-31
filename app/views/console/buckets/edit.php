<h2 class="title tk-gesta"><strong><a href="/console/buckets">Buckets</a></strong> &gt; <?=$bucket['name']?></h2>
<section id="bucket-edit" class="wrapper">
    <aside id="field-data" style="float:right;width:400px;">
        <form>
        <dl>
            <dt>Field name:</dt>
            <dd><?=Form::textfield('name');?></dd>
            <dt>Type:</dt>
            <dd><?=Form::select('type', array(), array('Text input', 'Choice - radio', 'Choice - checkbox',  'Tags'));?></dd>
            <dt>Options (bind to other bucket):</dt>
            <dd>
                <ul>
                    <li>Cat</li>
                    <li>Dog</li>
                    <li>Giraffe</li>
                </ul>
            </dd>
            <dt>Validation:</dt>
            <dd>
                <ul>
                    <li><?=Form::checkbox('required')?> Required</li>
                </ul>
            </dd>
        </dl>
        </form>
    </aside>
    <?
    if (isset($bucket))
    {
        //print_r($bucket);
        echo Form::open();
        ?>
        <dl>
            <dt>Bucket name:</dt>
            <dd><?=Form::textfield('name', $bucket['name']);?></dd>
            <dt>Description:</dt>
            <dd><?=Form::textarea('description', array('value'=>$bucket['description']));?></dd>
        </dl>

        <dl>
        <?
            foreach($bucket['fields'] as $field)
            {
                ?>
                <dt><?=$field['name']?></dt>
                <dd>
                    <!--type: <?=$field['type']?>. validation: <?=implode(', ', $field['validation'])?>
                    <?if (isset($field['options'])) {echo implode(', ', $field['options']);}?>--><a class="edit" href="/ajax/bucket-field-details/<?=$field['name']?>?id=<?=$bucket['id']?>" style="color:blue;">edit</a> <a href="" style="color:red;">delete</a> <a href="" style="color:green;">move</a>
                </dd>
                <?
            }
            ?>
            <dt><a href="">Add new field</a></dt>
        </dl>
        <?
        //echo Form::button('update', 'U');
        echo Form::close();
    }
    ?>
    <hr style="clear:both;" />
    <p>Some API options here I suppose</p>
</section>