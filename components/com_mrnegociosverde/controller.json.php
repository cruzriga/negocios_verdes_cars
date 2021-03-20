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
    function incoming_files() {
        $files = $_FILES;
        print_r($files);
        $files2 = [];
        foreach ($files as $input => $infoArr) {
            $filesByInput = [];
            foreach ($infoArr as $key => $valueArr) {
                if (is_array($valueArr)) { // file input "multiple"
                    foreach($valueArr as $i=>$value) {
                        $filesByInput[$i][$key] = $value;
                    }
                }
                else { // -> string, normal file input
                    $filesByInput[] = $infoArr;
                    break;
                }
            }
            $files2 = array_merge($files2,$filesByInput);
        }
        $files3 = [];
        foreach($files2 as $file) { // let's filter empty & errors
            if (!$file['error']) $files3[] = $file;
        }
        return $files3;
    }
    public function uploadFile()
    {
        $app = JFactory::getApplication();  
        $input = $app->input;
        $idempresa = $input->get("idempresa", 0, "int");
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'docx' , 'ppt','xlsx','xls','doc'); // valid extensions
        // $path = 'media/uploads/'; // upload directory      
        $tmpFiles = $this->incoming_files();
        if(!empty($tmpFiles)){
            foreach ($tmpFiles as $key => $value) {                
                $name = explode( ',', $value['name']);
                $tmp = $value['tmp_name'];
                $siz = $value['size'];                
                // get uploaded file's extension
                $ext = strtolower(pathinfo($name[1], PATHINFO_EXTENSION));
                // can upload same image using rand function
                $final_file = $idempresa.'_'.rand(1000,1000000).$name[0].'.'.$ext;
                // check's valid format
                if(in_array($ext, $valid_extensions)){ 
                    $path = $name[0]=='imagenLogo'?'media/uploads/imgLogos/':'media/uploads/doc/';
                    $path = $path.strtolower($final_file);
                    $item = new stdClass();
                    // print_r($path);
                    // print_r($name[0]);
                    if(move_uploaded_file($tmp,$path)){
                        $db = JFactory::getDBO();
                        $updateNulls = true;
                        if ($name[0] == 'imagenLogo') {
                            $item->idempresa = $idempresa;
                            $item->imagenlogo = $path;
                            $result = $db->updateObject('#__negocios_v_empresas', $item , 'idempresa', $updateNulls);
                        }else{
                            $model= $this->getModel('mrnegociosverde');                            
                            $documento= $model->getDocument($idempresa,$name[0]);
                            $item->idempresa = $idempresa;
                            $item->urldocumento = $path;
                            $item->size = $siz;
                            $item->name = $name[1];
                            $item->ext = $ext;
                            $item->ref = $name[0];
                            if (empty($documento)) {
                                $result = $db->insertObject('#__negocios_v_documentos', $item); 
                            }else{
                                $result = $db->updateObject('#__negocios_v_documentos', $item , 'idempresa,ref', $updateNulls);
                            }
                            // print_r($result);
                        }
                        // print_r($item);
                        echo $path;
                    }
                }else{
                    echo 'invalid';
                }
            }
        }
    }
    public function savedatosempresa()
    {
        $app = JFactory::getApplication();
        $rawDataPost = $app->input->getArray($_POST);
        $Itemid = json_decode($rawDataPost['json']);
        $db = JFactory::getDBO();
        // print_r( $Itemid );
        if (!empty($Itemid->idempresa)) {
            $Itemid->idtiposubcategoria = empty($Itemid->idtiposubcategoria)?null:$Itemid->idtiposubcategoria;
            $Itemid->idsubcategoria = empty($Itemid->idsubcategoria)?null:$Itemid->idsubcategoria;
            $updateNulls = true;
            $result = $db->updateObject('#__negocios_v_empresas', $Itemid , 'idempresa', $updateNulls);
        }else{
            $result = $db->insertObject('#__negocios_v_empresas', $Itemid);
            $ultimoid = $db->insertid();
            echo $ultimoid;
        }
    }
    public function addproductos(Type $var = null)
    {
        $app = JFactory::getApplication();
        $rawDataPost = $app->input->getArray($_POST);
        $Itemid = json_decode($rawDataPost['json']);
        $db = JFactory::getDBO();
        $updateNulls = true;
        foreach ($Itemid as $key => $value) {
            $retVal = !empty($value->idproducto)?$db->updateObject('#__negocios_v_productos', $value , 'idproducto', $updateNulls): $db->insertObject('#__negocios_v_productos', $value) ;      
        }
        // echo ($ultimoid);
    }
}