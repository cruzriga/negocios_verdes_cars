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
        $empresas= $model->getEmpresas();
        foreach ($empresas as $key => $value) {
            $categoria          = $model->getCategorias($value->idcategoria);
            $subcategoria       = $model->getSubCategorias($value->idcategoria,$value->idsubcategoria);
            $tiposubcategoria   = $model->getTipoSubCategorias($value->idsubcategoria,$value->idtiposubcategoria);
            $productos          = $model->getProductos($value->idempresa);
            $documentos          = $model->getDocumentos($value->idempresa);

            unset($value->idcategoria);
            unset($value->idsubcategoria);
            unset($value->idtiposubcategoria);

            $empresas[$key]->categoria = $categoria[0];
            $empresas[$key]->subcategoria = $subcategoria[0];
            $empresas[$key]->tiposubcategoria = $tiposubcategoria[0];
            $empresas[$key]->productos = $productos;
            $empresas[$key]->documentos = $documentos;
        }
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
}