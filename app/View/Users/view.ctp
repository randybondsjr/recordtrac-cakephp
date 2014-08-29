<div class="row">
  <div class="col-sm-8">
    <h1>View <?php echo $agencyName; ?> Staff</h1>

    <h3><?php echo $record["User"]["alias"]; ?></h3>
    <p><strong>Department</strong>: <?php echo $record["Department"]["name"]; ?></p>
    <p><strong>Email</strong>: <?php echo $this->Text->autoLinkEmails($record["User"]["email"]); ?></p>
    <p><strong>Phone</strong>: <?php echo $record["User"]["phone"]; ?></p>
  </div>
</div>
<div class="clearfix"></div>