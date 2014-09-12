<p>Thank you for submitting a public records request to the <?php echo $agencyName; ?>. You will receive email updates about your request, but you can always view any activity on the request page, <a href='<?php echo Router::fullbaseUrl().$page; ?>'><?php echo Router::fullbaseUrl().$page; ?></a>.</p>
<p>In the next <?php echo $responseDays; ?> business days, you can expect a response from the <?php echo $agencyName; ?>.</br>
A response can be the following:</p>
<ul>
<li>a question about your request</li>
<li>an estimate on when your records will be delivered</li>
<li>a note explaining why the records cannot be released</li>
<li>the documents you requested</li>
</ul>
<p>This email is an automated notification, which is unable to receive replies. Please contact <a href="mailto:<?php echo $ownerEmail; ?>"><?php echo $ownerEmail; ?></a> with any questions or concerns.</p>
<br/>  
<p><hr><br/><br/></p>
<footer>
<span style="font-family: arial,helvetica,sans-serif;"><span style="color: rgb(51, 51, 51); font-size: 11px;">
<center>
<img src="<?php echo Router::fullbaseUrl(); ?>/img/recordtrac/logo.png" width="121" height="121"> <br /> <br />
<?php echo $agencyName; ?>
</center>
</footer>