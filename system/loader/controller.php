<?php
    require_once(DOCUMENT_ROOT.'system/lib/vendor/autoload.php');
    // require_once('form.php');
    use Spipu\Html2Pdf\Html2Pdf;
    class Controller{
        public function view($path='',$data=array()){
            $absolute_path = '';
            $absolute_path = BASE_CATALOG.'view/'.THEME.'/'.$path.'.php';
            if(file_exists($absolute_path)){
                extract($data);
                $common_path = BASE_CATALOG.'controller/common.php';
                require_once($common_path);
                 $arr_bypass = array('common/header','common/footer');
                if(!in_array($path,$arr_bypass)){
                    $common = new CommonController();
                    // $data_header = array(
                    //     'title' => (isset($title)?$title:WEB_NAME),
                    //     'class_body' => (isset($class_body)?$class_body:'')
                    // );
                    $common->header($data);
                    require_once($absolute_path);
                    $common->footer($data);
                }
            }else{
                echo 'File view/'.$absolute_path.' Not found!';
                exit();
            }
        }
        public function render($path='',$data=array()){
            // $absolute_path = '';
            // if(!check_admin_path()){
            //     $absolute_path = BASE_CATALOG.'view/'.THEME.'/'.$path.'.php';
            // }else{
            //     $absolute_path = BASE_CATALOG_ADMIN.'view/'.THEME.'/'.$path.'.php';
            // }
            // if(file_exists($absolute_path)){
                $absolute_path = '';
                $absolute_path = BASE_CATALOG.'view/'.THEME.'/'.$path.'.php';
                if(file_exists($absolute_path)){
                    extract($data);
                    require_once($absolute_path);
                }
                // if($path!="common/header" or $path!="common/footer"){
               
                //     if(!check_admin_path()){
                //         $common_path = BASE_CATALOG.'controller/common.php';
                //     }else{
                //         $common_path = BASE_CATALOG_ADMIN.'controller/common.php';
                //     }
                //     require_once($common_path);
                //  $arr_bypass = array('common/header','common/footer');
                // if(in_array($path,$arr_bypass)){
                //     $common = new CommonController();
                //     $common->header();
                //     require_once($absolute_path);
                //     $common->footer();
                // }
            // }else{
            //     echo 'File view/'.$absolute_path.' Not found!';
            //     exit();
            // }
        }
        public function model($path){
            // echo BASE.'system/db/'.DB.".php";exit();
            $base_path = str_replace('admin', '', BASE.'system/db/'.DB.".php");
            require_once($base_path);
            $absolute_path = BASE_CATALOG.'model/'.$path.'.php';
            require_once($absolute_path);
            $string_model = ucfirst(strtolower($path))."Model";
            $model = new $string_model();
            return $model;
        }
        public function json($data){
            header("Content-type:application/json");
            echo json_encode($data);
        }
        public function xml($data){
            header('Content-Type: application/xml; charset=utf-8');
            echo $data;
        }
        public function redirect($route){
            header('location: index.php?route='.$route);
        }
        public function setTitle(){
            
        }
        public function setSession($key,$data){
            $result = true;
            if(!empty($data)){
                // if(isset($_SESSION[$key])){
                    $_SESSION[$key] = $data;
                // }
            }

            return $result;
        }
        public function getSession($key){
            return (isset($_SESSION[$key])?$_SESSION[$key]:'');
        }
        public function pdf($html){
            ob_end_clean();
            $html2pdf = new Html2Pdf();
            $html2pdf->setDefaultFont("thsarabunb");
            $html2pdf->writeHTML($html);
            $html2pdf->output();
        }
        public function downloadPdf($html,$data=array()){
            $result = array();
            $file_name = $data['file_name'];
            $path = $data['path'];
            $result['size'] = 0;
            $result['path_file'] = $data['path'];
            // echo $path;exit();
            // echo $data['path'].'<';exit();
            // echo $html;exit();
            ob_end_clean();
            $html2pdf = new Html2Pdf();
            $html2pdf->setDefaultFont("thsarabunb");
            $html2pdf->writeHTML($html);
            $html2pdf->output($path,'F');

            // echo $data['path'];exit();
            
            if (file_exists($data['path'])) {
                $result['size'] = filesize($data['path']);
            }
            return $result;
        }
    }