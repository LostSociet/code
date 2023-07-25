<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['keycode'])) {
        $discordWebhookUrl = 'https://discord.com/api/webhooks/1133224788115079168/Aew8Py8biJmtqlCl23e9HDywn3iGJfAgXL8uF-P6qelx9YSAdkG2bEYCaaYy5rdvDl_3'; // Replace with your Discord webhook URL
        $keycode = $_POST['keycode'];

        // Save the generated keycode on the server (you can use a database for more permanent storage)
        file_put_contents('generated_keycode.txt', $keycode);

        // Send the generated keycode to the receiver's PHP
        $receiverUrl = 'https://example.com/receiver.php'; // Replace 'https://example.com/receiver.php' with the actual URL of the receiver's PHP file
        $postData = array('keycode' => $keycode);
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($postData)
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($receiverUrl, false, $context);

        if ($result === false) {
            echo 'Failed to send the keycode to the receiver.';
        } else {
            echo 'Keycode sent to the receiver successfully.';
        }

        // Send the generated keycode to Discord using a webhook
        $discordData = array(
            'content' => 'Generated Keycode: ' . $keycode
        );

        $discordOptions = array(
            'http' => array(
                'header' => "Content-Type: application/json\r\n",
                'method' => 'POST',
                'content' => json_encode($discordData)
            )
        );

        $discordContext = stream_context_create($discordOptions);
        $discordResult = file_get_contents($discordWebhookUrl, false, $discordContext);

        if ($discordResult === false) {
            echo 'Failed to send the keycode to Discord.';
        } else {
            echo 'Keycode sent to Discord successfully.';
        }
        exit(); // Terminate PHP script execution after sending the response to the AJAX request
    }
}
?>
