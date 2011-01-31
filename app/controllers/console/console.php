<?php

class Console extends BaseController
{
    private $user_id;

    public function __construct()
    {
        parent::__construct();

        $this->user_id = Session::get('user_id', null);
        if (is_null($this->user_id))
        {
            //echo 'not logged in';
            Http::redirect('/');
        }
    }

    public function _console()
    {
        $view = new View();
        echo $this->template->render('templates/webapp', $view->render('console/index'));
    }

    /**
     * Buckets index page -shows all buckets owned by user
     */
    public function buckets($type='all')
    {
        $view = new View();

        switch ($type)
        {
        case 'all';
            $tpl = 'console/buckets/index';
            $buckets = $this->api->call('bucket.describe');

            if (array_key_exists('error', $buckets))
            {
                $view->bind('error', $buckets['error']['message']);
            }
            else if (array_key_exists('bucket', $buckets))
            {
                $view->bind('buckets', $buckets['bucket']);
            }
            break;
        case 'create':
            $tpl = 'console/buckets/create';
            break;
        }

        echo $this->template->render('templates/webapp', $view->render($tpl));
    }

    /**
     * Single bucket page
     */
    public function bucket($id)
    {
        $view = new View();

        if ($id)
        {
            $bucket = $this->api->call('bucket.describe', array('id'=>$id));
            //print($bucket['response']['execution_time']);
            if (array_key_exists('bucket', $bucket))
            {
               $this->template->update('title', ' - Editing bucket ' . $bucket['bucket']['name']);
               $view->bind('bucket', $bucket['bucket']);
            }

        }


        echo $this->template->render('templates/webapp', $view->render('console/buckets/edit'));
    }
}
?>