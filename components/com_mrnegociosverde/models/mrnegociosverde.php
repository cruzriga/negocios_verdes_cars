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

	public function getCategorias(Type $var = null)
	{
		# code...
		$categorias = new stdClass();
		
		$db = JFactory::getDbo(); 
        $query = $db->getQuery(true);
		$query
            ->select('*')
            ->from($db->quoteName('#__negocios_v_categorias','a'))
            // ->group($db->quoteName('a.idcategoria'))
            ->order('a.nombre DESC')
        ;
		$db->setQuery($query); 
        $rows = $db->loadObjectList();
		
		if ($rows) {
            return $rows;
        }
        return false;
	}

	public function getSubCategorias(Type $var = null)
	{
		# code...
		$categorias = new stdClass();
		
		$db = JFactory::getDbo(); 
        $query = $db->getQuery(true);
		$query
            ->select('*')
            ->from($db->quoteName('#__negocios_v_sub_categorias','a'))
            // ->group($db->quoteName('a.idsubcategoria'))
            ->order('a.nombre DESC')
        ;
		$db->setQuery($query); 
        $rows = $db->loadObjectList();				
		
		if ($rows) {
            return $rows;
        }
        return false;
	}

	public function getTipoSubCategorias(Type $var = null)
	{		
		$db = JFactory::getDbo(); 
        $query = $db->getQuery(true);
		$query
            ->select('*')
            ->from($db->quoteName('#__negocios_v_tipo_sub_categorias','a'))
            // ->group($db->quoteName('a.idtiposubcategoria'))
            ->order('a.nombre DESC')
        ;
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
        $query
            ->select('*')
            ->from($db->quoteName('#__negocios_v_empresas','a'))
            ->group($db->quoteName('a.idempresa'))
            ->order('a.idempresa DESC')
        ;

        $db->setQuery($query); 
        $rows = $db->loadObjectList();
        if ($rows) {
            foreach ($rows as $row) {
                $main[] = $this->getMapObject($row);            
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