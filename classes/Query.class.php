<?php
class Query {
	
	private static $ip = 'helix.vis.uky.edu';
	private static $port = 7776;
	private $query;

	public function __construct($query) {
		$this->query = $query;
	}

	public function testData() {
		return array(
			array(
				'title' => 'mytitle',
				'type' => 'photo',
				'author' => 'auth.com',
				'timestamp' => 1,
				'tags' => array(
					'this','is','a','tag',
				),
				'content' => 'https://24.media.tumblr.com/8c45c12892a3d6bd4eba64701cdf44fa/tumblr_n2i3owJCzg1tuoo5so2_1280.jpg'
			),
			array(
				'title' => 'My useless thoughts',
				'type' => 'text',
				'author' => 'tommycrush.tumblr.com',
				'timestamp' => 1,
				'tags' => array(
					'this','is','a','tag',
				),
				'content' => 'These are some of my random thoughts. Blah Blah Blah Blah Blah Blah Blah Blahasdfasdfasdfasdfasdfasdf.',
			),
			array(
				'title' => 'Here is one of my favorite videos',
				'type' => 'video',
				'author' => 'tommycrush.tumblr.com',
				'timestamp' => 1,
				'tags' => array(
					'this','is','a','tag',
				),
				'content' => 'http://www.youtube.com/watch?v=dTc--0sZbrE',
			),		
			array(
				'title' => 'Here is my linkkkk',
				'type' => 'link',
				'author' => 'tommycrush.tumblr.com',
				'timestamp' => 1,
				'tags' => array(
					'dogs',
				),
				'content' => 'http://goodcoyotes.tumblr.com/post/80119749672',
			),				
		);
	}

	public function execute() {
		// if its a unit_test, return the fake data
		if ($this->query == 'unit_test') {
			return $this->testData();
		}

		error_log("Looking for ".$this->query);

		$message = json_encode(array("query" => $this->query));
		error_log("Sending: ".$message);
		$json = $this->sendMessageToSocket(self::$ip, self::$port, $message);

		try {
			// make it an array instead of an object.
			$data = json_decode($json, true);
			$posts = $data["posts"];
			return $posts;
		} catch (Exception $e) {
			error_log("Error decoding message:");
			error_log($e->getMessage());
		}
	}

	private function sendMessageToSocket($ip, $port, $message) {
		//Create TCP/IP sream socket and return the socket resource
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		if ($socket === false) {
		    error_log( "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n");
		} else {
		    error_log( "OK.\n" );
		}

		// Bind the source address
		//socket_bind($socket, 'localhost');
		$connected = socket_connect($socket, $ip, $port);
		if ($connected === false) {
		    error_log( "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n");
		} else {
		    error_log( "OK.\n");
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