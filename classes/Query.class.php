<?php
class Query {
	
	private static $ip = '127.0.0.1';
	private static $port = 7777;
	private $query;

	public function __construct($query) {
		$this->query = $query;
	}

	public function execute() {
		$message = json_encode(array('query'=> $this->query));
		echo $this->sendMessageToSocket(self::$ip, self::$port, $message);
	}

	private function sendMessageToSocket($ip, $port, $message) {
		//Create TCP/IP sream socket and return the socket resource
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		// Bind the source address
		//socket_bind($socket, 'localhost');
		$connected = socket_connect($socket, $ip, $port);
		if($connected == false){
			throw new Exception("couldnt connect");
		}

		socket_send($socket, $message, strlen($message), MSG_EOF);

		socket_shutdown($socket, 1);

		$buf = '';
		$fullResponse = '';
		while($bytes = socket_recv($socket, $buf, 2048, MSG_WAITALL)) {
				if ($bytes == 0) {
					break;
				}

			    error_log( "Read $bytes bytes from socket_recv" );
			    $fullResponse .= $buf;		
		}

		socket_close($socket);
		error_log($fullResponse);
		return $fullResponse;
	}

}