
<?php
if (isset($_GET['url'])){
    $URL = $_GET['url'];
    $JsonContent = json_decode(file_get_contents("https://igdl.club/api/media?q=".$URL));
    $arr = $JsonContent->medias[0]->items;
    foreach($arr as $item){
        Download_file($item);
    }
}

function Download_file($data){
    $formated = "";
    switch ($data->content_type) {
        case 'image/jpeg':
            $formated = "jpg";
            break;

        case 'video/mp4':
            $formated = "mp4";
            break;

        default:
            echo "Lost Support Format";
            break;
        
    }

    $results = [
        'start_code'=>http_response_code(),
        'api_name'=>'Insta Dowloader',
        'file_format'=>$formated,
        data=> $data
    ];

    header("Content-Type: application/json");

    echo json_encode($results);

}
?>