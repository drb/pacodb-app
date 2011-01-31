<h2 class="title tk-gesta"><?=$page_title?></h2>
<section class="wrapper" id="login">
	<?=Form::open('frm-login', array('method'=>'post', 'action'=>''))?>
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
		<dt>Email address:</dt>
		<dd><?=Form::textfield('username', array('value'=>$username, 'autocomplete'=>'off'))?></dd>
		<dt>Password:</dt>
		<dd><?=Form::password('password', array('value'=>$password, 'autocomplete'=>'off'))?></dd>
	</dl>
	<p id="submit-container"><?=Form::submit('submit', array('class'=>'button', 'value'=>'Log in'))?></p>
	<?=Form::close()?>
	<!--<p id="reminder"><a href="/cms/reminder">Forgotton passsword?</a></p>-->
</section>