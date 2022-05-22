<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div align='center'>

  </div>
  <form action="" method="post">
    <table>
      <tbody>
        <tr>
          <td>
            <label for="">Enter Message</label>
            <input type="text" name='txtMsg'>
            <input type="submit" name="btnSend" value="Send">
          </td>
        </tr>
        <?
        $host = "127.0.0.1";
        $port = 20205;
        if (isset($_POST['btnSend'])) {
          $msg = $_REQUEST['txtMsg'];
          $socket = socket_create(AF_INET, SOCK_STREAM, 0);
          socket_connect($socket, $host, $port);

          socket_write($socket, $msg, strlen($msg));

          $reply = socket_read($sock, 1924);
          $reply = trim($reply);
          $reply = "server says:\t" . $reply;
        }
        ?>
        <tr>
          <td>
            <textarea id="" cols="30" rows="10"><? echo @$reply; ?>
        </textarea>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
</body>

</html>