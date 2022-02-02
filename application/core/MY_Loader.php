<?php
class MY_Loader extends CI_Loader {
    public function template($template_name, $vars = array(), $return = FALSE)
    {

        if($return):
            $content  = $this->view('include/header', $vars, $return);
            $content .= $this->view('client/'.$template_name, $vars, $return);
            $content .= $this->view('include/footer', $vars, $return);

            return $content;
        else:
             $this->view('include/header', $vars);
             $this->view('include/footer', $vars);

        endif;
    }

    public function template_admin($template_name, $vars = array(), $return = FALSE)
    {

        if($return):
            $content  = $this->view('include/header_admin', $vars, $return);
            $content .= $this->view('admin/'.$template_name, $vars, $return);
            $content .= $this->view('include/footer_admin', $vars, $return);

            return $content;
        else:
             $this->view('include/header_admin', $vars);
             $this->view('auth/'.$template_name, $vars);
             $this->view('include/footer_admin', $vars);

        endif;
    }


}

?>
