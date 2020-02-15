<?php

/*
 *
 * Online Controller Class.
 */

class OnlineController
{
    public function online()
    {
        $ipDAO = new IPDAO();
        $onlineDAO = new OnlineDAO();
        $ip = $ipDAO->getIP();
        
        global $mID;

        if($mID == 0)
        {
            $on = $onlineDAO->SelectByIP($ip);
            if($on != null)
            {
                $onlineDAO->UpdateByIP($on);
            }
            else
            {
                $online = new Online(array(
                    "MemberID" => 0,
                    "Ip" => $ip,
                ));
                $onlineDAO->Add($online);
            }
        }
        else
        {
            $on = $onlineDAO->SelectByID($mID);

            if($on != null)
            {
                $onlineDAO->UpdateByID($on);
            }
            else
            {
                $online = new Online(array(
                    "MemberID" => $mID,
                    "Ip" => $ip,
                ));
                $onlineDAO->Add($online);
            }
        }

        /* Delete OffLine Members */
        $onlineDAO->Delete();
    }
}