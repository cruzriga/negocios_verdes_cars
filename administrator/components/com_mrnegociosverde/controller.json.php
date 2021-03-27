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
    public function getEmpresas()
    {
        $app = JFactory::getApplication();

        $model= $this->getModel('mrnegociosverde');
        $input = $app->input;
        $pagina = $input->get("pagina", 0, "int");
        $numList = $input->get("numlist", 15, "int");
        $buscar = $input->get("buscar", '', "string");
        $empresas= $model->getEmpresas($pagina,$numList,$buscar);
        foreach ($empresas as $key => $value) {
            $categoria          = $model->getCategorias($value->idcategoria)[0];
            $subcategoria       = [];
            $tiposubcategoria   = [];
            $productos          = $model->getProductos($value->idempresa);
            $documentos         = $model->getDocumentos($value->idempresa);
            $imgcarrusel        = $model->getImgCarrusel($value->idempresa);
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
            $empresas[$key]->documentos = $documentos;
            $empresas[$key]->imgcarrusel = $imgcarrusel;
             
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
    function round_up($number, $precision = 0)
    {
        $fig = (int) str_pad('1', $precision, '0');
        return (ceil($number * $fig) / $fig);
    }
    public function updateEstadorEmpresa()
    {        
        $app = JFactory::getApplication(); 
        $model= $this->getModel('mrnegociosverde');
        $rawDataPost = $app->input->getArray($_POST);
        $Itemid = json_decode($rawDataPost['json']);
        $empresas= $model->updateEstadoEmpresa($Itemid);
        $app->enqueueMessage("Enqueued notice", "notice");
        $app->enqueueMessage("Enqueued warning", "warning");
        try 
        {   
            echo new JResponseJson($empresas, "It worked!");
        }
        catch (Exception $e)
        {
            echo new JResponseJson($e);
        }
    }
    public function removeImgCarrusel(Type $var = null)
    {
        $db = JFactory::getDbo();
        $app = JFactory::getApplication(); 
        $rawDataPost = $app->input->getArray($_POST);
        $item = json_decode($rawDataPost['json']);
        
        $query = $db->getQuery(true);

        // Fields to update.
        $fields = array(
            $db->quoteName('activo') . ' = 0'
        );
        $conditions = array(
            $db->quoteName('idempresa') . ' = '.$db->quote($item->idempresa), 
            $db->quoteName('ref') . ' = ' .$db->quote($item->ref)
        );

        $query->update($db->quoteName('#__negocios_v_documentos'))->set($fields)->where($conditions);
        // print_r($query->__toString());
        $db->setQuery($query);

        $result = $db->execute();
    }
}