<title>P&amp;R_signup_user_data</title>
<script type="text/javascript" charset="utf-8">
    var BASEURL = "<?php echo Router::url('/', true); ?>";
</script>
<?php

// JS Libraries library
echo $this->Html->script(array('lib/jquery-min','lib/jquery-ui','lib/jquery.color','lib/selectbox','lib/scrollTo','common','lib/jquery.placeholder','lib/tinyscrollbar','lib/jquery.maskedinput-1.3.min','lib/jquery.confirm','lib/jquery.livequery.min','pr'));

// data validation
echo $this->Html->script(array('lib/jquery.validationEngine','lib/jquery.validationEngine-en'));
echo $this->Html->css(array('validationEngine.jquery','template'));

// Format Currency
echo $this->Html->script('lib/jquery.formatCurrency');

echo $this->Html->css(array('reset','style','fonts','scrollbar','confirmbox'));
?>

<link rel="shortcut icon" href="images/favicon.png" />

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-27041522-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- Load PIE for rounded corners in IE -->
<!--[if IE ]><?php
	echo $this->Html->css('pie');
	echo $this->Html->script('pie');
?><![endif]-->
