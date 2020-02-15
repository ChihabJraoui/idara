<?php

class GoogleAuth
{
	protected $client;
	protected $db;
	
	public function __construct($db, Google_Client $googleClient = null)
	{
		$this->client = $googleClient;
		$this->db = $db;
		
		if($this->client)
		{
			$this->client->setClientId("936306864632-j6c2smldi8p9tdih7uk04e3buct6ug2m.apps.googleusercontent.com");
			$this->client->setClientSecret("jIqD3QTpv5GDipQ1XjhXxb86");
			$this->client->setRedirectUri("http://localhost/f/googleAuth.php");
			$this->client->setScopes("email");
		}
	}
	
	public function isLoggedIn()
	{
		return isset($_SESSION["access_token"]);
	}
	
	public function getAuthUrl()
	{
		return $this->client->createAuthUrl();
	}
	
	public function checkRedirectCode()
	{
		if(isset($_GET["code"]))
		{
			$this->client->authenticate($_GET["code"]);
			
			$this->setToken($this->client->getAccessToken());
			
			// $this->StoreUser($this->getPayload());
			
			return true;
		}
		return false;
	}
	
	public function setToken($token)
	{
		$_SESSION["access_token"] = $token;
		
		$this->client->setAccessToken($token);
	}
	
	public function getPayload()
	{
		$payload = $this->client->verifyIdToken()->getAttributes()["payload"];
		return $payload;
	}
	
	protected function StoreUser($payload)
	{
		$sql = "
			INSERT INTO members ()
			VALUES ()
			ON DUPLICATE KEY UPDATE id = 
		";
	}
}

?>