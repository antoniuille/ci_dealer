<?php 

 if(isset($_POST['submit']) && !empty($_POST['vin'])){

    require realpath($_SERVER['DOCUMENT_ROOT']).'/dealer/vendor/autoload.php';

    define('API_BASE_URL', 'https://vindecoder.p.mashape.com/v1.1/decode_vin');
    define('API_KEY', 'Q3AxAsAX5DmshZNcer08RigRZvMpp1iJzczjsnN7bQCzpbJc3E');


    $headers = [
        'accept' => 'application/json',
        'X-Mashape-Key' => API_KEY,
        'fmt' => "json"
    ];
    $query = [
        'vin' => $_POST['vin']
    ];

    $response = Unirest\Request::get(API_BASE_URL, $headers, $query);

    $res_body = $response->body;

    if (isset($res_body->success) && $res_body->success) {
        echo "Vin: " . $_POST['vin'] . "<br>";
        echo "Make: " . $res_body->specification->make . "<br>";
        echo "Model: " . $res_body->specification->model . "<br>";
    }
    else if (isset($res_body->message)) {
        echo "Error: " . $res_body->message . "<br>";
    }
    else
        echo "Failed to decode vin." . "<br>";

}
?>
<form style="padding-bottom: 20px;" method="POST">
    Vin Lookup: <input type="text" name="vin">
    <input type="submit" name="submit" value="Submit">
</form>  