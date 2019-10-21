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
                case 'fullMode':
                    fullMode();
                    break;
                case 'defaultMode':
                    defaultMode();
                    break;
                case 'SEMode':
                    SEMode();
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


    function fullMode() {
        $seg = $_POST['seg'];
        $seg_list = Jieba::cut($seg, true);
        echo json_encode($seg_list);
    }

    function defaultMode() {
        $seg = $_POST['seg'];
        $seg_list = Jieba::cut($seg, false);
        echo json_encode($seg_list);
    }

    function SEMode() {
        $seg = $_POST['seg'];
        $seg_list = Jieba::cutForSearch($seg);
        echo json_encode($seg_list);
    }

?>



