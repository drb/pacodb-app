<?php
class BaseController extends Controller
{
    protected $api;

    public function __construct()
    {
        parent::__construct();

        Session::init();

        $straps = array('Data should be easy to capture');

        $this->template = new View();
        $this->template->bind('title',      'Paco');
        $this->template->bind('strapline',  Utilities::array_random($straps));

        if (!is_null(Session::get('user_id', null)))
        {
            $this->template->bind('user_id', Session::get('user_id'));
            $this->template->bind('logged_in', true);

            // setup a connector object to do all querying. @todo make these credentials come from proper lookup on login!
            $this->api = new PacoConnector(
                '8d70e0d1acb06b4648c7aa8927509660',
                'b52b073595ccb35eaebb87178227b779'
            );

            // on dev, point to dev datastore
            $this->api->set_service('http://api.pacocms-dev.com/rest/1.0');
        }
        else
        {
            $this->template->bind('logged_in', false);
        }

        //$tweets = Http::fetch('http://search.twitter.com/search.json?q=from%3Awossy&rpp=3');
        $tweets = array();

        /**
         * {"results":[{"from_user_id_str":"12983","profile_image_url":"http://a0.twimg.com/profile_images/357750272/small_3_normal.png","created_at":"Thu, 27 Jan 2011 21:05:53 +0000","from_user":"al3x","id_str":"30733255049224192","metadata":{"result_type":"recent"},"to_user_id":2136034,"text":"@delbius Mashup! "O Mario, You're Unbelievably Fortunate"","id":30733255049224192,"from_user_id":12983,"to_user":"delbius","geo":null,"iso_language_code":"en","to_user_id_str":"2136034","source":"<a href="http://itunes.apple.com/us/app/twitter/id409789998?mt=12" rel="nofollow">Twitter for Mac</a>"},{"from_user_id_str":"12983","profile_image_url":"http://a0.twimg.com/profile_images/357750272/small_3_normal.png","created_at":"Thu, 27 Jan 2011 20:50:55 +0000","f
         */
        if (array_key_exists('http_code', $tweets) && $tweets['http_code'] == 200)
        {
            $tweets_json = json_decode($tweets['content'], true);
            $this->template->bind('tweets', $tweets_json['results']);
        }
    }
}
?>