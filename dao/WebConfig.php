<?php

namespace DAO;

class WebConfig
{
	private $db;

    public function __construct($db)
    {
		$this->db = $db;
    }


    /*
     * Functions
     */
	public function getValue($param)
	{
		$this->db->query("SELECT $param FROM config");
		$this->db->execute();

		$data = $this->db->getResult();
		return $data[$param];
	}

    public function updateValues(array $data)
    {
        $title = $data["Title"];
        $desc = $data["Description"];
        $keywords = $data["Keywords"];
        $logo = $data["Logo"];
        $forumAddress = $data["Address"];
        $adminAddress = $data["AdminAddress"];
        $copyright = $data["Copyright"];
        $email = $data["Email"];
        $author = $data["Author"];

        $this->db->query("UPDATE config SET Title = :title, Description = :desc, Keywords = :keywords,
                          Logo = :logo, Address = :address, AdminAddress = :adminAddress, Copyright = :copyright,
                          Email = :email, Author = :author");
        $this->db->bind(':title', $title);
        $this->db->bind(':desc', $desc);
        $this->db->bind(':keywords', $keywords);
        $this->db->bind(':logo', $logo);
        $this->db->bind(':address', $forumAddress);
        $this->db->bind(':adminAddress', $adminAddress);
        $this->db->bind(':copyright', $copyright);
        $this->db->bind(':email', $email);
        $this->db->bind(':author', $author);

        return $this->db->execute();
    }
}