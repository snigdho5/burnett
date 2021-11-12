<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Shiprocket_Access extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('common_my_model');
        $this->load->library('email');
    }

    public function index()
    {
    }

    public function onCheckPincode()
    {
        //snigdho
        if ($this->input->is_ajax_request() && $this->input->server('REQUEST_METHOD') == 'POST') {

            $pincode = xss_clean($this->input->post('user_pincode'));
            // $pickup_pincode = xss_clean($this->input->post('pickup_pin'));
            $product_id = xss_clean($this->input->post('productid'));
            $product_name = xss_clean($this->input->post('product_nm'));
            $cod = xss_clean($this->input->post('cod_val'));
            $weight = xss_clean($this->input->post('weight'));

            if ($pincode != '') {
                // invoke shiprocket api
                $cod = ($cod != '')?$cod:0;

                $postData = array(
                    'pickup_postcode' => SHIPROCKET_PICKUP_PIN,
                    'delivery_postcode' => $pincode,
                    'cod' => $cod,
                    'weight' => $weight//gms
                );

                $shipState = $this->shiprocket->serviceability($postData);

                // print_obj($shipState);die;

                //log pincode data
                $ip = $this->input->ip_address();
                $addData = array(
                    'pickup_postcode' => '700001',
                    'delivery_postcode' => $pincode,
                    'cod' => $cod,
                    'weight' => $weight,
                    'product_id' => $product_id,
                    'product_name' => $product_name,
                    'created_at' => DTIME,
                    'ip' => $ip
                );
                $addedLog = $this->shipm->addPincodeLog($addData);

                if (!empty($shipState) && $shipState['status'] == 200) {

                    $availableCourierCompanies = $shipState['data']['available_courier_companies'];

                    if (!empty($availableCourierCompanies)) {
                        $count_couriers = count($availableCourierCompanies);
                        $html = '<option value="">Select</option>';
                        foreach ($availableCourierCompanies as $key => $value) {
                            $html .= '<option value="'.$value['courier_company_id'].'" data-rate="'.$value['rate'].'">'.$value['courier_name'].' [ETA: '.$value['etd'].', Rs.: '.$value['rate'].']</option>';
                        }
                        // print_obj($availableCourierCompanies);die;
                        $return['couriers_count'] = $count_couriers;
                        $return['courier_options'] = $html;
                    }


                    $return['success'] = '1';
                    $return['message'] = 'Delivery is available for ' . $pincode;
                } else {
                    $return['success'] = '0';
                    $return['message'] = 'Delivery is not yet available for ' . $pincode . '!';
                }
            } else {
                $return['success'] = '0';
                $return['message'] = '';
            }
        } else {
            $return['redirect'] = base_url();
        }

        header('Content-Type: application/json');
        echo json_encode($return);
    }
}
