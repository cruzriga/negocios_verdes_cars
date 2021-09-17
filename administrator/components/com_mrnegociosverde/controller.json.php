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

    protected $estados = [
        [
            'id' => 0,
            'label' => 'Preinscrito',
            'color' => 'cyan-4'
        ],
        [
            'id'=> 1,
            'label'=> 'En revision',
            'color'=> 'orange-5'
        ],
        [
            'id'=> 2,
            'label'=> 'Rechazado',
            'color'=> 'deep-orange-5'
        ],
        [
            'id'=> 3,
            'label'=> 'Aceptado',
            'color'=> 'green-5'
        ],
    ];
    
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
    public function getEmpresasAdmin()
    {
        $app = JFactory::getApplication();

        $model= $this->getModel('mrnegociosverde');
        $input = $app->input;
        $rawDataPost = $app->input->getArray($_POST);
        $filtros = json_decode($rawDataPost['filtros']);
        
        $pagina = $input->get("pagina", 0, "int");
        $numList = $input->get("numlist", 50, "int");
        $buscar = $input->get("buscar", '', "string");
        $campo = $input->get("campo", '', "string");
        // print_r($numList);
        $empresas= $model->getEmpresas($pagina,$numList,$buscar,$campo, $filtros);

        if (empty($empresas)){ echo false;die;}
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
    public function updateEstadoInternoEmpresa()
    {
        $app = JFactory::getApplication();
        $model = $this->getModel('mrnegociosverde');
        $rawDataPost = $app->input->getArray($_POST);
        $Itemid = json_decode($rawDataPost['json']);
        $empresas = $model->updateEstadoInternoEmpresa($Itemid);
        $app->enqueueMessage("Enqueued notice", "notice");
        $app->enqueueMessage("Enqueued warning", "warning");
        try {
            echo new JResponseJson($empresas, "It worked!");
        } catch (Exception $e) {
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

    public function downloadEmpresas()
    {
        $app = JFactory::getApplication();

        $model = $this->getModel('mrnegociosverde');
        $input = $app->input;
        $rawDataPost = $app->input->getArray($_POST);
        $filtros = json_decode($rawDataPost['filtros']);
        
        $empresas = $model->getEmpresasToDownload($filtros);

        if (empty($empresas)) {
            echo 'No existen datos para descargar. Por favor, revise los filtros o inicie sesión.';
            die();
        }
        
        foreach ($empresas as $key => $value) {
            $categoria = (object)[
                'idcategoria' => '',
                'nombre' => ''
            ];
            $categoria          = $model->getCategorias($value->idcategoria)[0];
            $subcategoria       = (object)[
                'idsubcategoria' => '',
                'nombre' => ''
            ];
            $tiposubcategoria   = (object)[
                'idtiposubcategoria' => '',
                'nombre' => ''
            ];
            $productos          = $model->getProductos($value->idempresa);
            $documentos         = $model->getDocumentos($value->idempresa);
            $imgcarrusel        = $model->getImgCarrusel($value->idempresa);

            if ($value->idsubcategoria != null) {
                $subcategoria = $model->getSubCategorias($value->idcategoria, $value->idsubcategoria)[0];
            }
            if ($value->idtiposubcategoria != null) {
                $tiposubcategoria = $model->getTipoSubCategorias($value->idsubcategoria, $value->idtiposubcategoria)[0];
            }
            unset($value->idcategoria);
            unset($value->idsubcategoria);
            unset($value->idtiposubcategoria);

            $empresas[$key]->nombrecategoria = $categoria->nombre;
            $empresas[$key]->idcategoria = $categoria->idcategoria;
            $empresas[$key]->idsubcategoria = $subcategoria->idsubcategoria;
            $empresas[$key]->nombresubcategoria = $subcategoria->nombre;
            $empresas[$key]->idtiposubcategoria = $tiposubcategoria->idtiposubcategoria;
            $empresas[$key]->nombretiposubcategoria = $tiposubcategoria->nombre;
            $empresas[$key]->productos = $productos;
            $empresas[$key]->documentos = $documentos;
            $empresas[$key]->imgcarrusel = $imgcarrusel;
        }

        $this->exportToExcel($empresas);
    }

    private function exportToExcel($empresas) {
        $fields = [
            'idempresa' => 'ID de empresa',
            'nombreempresa' => 'Nombre de Empresa',
            'estado' => 'Estado',
            'representantelegal' => 'Representante Legal',
            'descripcion' => 'Descripción',
            'telefono' => 'Teléfono',
            'direccion' => 'Dirección',
            'municipio' => 'Municipio',
            'email' => 'Email',
            'twitter' => 'Twitter',
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'linkvideo' => 'Link Video',
            'imagenlogo' => 'Imágen Logo',
            'nombrecategoria' => 'Categoría',
            'nombresubcategoria' => 'Subcategoría',
            'nombretiposubcategoria' => 'Nombre Tipo subcategoría',
            'cumplimiento' => 'Cumplimiento',
            'adic' => 'Adicional',
            'activo' => 'Activo',
            'isActivo' => 'isActive',
            'fechaCreacion' => 'Fecha de Creación',
        ];

        header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
        header('Content-Disposition: attachment; filename=empresas.xls');

        echo '<html xmlns:x="urn:schemas-microsoft-com:office:excel">
                <head>
                    <!--[if gte mso 9]>
                    <xml>
                        <x:ExcelWorkbook>
                            <x:ExcelWorksheets>
                                <x:ExcelWorksheet>
                                    <x:Name>Sheet 1</x:Name>
                                    <x:WorksheetOptions>
                                        <x:Print>
                                            <x:ValidPrinterInfo/>
                                        </x:Print>
                                    </x:WorksheetOptions>
                                </x:ExcelWorksheet>
                            </x:ExcelWorksheets>
                        </x:ExcelWorkbook>
                    </xml>
                    <![endif]-->
                </head>

                <body>';

        echo '<table border="1" cellpadding="2" cellspacing="0" width="100%">
            <caption>Listado de Empresas</caption>';
        
        echo '<tr>';
        foreach ($fields as $field => $value) {
            echo '<td>' . $value . '</td>';
        }
        echo '</tr>';
        echo "\n";

        foreach ($empresas as $empresa) {
            echo '<tr>';
            echo '<td>' . $empresa->idempresa. '</td>';
            echo '<td>' . $empresa->nombreempresa . '</td>';
            echo '<td>' . $this->estados[$empresa->estado]['label'] . '</td>';
            echo '<td>' . $empresa->representantelegal . '</td>';
            echo '<td>' . $empresa->descripcion . '</td>';
            echo '<td>' . $empresa->telefono . '</td>';
            echo '<td>' . $empresa->direccion . '</td>';
            echo '<td>' . $empresa->municipio . '</td>';
            echo '<td>' . $empresa->email . '</td>';
            echo '<td>' . $empresa->twitter . '</td>';
            echo '<td>' . $empresa->facebook . '</td>';
            echo '<td>' . $empresa->instagram . '</td>';
            echo '<td>' . $empresa->linkvideo . '</td>';
            echo '<td>' . $empresa->imagenlogo . '</td>';
            echo '<td>' . $empresa->nombrecategoria . '</td>';
            echo '<td>' . $empresa->nombresubcategoria . '</td>';
            echo '<td>' . $empresa->nombretiposubcategoria . '</td>';
            echo '<td>' . $empresa->cumplimiento . '</td>';
            echo '<td>' . $empresa->adic . '</td>';
            echo '<td>' . $empresa->activo . '</td>';
            echo '<td>' . $empresa->isActivo . '</td>';
            echo '<td>' . $empresa->fechaCreacion . '</td>';
            echo "</tr>";
            echo "\n";
        }
        
        echo '</table></body></html>';
    }
}