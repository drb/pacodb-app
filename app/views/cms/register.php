<h2 class="title tk-gesta"><?=$page_title?></h2>
<section class="wrapper" id="register">
        <?=Form::open('frm-register', array('method'=>'post', 'action'=>''))?>
	<?=Form::hidden('submitted', 1)?>
	<?
	if (isset($errors))
	{
		/*echo '<ul class="message error">';
		Utilities::iterator($errors, 'Formatting::pretty');
		echo '</ul>';*/
		?>
		<aside id="registration-errors" class="message error">
			<ul>
				<?=Utilities::iterator($errors, 'Formatting::pretty');?>
			</ul>
		</aside>
		<?
	}
	?>
	<dl>
		<dt>Your name:</dt>
		<dd><?=Form::input('name', array('value'=>$name, 'autocomplete'=>'off'))?></dd>
		<dt>Email address:</dt>
		<dd><?=Form::input('email', array('value'=>$email, 'autocomplete'=>'off'))?></dd>
		<dt>Password:</dt>
		<dd><?=Form::password('password', array('value'=>$password, 'autocomplete'=>'off'))?></dd>
                <dt>Confirm password:</dt>
		<dd><?=Form::password('password_confirm', array('value'=>$password_confirm, 'autocomplete'=>'off'))?></dd>
	</dl>
	<p id="submit-container"><?=Form::submit('submit', array('class'=>'green button', 'value'=>'Register'))?></p>
	<?=Form::close()?>

</section>
