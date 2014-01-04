<?php
/*---------------------------------------------------------------
# Package - EXP Framework
# EXP Version 2.0
# ---------------------------------------------------------------
# Author - JoomlaMan http://www.joomlaman.com
# Copyright (C) 2010 - 2012 JoomlaMan.com. All Rights Reserved.
# license - PHP files are licensed under  GNU/GPL V2
# license - CSS  - JS - IMAGE files  are Copyrighted material
# Websites: http://www.JoomlaMan.com
-----------------------------------------------------------------*/
//no direct accees
defined ('_JEXEC') or die('resticted aceess');

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');

class Exp {

	/**
     * Add Body Class
     *
     * @return string
     */
    static function addBodyClass(){
        $app = JFactory::getApplication();
        $menu = $app->getMenu()->getActive();
        $class = '';

        if (is_object($menu)) $class = $menu->params->get('pageclass_sfx');
		$class .= ' '.JRequest::getVar( 'option' );
			
		$class .= ' ' . Exp::megaMenuType();
		
		$menu_active = JFactory::getApplication()->getMenu()->getActive()->id;
		$doc=new JDocumentHTML;
		if($doc->countModules('left'))
			$class .= ' hmleft';
		if($doc->countModules('right'))
			$class .= ' hmright';
		$class .= ' ' .Exp::getParentClass($menu_active);
		
        return $class;
    }
	
	/**
	* Set Menus
	* 
	*/
	public static function megaMenuType() {
		$name = Exp::theme() . '_menu';
		Exp::resetCookie($name);

		$require = JRequest::getVar('menu',  ''  , 'get');
		if( !empty( $require ) ){
			setcookie( $name, $require, time() + 3600, '/');
			$current = $require;
		} 
		elseif( empty( $require ) and  isset( $_COOKIE[$name] )) {
			$current = $_COOKIE[$name];
		} else {
			$current = Exp::Param('menutype');
		}

		return $current;
	}
	
	/**
	* Get or set Template param. If value not setted params get and return, 
	* else set params
	*
	* @param string $name
	* @param mixed $value
	*/
	public static function Param($name=true, $value=NULL)
	{

		// if $name = true, this will return all param data
		if( is_bool($name) and $name==true ){
			return JFactory::getApplication()->getTemplate(true)->params;
		}
		// if $value = null, this will return specific param data
		if( is_null($value) ) return JFactory::getApplication()->getTemplate(true)->params->get($name);
		// if $value not = null, this will set a value in specific name.

		$data = JFactory::getApplication()->getTemplate(true)->params->get($name);

		if( is_null($data) or !isset($data) ){
			JFactory::getApplication()->getTemplate(true)->params->set($name, $value);
			return $value;
		} else {
			return $data;
		}
	}
	
	private static function resetCookie($name)
        {
            if( JRequest::getVar('reset',  ''  , 'get')==1 )
                setcookie( $name, '', time() - 3600, '/');
        }
	
	static function getParentClass($id){
		$class='';
		if($id>0){
			$menu = JFactory::getApplication()->getMenu()->getItem($id);
			if(isset($menu)){
				$params=$menu->params;
				$class=$params->get('class');
				if(isset($menu->parent))
					$class.=' '.Exp::getParentClass($menu->parent);
			}

		}

		return $class;
	}

    /**
     * Get Template name
     *
     * @return string
     */
    public static function themeName()
    {
        //return self::getInstance()->getDocument()->template;
        return JFactory::getApplication()->getTemplate();
    }
	
	/**
        * Get Template name
        * @return string
        */
        public static function theme()
        {
            return Exp::themeName();
        }

    /**
     * Get theme url
     * @return string
     * add new
     */

    public static function getThemeUrl(){
        return Juri::base(true).'/templates/'.Exp::themeName();
    }
}