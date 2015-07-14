<?php 
  class EmailObfuscateHelper extends AppHelper {
    function hideEmail($email){ 
      $pieces = explode("@", $email);
	
  		$cleanedEmail = '
  			<script type="text/javascript">
  				var a = "<a href=\'mailto:";
  				var b = "' . $pieces[0] . '";
  				var c = "' . $pieces[1] .'";
  				var d = "\' class=\'email\'>";
  				var e = "</a>";
  				document.write(a+b+"@"+c+d+b+"@"+c+e);
  			</script>
  			<noscript>Please enable JavaScript to view emails</noscript>
  		';
  		return $cleanedEmail;
    }
  }