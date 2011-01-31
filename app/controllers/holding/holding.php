<?php
class Holding extends Controller
{
	public function __constuct()
	{
		parent::__construct();
	}

	public function _holding()
	{
		$this->view->bind('title', "Paco! CMS. Website complexity doesn't have to be complex.");
		return $this->view->render('holding/holding');
	}

	public function add()
	{
		$email = Form::get('e');

		if ($email)
		{
			if (Validate::email($email))
			{
				Email::send('dave.bullough+paco@gmail.com', 'New beta request', 'Please add ' . $email . ' to the beta list (' . date('c') . ')');
				return 'ok';
			}
			else
			{
				return 'Email address is invalid';
			}
		}
		else
		{
			return 'No email address supplied.';
		}
	}
}
?>
