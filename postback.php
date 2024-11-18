<?php 
$hash=$_GET['hash'];
$status=$_GET['status'];
$payout=$_GET['payout'];


    $timeout=5;
$ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
//smaller than =0,means not using vpn and if greater than 0 means using vpn it will not go to advertiser url,plz close your vpn then try again 
        //if you're using custom flags (like flags=m), change the URL below
        curl_setopt($ch, CURLOPT_URL, 'https://dreamaff.com/postback?&hash='.$hash.'&status='.$status.'&payout='.$payout.'');
        $response=curl_exec($ch);
        
        curl_close($ch); 

?>