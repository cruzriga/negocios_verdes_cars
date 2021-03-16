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

            unset($value->idcategoria);
            unset($value->idsubcategoria);
            unset($value->idtiposubcategoria);

            $empresas[$key]->categoria = $categoria;
            $empresas[$key]->subcategoria = $subcategoria;
            $empresas[$key]->tiposubcategoria = $tiposubcategoria;
            $empresas[$key]->productos = $productos;
        }
        $app->enqueueMessage("Enqueued notice", "notice");
        $app->enqueueMessage("Enqueued warning", "warning");
        try 
        {   
            echo new JResponseJson($empresas);
        }
        catch (Exception $e)
        {
            echo new JResponseJson($e);
        }
    }
}