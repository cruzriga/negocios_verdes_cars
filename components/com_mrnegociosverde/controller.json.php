<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
/**
 * Hello World Component Controller
 *
 * @since  0.0.1
 */
class MrNegociosVerdeController extends JControllerLegacy {
    public function divide2($a, $b)  
    {
        if ($b == 0)
        {
            throw new Exception('Division by zero!');
        }
        return $a/$b;
    }
    public function divide()
    {        
        $app = JFactory::getApplication();  
        $input = $app->input;
        // $input = JFactory::getApplication()->input;
		// $mapbounds = $input->get('mapBounds', array(), 'ARRAY');
        $x = $input->get("x", 0, "float");
        $y = $input->get("y", 0, "float");
        $app->enqueueMessage("Enqueued notice", "notice");
        $app->enqueueMessage("Enqueued warning", "warning");
        try 
        {   
            $result = $this->divide2($x, $y);
            echo new JResponseJson($result, "It worked!");
        }
        catch (Exception $e)
        {
            echo new JResponseJson($e);
        }
    }
    public function categorias(Type $var = null)
    {
        $model= $this->getModel('mrnegociosverde');//on echo-prints class name of model
        $categorias= $model->getCategorias();
        $subcategorias= $model->getSubCategorias();
        $tiposubcategorias= $model->getTipoSubCategorias();

        $item = new stdClass();
        $item->categorias = $categorias;
        $item->subcategorias = $subcategorias;
        $item->tiposubcategorias = $tiposubcategorias;
        
        $app = JFactory::getApplication();
        $app->setHeader('Content-Type', 'application/json; charset=utf-8');
        $data = new stdClass();
        echo json_encode($item);
    }
    public function uploadimg(Type $var = null)
    {
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
        $path = 'media/uploads/'; // upload directory        
        if(true){
        $img = $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];
        // get uploaded file's extension
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        // can upload same image using rand function
        $final_image = rand(1000,1000000).$img;
        // check's valid format
            if(in_array($ext, $valid_extensions)){ 
                $path = $path.strtolower($final_image);
                if(move_uploaded_file($tmp,$path)){
                    // print_r($path);
                    // print_r($_POST);
                    // echo "<img src='$path' />";die;
                    echo $path;
                }
            }else{
                echo 'invalid';
            }
        }
    }
    public function uploaddoc(Type $var = null)
    {
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' ,'docx' , 'ppt','xlsx'); // valid extensions
        $path = 'media/uploads/doc/'; // upload directory
        if(true){
        $img = $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];
        // get uploaded file's extension
        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        // can upload same image using rand function
        $final_image = rand(1000,1000000).$img;
        // check's valid format
            if(in_array($ext, $valid_extensions)){ 
                $path = $path.strtolower($final_image);
                if(move_uploaded_file($tmp,$path)){
                    echo $path;
                }
            }else{
                echo 'invalid';
            }
        }
    }
    public function savedatosempresa()
    {
        $app = JFactory::getApplication();
        $rawDataPost = $app->input->getArray($_POST);
        $Itemid = json_decode($rawDataPost['json']);
        $db = JFactory::getDBO();
        $result = $db->insertObject('#__negocios_v_empresas', $Itemid);
        $ultimoid = $db->insertid();
        echo ($ultimoid);
    }
    public function addproductos(Type $var = null)
    {
        $app = JFactory::getApplication();
        $rawDataPost = $app->input->getArray($_POST);
        $Itemid = json_decode($rawDataPost['json']);
        $db = JFactory::getDBO();
        foreach ($Itemid as $key => $value) {
            $result = $db->insertObject('#__negocios_v_productos', $value);            
        }
        echo ($ultimoid);
    }
    public function adddocumentos(Type $var = null)
    {
        $app = JFactory::getApplication();
        $rawDataPost = $app->input->getArray($_POST);
        $Itemid = json_decode($rawDataPost['json']);
        $db = JFactory::getDBO();
        foreach ($Itemid as $key => $value) {
            $result = $db->insertObject('#__negocios_v_documentos', $value);            
        }
        echo ($ultimoid);
    }
}