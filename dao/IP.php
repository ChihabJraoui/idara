<?php

/*
 * IP Data Access Object Class.
 *
 */

namespace DAO;

use \PDO;


class IP
{
	private $db;
    private $_ip;
    
    function __construct($db)
    {
		$this->db = $db;

        $this->_ip = $_SERVER["REMOTE_ADDR"];
    }


    /*
     * Public Methodes
     *
     */
    public function getIP()
    {
        return $this->_ip;
    }

    public function getCountry($ip)
    {
        $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $ip);
        if ($xml)
        {
            return $xml->geoplugin_countryName;
        }
        return null;
    }

    // private function SaveTXT(IP $ip)
    // {
    // $file = "./log/logs.txt";
    // $s = fopen($file, "a");
    // $txt = $ip->getIP() . "-" . $ip->getDateIP() . "-" . $ip->getCountry() . "-" . $ip->getError() . "-" . $ip->getMemberID() . "\n";
    // fwrite($s, $txt);
    // fclose($s);
    // }
    // private function SaveXML(IP $i)
    // {
    // $xml = new DOMDocument();
    // $xml->load("./log/logs.xml");
    // $log = $xml->createElement("log");
    // $ip = $xml->createElement("ip");
    // $date = $xml->createElement("date");
    // $country = $xml->createElement("country");
    // $error = $xml->createElement("error");
    // $MemberID = $xml->createElement("MemberID");
    // $ip->nodeValue = $i->getIP();
    // $date->nodeValue = $i->getDateIP();
    // $country->nodeValue = $i->getCountry();
    // $error->nodeValue = $i->getError();
    // $MemberID->nodeValue = $i->getMemberID();
    // $log->appendChild($ip);
    // $log->appendChild($date);
    // $log->appendChild($country);
    // $log->appendChild($error);
    // $log->appendChild($MemberID);
    // $Logs = $xml->getElementsByTagName("Logs");
    // foreach($Logs as $l)
    // {
    // $l->appendChild($log);
    // }
    // $xml->save("./log/logs.xml");
    // }
    // public function SelectAll($MemberID = 0)
    // {
    // if($MemberID != 0)
    // $query = "select * from ip where MemberID = $MemberID";
    // else
    // $query = "select * from ip";
    // $result = $this->_db->query($query);
    // $Ips = array();
    // while($data = $result->fetch_assoc)
    // {
    // $IPs[] = new IP($data);
    // }
    // return $IPs;
    // }

    public function add($mID, $error)
    {
        $this->db->query("INSERT INTO iplog (MemberID, IP, DateC, Error)
				VALUES(:memberID, :ip, NOW(), :error)");

	    $this->db->bind(":memberID", $mID, PDO::PARAM_INT);
        $this->db->bind(":ip", $this->_ip, PDO::PARAM_STR);
        $this->db->bind(":error", $error, PDO::PARAM_INT);

	    return $this->db->execute();
    }
}