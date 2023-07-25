<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['keycode'])) {
        $discordWebhookUrl = 'https://discord.com/api/webhooks/1133224788115079168/Aew8Py8biJmtqlCl23e9HDywn3iGJfAgXL8uF-P6qelx9YSAdkG2bEYCaaYy5rdvDl_3';
        $keycode = $_POST['keycode'];

        $data = array(
            'content' => 'Generated Keycode: ' . $keycode
        );

        $options = array(
            'http' => array(
                'header' => "Content-Type: application/json\r\n",
                'method' => 'POST',
                'content' => json_encode($data)
            )
        );

        $context = stream_context_create($options);
        $result = file_get_contents($discordWebhookUrl, false, $context);

        if ($result === false) {
            echo 'Failed to send the keycode to Discord.';
        } else {
            echo 'Keycode sent to Discord successfully.';
        }
        exit(); // Terminate PHP script execution after sending the response to the AJAX request
    }
}
?>
