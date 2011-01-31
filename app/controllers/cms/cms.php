<?php
/**
 * CMS is an extension of base controller
 *
 * @author Dave Bullough <dave@pacocms.com>
 * @package Piku
 */
class CMS extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function _cms()
    {
        Http::redirect('cms/login');
    }

    /**
     * CMS Login page
     */
    public function login()
    {
        $form = array(
			'username'=>array(
				'default'=>'',
				'validation'=>array(
					'required',
					'email'
				)
			),
			'password'=>array(
				'default'=>'',
				'validation'=>array(
					'required'
				)
			)
		);

        // view for the login page
        $view = new View();
        $view->bind('page_title', 'Login');
        $view->bind_each($form);

        if (Form::is_postback())
        {
            $post = Utilities::array_overwrite($form, Form::post());

            $view->bind_each($post);

            $validate = Form::validate($_POST, $form, true);
            if (sizeof($validate) > 0)
            {
                $view->bind('errors', $validate);
            }
            else
            {
                // do proper login here
                if ($post['username'] == 'dave@agsc.co.uk' && $post['password'] == '12x12144')
                {
                    Session::set('user_id', 'davetest');

                    Http::redirect('/console');
                }
                else
                {
                    $view->bind('errors', array('Log in credentials are incorrect'));
                }
            }
        }

        $this->template->update('title', ' - Login');
        echo $this->template->render('templates/webapp', $view->render('cms/login'));
    }

    /**
     *
     */
    public function logout()
    {
        Session::kill();
        http::redirect('/');
    }

    public function index()
    {
        $this->template->bind('title', 'pacoDB.');

        $view = new View();

        echo $this->template->render('templates/webapp', $view->render('holding/index'));
    }

    /**
     * News user registrations
     */
    public function register()
    {
         $form = array(
                        'name'=>array(
                                'default'=>'',
                                'validation'=>array(
                                        'required',
                                        'alphanumeric'
                                )
			),
			'email'=>array(
				'default'=>'',
				'validation'=>array(
					'required',
					'email'
				)
			),
			'password'=>array(
				'default'=>'',
				'validation'=>array(
					'required',
                                        'min_length[7]'
				)
			),
                        'password_confirm'=>array(
				'default'=>'',
				'validation'=>array(
                                        'depends_on[password]',
                                        'required',
                                        'matches[password]'
				)
			)
		);

        $view = new View();
        $view->bind_each($form);
        $view->bind('page_title', 'Register for a new account');
        $this->template->update('title', ' - Register');

        if (Form::is_postback())
        {
            $post = Utilities::array_overwrite($form, Form::post());

            $view->bind_each($post);

            $validate = Form::validate($_POST, $form, true);
            if (sizeof($validate) > 0)
            {
                $view->bind('errors', $validate);
            }
            else
            {
                print ('Registration succesful');
            }
        }

        echo $this->template->render('templates/webapp', $view->render('cms/register'));
    }

    /**
     * Renders a sitemap in XML format
     */
    public function sitemap()
    {
        Http::headers('text/xml');

        $xml = new DOMDocument('1.0', 'ISO-8859-1');
        $urlset = $xml->appendChild(new DomElement('urlset'));
        $urlset->setAttribute('xmlns',      'http://www.sitemaps.org/schemas/sitemap/0.9');
        $urlset->setAttribute('xmlns:xsi',  'http://www.w3.org/2001/XMLSchema-instance');
        $urlset->setAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');

        // sample object - this need to poll an internal API to generate the pages
        $object = array(
            'loc'=>'somewhere',
            'lastmod'=>date('c'),
            'changefreq'=>'monthly',
            'priority'=>'0.8',
        );
        $url = $this->sitemap_add_url($urlset, $object);
        echo $xml->saveXML();
    }


    /**
     * Adds a url node to the sitemap
     *
     */
    private function sitemap_add_url($root, $obj)
    {
        $url = $root->appendChild(new DOMElement('url'));
        foreach($obj as $type=>$value)
        {
            $node = $url->appendChild(new DomElement($type, $value));
        }
    }
}
?>