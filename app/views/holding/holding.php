<!DOCTYPE html>
<html>
	<head>
		<!-- Powered by the Piku! Framework -->
		<link rel="stylesheet" href="./assets/holding/holding.css" />
		<script type="text/javascript" src="/assets/js/jquery-1.4.2.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){

			var timeout;

			$('input').attr('place', $('input').val());

			$('a').click(function()
				{
					add($('input').val());
					return false;
				}
			);

			$('input').focus(function()
				{
					if ($(this).val() == $(this).attr('place'))
					{
						$(this).val('');
					}
					//$(this).css('border-color', '#e4e4e4');
				}
			).keypress(function(k)
				{
					if (k.keyCode == 13) add($(this).val());
				}
			).blur(function()
			       {
					if ($(this).val() == '')
					{
						$(this).val($(this).attr('place'));
					}
			       }
			);

			function add(email)
			{
				$('a').text('Sending...');
				$.ajax({
					url: './holding/add',
					data:{
						e: email
					},
					success: function(d)
					{
						if (d.indexOf('ok') > -1)
						{
							msg(1, email + ' has been successfully added!');
						}
						else
						{
							$('a').text('go!');
							msg(0, d);
						}

						$('a').text('go!');
					}
				});
			}

			function msg(type, msg)
			{
				switch(type)
				{
				case 0:
					$("#msg").removeClass('ok').text(msg).fadeIn(
						'normal',
						function()
						{
							var t = setTimeout(function(){$('#msg').fadeOut()}, 5000)
						}
					);
					break;
				case 1:
					$("#msg").addClass('ok').text(msg).fadeIn(
						'normal',
						function()
						{
							var t = setTimeout(function(){$('#msg').fadeOut()}, 15000)
						}
					);
					break;
				}

			}
		});
		</script>
		<title><?=$title?></title>
	</head>
	<body>
		<div id="main">
			<div id="msg"></div>
			<div id="top">
				<div id="paco">
					<div id="blurb">
						<p class="indent"><span class="paco strong">pa&middot;co</span> | noun</p>
						<p class="indent"><span class="treb">Complex content management made easy</span></p>
					</div>
					<p><input type="text" value="Interested in the beta? Add your email!" /><a href="" class="button green">go!</a></p>
					<p id="error"></p>
				</div>
			</div>
		</div>
		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-2736611-8']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
	</body>
</html>
