<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff_login extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('staff_model');
        $this->load->model('authentication_model');
        $this->load->model('staff_login/staff_login_model');
    }

    public function index()
    {
        if (!staff_can('view', 'staff_login')) {
            access_denied('staff_login');
        }

        $data['title'] = _l('staff_login');
        $data['staff_members'] = $this->staff_model->get('', ['active' => 1]);
        
        $this->load->view('staff_login/staff_login', $data);
    }

    public function login_as()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        
        // Check permissions first
        if (!staff_can('login_as', 'staff_login')) {
            ajax_access_denied('staff_login');
        }

        $staff_id = $this->input->post('staff_id');
        
        if ($staff_id) {
            // Prevent self-login
            if ($staff_id === get_staff_user_id()) {
                echo json_encode([
                    'success' => false,
                    'message' => _l('cannot_login_as_self')
                ]);
                die;
            }

            $staff = $this->staff_model->get($staff_id);
            if ($staff && $staff->active == 1) {
                if ($staff->admin == 1 && !is_admin()) {
                    log_activity('Failed login attempt as admin by staff ID: ' . get_staff_user_id());
                    echo json_encode([
                        'success' => false,
                        'message' => _l('access_denied')
                    ]);
                    die;
                }

                // Preserve important session data
                $important_data = [
                    'original_staff_id' => get_staff_user_id(),
                    'last_activity' => time(),
                    'impersonation_expires' => time() + (8 * 60 * 60), // Extended to 8 hours
                    'staff_previous_session_data' => $this->session->userdata() // Store previous session data
                ];

                // Regenerate session ID for security
                $this->session->sess_regenerate(true);
                
                // Set new session data
                $this->session->set_userdata([
                    'staff_user_id'   => $staff_id,
                    'staff_logged_in' => true,
                    'session_expires' => time() + (8 * 60 * 60), // 8 hours timeout
                ] + $important_data);

                // Set a longer cookie lifetime
                $this->config->set_item('sess_expiration', 8 * 60 * 60);
                $this->config->set_item('sess_time_to_update', 300); // 5 minutes

                // Log the impersonation activity
                $this->staff_login_model->log_impersonation_activity(
                    $important_data['original_staff_id'], 
                    $staff_id
                );

                echo json_encode([
                    'success' => true,
                    'message' => _l('logged_in_successfully'),
                    'redirect_url' => admin_url()
                ]);
                die;
            }
        }

        echo json_encode([
            'success' => false,
            'message' => _l('invalid_login')
        ]);
        die;
    }

    public function return_to_original()
    {
        $original_staff_id = $this->session->userdata('original_staff_id');
        
        if ($original_staff_id) {
            // Verify the staff member still exists and is active
            $staff = $this->staff_model->get($original_staff_id);
            if (!$staff || $staff->active != 1) {
                set_alert('danger', _l('staff_not_found'));
                redirect(admin_url());
            }

            // Store any important session data we want to keep
            $important_data = [
                'last_staff_id' => $this->session->userdata('staff_user_id'),
                // Add any other session data you need to preserve
            ];

            // Regenerate session ID for security
            $this->session->sess_regenerate(true);
            
            // Set new session data without destroying the session
            $this->session->set_userdata([
                'staff_user_id'   => $original_staff_id,
                'staff_logged_in' => true
            ]);
            
            // Remove the original_staff_id from session
            $this->session->unset_userdata('original_staff_id');

            // Log the return activity
            $this->staff_login_model->log_return_activity($original_staff_id);

            set_alert('success', _l('returned_to_original_account'));
        }
        
        redirect(admin_url());
    }

    // Add a new method to check and extend session
    public function check_session()
    {
        if ($this->input->is_ajax_request()) {
            $session_expires = $this->session->userdata('session_expires');
            $current_time = time();
            
            // If session is about to expire in the next 30 minutes
            if ($session_expires && ($session_expires - $current_time) < (30 * 60)) {
                // Extend session
                $this->session->set_userdata('session_expires', time() + (8 * 60 * 60));
                echo json_encode(['success' => true, 'extended' => true]);
            } else {
                echo json_encode(['success' => true, 'extended' => false]);
            }
        }
    }
} 