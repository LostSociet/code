<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['keycode'])) {
        $discordWebhookUrl = 'https://discord.com/api/webhooks/1133224788115079168/Aew8Py8biJmtqlCl23e9HDywn3iGJfAgXL8uF-P6qelx9YSAdkG2bEYCaaYy5rdvDl_3';
        $secondWebsiteUrl = 'https://lostsociet.github.io/Reciever/fetch_code.php';

        // Data for Discord webhook
        $keycode = $_POST['keycode'];
        $discordData = array(
            'content' => 'Generated Keycode: ' . $keycode
        );

        // Data for the PHP file on the second website
        $secondWebsiteData = array(
            'keycode' => $keycode,
            'other_data' => 'value', // Add any other data you want to send to the second website
        );

        // Sending data to Discord webhook
        $discordCurl = curl_init($discordWebhookUrl);
        curl_setopt($discordCurl, CURLOPT_POST, 1);
        curl_setopt($discordCurl, CURLOPT_POSTFIELDS, json_encode($discordData));
        curl_setopt($discordCurl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($discordCurl, CURLOPT_RETURNTRANSFER, true);
        $discordResponse = curl_exec($discordCurl);
        curl_close($discordCurl);

        // Sending data to the PHP file on the second website
        $secondWebsiteCurl = curl_init($secondWebsiteUrl);
        curl_setopt($secondWebsiteCurl, CURLOPT_POST, 1);
        curl_setopt($secondWebsiteCurl, CURLOPT_POSTFIELDS, http_build_query($secondWebsiteData));
        curl_setopt($secondWebsiteCurl, CURLOPT_RETURNTRANSFER, true);
        $secondWebsiteResponse = curl_exec($secondWebsiteCurl);
        curl_close($secondWebsiteCurl);

        if ($discordResponse === false || $secondWebsiteResponse === false) {
            echo 'Failed to send the data to Discord or the second website.';
        } else {
            echo 'Data sent to Discord and the second website successfully.';
        }
        exit(); // Terminate PHP script execution after sending the response to the AJAX request
    }
}
?>
