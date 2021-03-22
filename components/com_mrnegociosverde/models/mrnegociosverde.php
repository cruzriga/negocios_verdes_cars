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
	public function contarEmpresaQuery(Type $var = null)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select('count(*) as total')
            ->from($db->quoteName('#__negocios_v_empresas','e'))
            ->where($db->quoteName('e.isActivo') . ' = ' . $db->quote('1'))
        ;
        $db->setQuery($query);
        $rows = $db->loadObjectList();
        if ($rows) {
            foreach ($rows as $row) {
                $main[] = $row;            
            }
            return $row;
        }
        return false;
    }

    public function getEmpresas($pagina=0,$limite=15) {
        $app = JFactory::getApplication();
        $db = JFactory::getDbo();
        // $query = $db->getQuery(true);
        
        $limit	= $app->getUserStateFromRequest('global.list.limit', 'limit', $limite, 'int'); //I guess getUserStateFromRequest is for session or different reasons
        $limitstart	= JRequest::getVar('limitstart', $pagina, '', 'int');
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__negocios_v_empresas','e'))
            ->where($db->quoteName('e.isActivo') . ' = ' . $db->quote('1'))
			->where($db->quoteName('e.activo') . ' = ' . $db->quote('1'))
            ->order('e.nombreempresa DESC')
        ;

        $db->setQuery($query,$limitstart, $limit);
        $rows = $db->loadObjectList();
        if ($rows) {
            foreach ($rows as $row) {
                $main[] = $row;            
            }
            return $main;
        }
        return false;
    }

	public function getDocument($idempresa=null,$ref=null) {
        $db = JFactory::getDbo(); 
        $query = $db->getQuery(true);
        $query
            ->select('*')
            ->from($db->quoteName('#__negocios_v_documentos','d'))
            ->group($db->quoteName('d.idempresa'))
            ->order('d.idempresa DESC')
			->where($db->quoteName('d.idempresa') . ' = ' . $db->quote($idempresa))
			->where($db->quoteName('d.ref') . ' = ' . $db->quote($ref))
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
	public function getMapObject($data) {
        // $src = JURI::root() . ($data->image->get('image') ? : '' );
        $item = new stdClass();
        $item->id = $data->idempresa;
        $item->nombre = $data->nombre;
        $item->descripcion = $data->descripcion;
        $item->email = $data->email ;
        $item->geometry = new stdClass();
        $item->geometry->type = 'Point';
        $item->geometry->coordinates = '['.$data->latitude.','.$data->longitude.']';
        return $item;
    }
	public function insertarEmpresa(){
		$profile = new stdClass();
		$profile->user_id = 1001;
		$profile->profile_key='custom.message';
		$profile->profile_value='Inserting a record using insertObject()';
		$profile->ordering=1;
	
		// Insert the object into the user profile table.
		$result = JFactory::getDbo()->insertObject('#__user_profiles', $profile);	
	}
}