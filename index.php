<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact Form - PHP/MySQL Demo Code</title>
</head>

<body>
<fieldset>
<legend>Contact Form</legend>
<form name="frmContact" class="needs-validation " method="post" action="contact.php">
    <p>
      <label for="Name">Your Name </label>
      <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Name" value="" required>
	  <div class="invalid-feedback">
                  Valid first name is required.
                </div>
    </p>
    <p>
      <label for="email">Your Email</label>
      <input type="text"  class="form-control"  name="txtEmail" id="txtEmail" placeholder="Email" value="" required>
    </p>
    <p>
      <label for="phone">Your Phone</label>
      <input type="text"  class="form-control" name="txtPhone" id="txtPhone" placeholder="Phone" value="" required>
    </p>
    <p>
      <label for="message">Message</label>
      <textarea name="txtMessage" class="form-control"  id="txtMessage"  placeholder="Message" required></textarea>
    </p>
    <p>&nbsp;</p>
    <p>
      <input type="submit" name="Submit" id="Submit" value="Click me to Contact"  class="btn btn-primary btn-lg btn-block">
    </p>
  </form>
</fieldset>
</body>
</html>

