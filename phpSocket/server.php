<?
  $host = "127.0.0.1";
  $port = 20205;
  set_time_limit(0);

  $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("소켓 생성 실패\n");
  $result = socket_bind($socket, $host, $port) or die("소켓 바인딩 실패\n");

  $result = socket_listen($socket, 3) or die("소켓 수신 설정 실패");
  echo "연결중";

  class Chat{
    function readline(){
      return rtrim(fgets(STDIN));
    }
  }

  do{
    $accept = socket_accept($socket) or die("could not accept incoming connection");
    $msg = socket_read($accept, 1024) or die("could not read input\n");

    $msg = trim($msg);
    echo "Client says: \t".$msg."\n\n";

    $line = new Chat();
    echo "Enter Reply:\t";
    $reply = $line->readline();

    socket_write($accept, $reply, strlen($reply)) or die("could not write output\n");
  } while(true);

  socket_close($accept, $socket);
?>