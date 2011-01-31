<?php

class Ajax extends BaseController
{
    private function check_ajax()
    {
        return true;
    }

    public function bucket_field_details($name)
    {

        if (!$this->check_ajax())
        {
            exit('Invalid request');
        }


        // get the field name and the bucket id
        $name       = strtolower($name);
        $bucket_id  = Form::get('id');

        // get the bucket, and the field
        $bucket = $this->api->call('bucket.describe', array('id'=>$bucket_id));

        if (array_key_exists('bucket', $bucket))
        {
            $fields = $bucket['bucket']['fields'];
            foreach($fields as $field)
            {
                // find the field so we can output the applicable fields
                if ($field['name'] == $name)
                {
                    echo Form::open();
                    ?>
                    <dl>
                        <dt>Field name:</dt>
                        <dd><?=Form::textfield('name', array('value'=>$name));?></dd>
                        <dt>Type:</dt>
                        <dd><?=Form::select('type', array(), array('Text input', 'Choice - radio', 'Choice - checkbox',  'Tags'));?></dd>
                        <dt>Options (bind to other bucket):</dt>
                        <dd>
                            <ul>
                                <?
                                if (array_key_exists('options', $field))
                                {
                                    foreach($field['options'] as $option)
                                    {
                                        ?>
                                        <li><?=$option?></li>
                                        <?
                                    }
                                }
                                ?>
                            </ul>
                        </dd>
                        <dt>Validation:</dt>
                        <dd>
                            <ul>
                                <?
                                foreach($field['validation'] as $validation)
                                {
                                    ?>
                                    <li><?=$validation?></li>
                                    <?
                                }
                                ?>
                            </ul>
                        </dd>
                    </dl>
                    <?
                    echo Form::close();
                }
            }

        }

    }
}
?>