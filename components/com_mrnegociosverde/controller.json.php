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
        // print_r($files);
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
                        $db = JFactory::getDbo();
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
                                $query = $db->getQuery(true);
                                $query = 'UPDATE #__negocios_v_documentos SET urldocumento' . ' = "' .$item->urldocumento.'",'. 'size' . ' ='.$item->size.','. 'name' . ' ="'.$item->name.'",'. 'ext' . ' ="'.$item->ext.'" WHERE idempresa='.$item->idempresa.' and '.'ref="'.$item->ref.'"' ;
                                $db->setQuery( $query );
                                $result = $db->execute();
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
        // $tempData = html_entity_decode($rawDataPost['json']);
        $Itemid = json_decode($rawDataPost['json']);
        $db = JFactory::getDBO();
        if (!empty($Itemid->idempresa) && !empty($Itemid)) {
            $Itemid->idtiposubcategoria = empty($Itemid->idtiposubcategoria)?null:$Itemid->idtiposubcategoria;
            $Itemid->idsubcategoria = empty($Itemid->idsubcategoria)?null:$Itemid->idsubcategoria;
            $updateNulls = true;
            $result = $db->updateObject('#__negocios_v_empresas', $Itemid , 'idempresa', $updateNulls);
        }elseif(!empty($Itemid)){
            $result = $db->insertObject('#__negocios_v_empresas', $Itemid);
            $ultimoid = $db->insertid();
            echo $ultimoid;
        }
        echo false;
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
    function round_up($number, $precision = 0)
    {
        $fig = (int) str_pad('1', $precision, '0');
        return (ceil($number * $fig) / $fig);
    }
    public function getEmpresasSite()
    {
        $app = JFactory::getApplication();

        $model= $this->getModel('mrnegociosverde');
        $input = $app->input;
        $pagina = $input->get("pagina", 0, "int");
        $numList = $input->get("numlist", 15, "int");
        $buscar = $input->get("buscar", '', "string");
        $empresas= $model->getEmpresas($pagina,$numList,$buscar);
        if (empty($empresas)){ echo false;die;}
        foreach ($empresas as $key => $value) {
            $categoria          = $model->getCategorias($value->idcategoria)[0];
            $subcategoria       = [];
            $tiposubcategoria   = [];
            $productos          = $model->getProductos($value->idempresa);
            // $documentos         = $model->getDocumentos($value->idempresa);
            $total              = $model->contarEmpresaQuery();
            
            
            if ($value->idsubcategoria!=null) {
                $subcategoria = $model->getSubCategorias($value->idcategoria,$value->idsubcategoria)[0];
            }
            if ($value->idtiposubcategoria!=null) {
                $tiposubcategoria = $model->getTipoSubCategorias($value->idsubcategoria,$value->idtiposubcategoria)[0];
            }
            unset($value->idcategoria);
            unset($value->idsubcategoria);
            unset($value->idtiposubcategoria);

            $empresas[$key]->categoria = $categoria;
            $empresas[$key]->subcategoria = $subcategoria;
            $empresas[$key]->tiposubcategoria = $tiposubcategoria;
            $empresas[$key]->productos = $productos;
            // $empresas[$key]->documentos = $documentos;
        }
        $app->enqueueMessage("Enqueued notice", "notice");
        $app->enqueueMessage("Enqueued warning", "warning");
        $datos = new \stdClass();
        $datos->total = round($this->round_up($total->total/$numList), 0, PHP_ROUND_HALF_EVEN);
        $datos->pagina = $pagina;
        $datos->numList = $numList;
        $datos->empresas = $empresas;
        try 
        {   
            echo new JResponseJson($datos, "It worked!");
        }
        catch (Exception $e)
        {
            echo new JResponseJson($e);
        }
    }
}