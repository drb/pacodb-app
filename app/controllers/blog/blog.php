<?php
/**
 * Blog uses PacoDB bucket
 *
 * @author Dave Bullough <dave@pacocms.com>
 * @package Piku
 */
class Blog extends BaseController
{
    public function _blog()
    {

        $dummy = '';
        $str = '<h3>Title</h3>
                <p>PacoDB powered blog coming soon</p>';

        for($i = 0; $i < 50; $i++)
        {
            $dummy .= $str;
        }

        $this->template->update('title', ' - Blog!');
        echo $this->template->render('templates/webapp', $dummy);
    }
}