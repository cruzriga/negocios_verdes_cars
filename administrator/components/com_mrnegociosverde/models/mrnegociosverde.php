<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * mrnegociosverde Model
 *
 * @since  0.0.1
 */
class MrNegociosVerdeModelMrNegociosVerde extends JModelItem
{
	/**
	 * @var object item
	 */
	protected $item;

	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return	void
	 * @since	2.5
	 */
	protected function populateState()
	{
		// Get the message id
		$jinput = JFactory::getApplication()->input;
		$id     = $jinput->get('id', 1, 'INT');
		$this->setState('message.id', $id);

		// Load the parameters.
		$this->setState('params', JFactory::getApplication()->getParams());
		parent::populateState();
	}

	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable  A JTable object
	 *
	 * @since   1.6
	 */
	public function getTable($type = 'mrnegociosverde', $prefix = 'mrnegociosverdeTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

    public function getProductos($idempresa = null)
    {
        $db = JFactory::getDbo(); 
        $query = $db->getQuery(true);
        $query->select('*')
            ->from($db->quoteName('#__negocios_v_productos','p'))
            ->where($db->quoteName('p.activo') . ' = ' . $db->quote('1'))
            ->order('p.nombre DESC')
        ;
        if ($idempresa!=null) {
            $query->where($db->quoteName('p.idempresa') . ' = ' . $db->quote($idempresa));
        }
        // print_r($query);
        $db->setQuery($query); 
        $rows = $db->loadObjectList();
        if ($rows) {
            foreach ($rows as $row) {
                $main[] = $row;            
            }
            return $main;
        }
        return false;
    }

    public function getCategorias( $idcategoria = null)
	{
		# code...
		// $categorias = new stdClass();
		
		$db = JFactory::getDbo(); 
        $query = $db->getQuery(true);
		$query
            ->select('*')
            ->from($db->quoteName('#__negocios_v_categorias','c'))
            // ->group($db->quoteName('c.idcategoria'))
            ->order('c.nombre DESC')
        ;
        if ($idcategoria!=null) {
            $query->where($db->quoteName('c.idcategoria') . ' = ' . $db->quote($idcategoria));
        }
		$db->setQuery($query); 
        $rows = $db->loadObjectList();		
		if ($rows) {
            return $rows;
        }
        return false;
	}

	public function getSubCategorias($idcategoria = null,$idsubcategoria = null)
	{
		# code...
		$categorias = new stdClass();
		
		$db = JFactory::getDbo(); 
        $query = $db->getQuery(true);
		$query
            ->select('*')
            ->from($db->quoteName('#__negocios_v_sub_categorias','sc'))
            // ->group($db->quoteName('sc.idsubcategoria'))
            ->order('sc.nombre DESC')
        ;
        if ($idcategoria!=null) {
            $query->where($db->quoteName('sc.idcategoria') . ' = ' . $db->quote($idcategoria));
        }
        if ($idsubcategoria!=null) {
            $query->where($db->quoteName('sc.idsubcategoria') . ' = ' . $db->quote($idsubcategoria));
        }

		$db->setQuery($query); 
        $rows = $db->loadObjectList();				
		
		if ($rows) {
            return $rows;
        }
        return false;
	}

	public function getTipoSubCategorias($idsubcategoria = null,$idtiposubcategoria = null)
	{		
		$db = JFactory::getDbo(); 
        $query = $db->getQuery(true);
		$query
            ->select('*')
            ->from($db->quoteName('#__negocios_v_tipo_sub_categorias','tsc'))
            // ->group($db->quoteName('a.idtiposubcategoria'))
            ->order('tsc.nombre DESC')
        ;
        if ($idsubcategoria!=null) {
            $query->where($db->quoteName('tsc.idsubcategoria') . ' = ' . $db->quote($idsubcategoria));
        }
        if ($idtiposubcategoria!=null) {
            $query->where($db->quoteName('tsc.idtiposubcategoria') . ' = ' . $db->quote($idtiposubcategoria));
        }
		$db->setQuery($query); 
        $rows = $db->loadObjectList();		
		
		if ($rows) {
            return $rows;
        }
        return false;
	}
    public function getDocumentos($idempresa = null)
	{		
		$db = JFactory::getDbo(); 
        $query = $db->getQuery(true);
		$query
            ->select('*')
            ->from($db->quoteName('#__negocios_v_documentos','d'))
            // ->group($db->quoteName('a.idtiposubcategoria'))
            // ->order('d.nombre DESC')
        ;
        if ($idempresa!=null) {
            $query->where($db->quoteName('d.idempresa') . ' = ' . $db->quote($idempresa));
        }
		$db->setQuery($query); 
        $rows = $db->loadObjectList();		
		
		if ($rows) {
            return $rows;
        }
        return false;
	}

    public function getEmpresas() {
        $db = JFactory::getDbo(); 
        $query = $db->getQuery(true);
        // $query->select('e.idempresa, e.nombreempresa, e.representantelegal, e.descripcion, e.telefono, e.direccion, e.municipio, e.email, e.twitter, e.facebook, e.instagram, e.linkvideo, e.imagenlogo')
        $query->select('*')
            ->from($db->quoteName('#__negocios_v_empresas','e'))
            // ->where($db->quoteName('e.activo') . ' = ' . $db->quote('1'))
            // ->group($db->quoteName('a.idempresa'))
            ->order('e.nombreempresa DESC')
        ;

        $db->setQuery($query); 
        $rows = $db->loadObjectList();
        if ($rows) {
            foreach ($rows as $row) {
                $main[] = $row;            
            }
            return $main;
        }
        return false;
    }
}