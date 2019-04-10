<?php
function helper_log($str = ""){
    $CI =& get_instance();

    // paramter
    $param['time'] = date('Y-m-d H:i:s');
    $param['user_id']      = $CI->session->userdata('ses_id');
    $param['action']      = $str;

    //load model log
    $CI->load->model('model_data');

    //save to database
    $CI->model_data->saveLog($param);

}
?>