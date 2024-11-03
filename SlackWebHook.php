<?php

class SlackWebHook{

	private static $url = 'https://hooks.slack.com/services/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';
	private static $ProjectDocurl = 'https://hooks.slack.com/services/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/payload';
	private static $type = array('Content-Type: application/json');

	const DEFAULT_SENDER = 'reminder';

	static function curl($url, $payload) {
		$data = '';
		if (is_array($payload)) {
			if (!array_key_exists('text', $payload))
				throw new \Exception('You need to specify "text" key and value in parameter array');

			$data = json_encode($payload);
		} else {
			$data = json_encode(array('text' => $payload, 
									  'username' => self::DEFAULT_SENDER
									  )
								);
		}

		$ci = curl_init();

		curl_setopt($ci, CURLOPT_URL, $url);
		curl_setopt($ci, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ci, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ci, CURLOPT_HTTPHEADER, array_merge(self::$type, 
														array('Content-Length: '. strlen($data))
														)
					);
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);

		// Disable SSL
		curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ci, CURLOPT_VERBOSE, 1);

		$resp = curl_exec($ci);
		curl_close($ci);

		return $resp;
	}
	static function notify_reminder ($message) {
		return self::curl(self::$url,[
			'username' => 'New Order',
			'text' => $message,
			'channel' => '#notify-reminder',
			'icon_emoji' => ':slack:',
		]);
	}

	
}

