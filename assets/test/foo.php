<html>

  <head>
  </head>
  <body>
<?

require('codebase/core/encryption.inc');
require('codebase/core/database.inc');

$encrypted_string = Encryption::encrypt('test'); // Åž-\Ž“kcþ1ÿ4gî:Xƒã%
$decrypted_string = Encryption::decrypt($encrypted_string); // this is a test
$encoded = utf8_encode($encrypted_string);

print($encrypted_string);
print("<hr/>");
print($encoded);
print("<hr/>");
print($decrypted_string);

$db = new Database();
$db->connect();

$db->update('sites', array('name'=>'localhost'), array('credentials.ftp.port'=>56, 'credentials.ftp.password'=>$encoded));
?>
</body>
</html>
