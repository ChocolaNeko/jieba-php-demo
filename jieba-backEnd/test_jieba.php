<?php 
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: *');
    header('Access-Control-Allow-Headers: *');
    date_default_timezone_set('Asia/Taipei');
    
    
    ini_set('memory_limit', '1024M');
    
    require_once "src/vendor/multi-array/MultiArray.php";
    require_once "src/vendor/multi-array/Factory/MultiArrayFactory.php";
    require_once "src/class/Jieba.php";
    require_once "src/class/Finalseg.php";

    use Fukuball\Jieba\Jieba;
    use Fukuball\Jieba\Finalseg;

    Jieba::init();
    Finalseg::init();

    $method = $_SERVER['REQUEST_METHOD'];
    $url = explode('/', rtrim($_GET['url'], '/'));

    switch ($method) {
        case 'POST':
            switch ($url[0]) {
                case 'sendMsg':
                    startSeg();
                    break;
                default:
                    echo 'POST ERROR';
            }
            break;
        case 'GET':
            echo 'GET SUCCESS';
            break;
        default:
            echo 'ERROR';
    }


    function startSeg() {
        $seg = $_POST['seg'];
        $seg_list = Jieba::cut($seg);
        echo json_encode($seg_list);
    }
    // $seg_list = Jieba::cut("在新伺服器詳細資料表單中填寫下列資訊");
    // var_dump($seg_list);

?>



