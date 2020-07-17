<?php
	// This file is part of Moodle - http://moodle.org/
	//
	// Moodle is free software: you can redistribute it and/or modify
	// it under the terms of the GNU General Public License as published by
	// the Free Software Foundation, either version 3 of the License, or
	// (at your option) any later version.
	//
	// Moodle is distributed in the hope that it will be useful,
	// but WITHOUT ANY WARRANTY; without even the implied warranty of
	// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	// GNU General Public License for more details.
	//
	// You should have received a copy of the GNU General Public License
	// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
	
	/**
		* Checkboxs profile field
		*
		* @package   profilefield_checkboxs
		* @copyright  2020 onwards SamyKhalil {@link http://samykhalil.me}
		* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
	*/
	
	/**
		* Class profile_define_checkbox
		* @copyright  2020 onwards SamyKhalil {@link http://samykhalil.me}
		* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
	*/
	class profile_define_checkboxs extends profile_define_base {
		
		/**
			* Add elements for creating/editing a checkboxs profile field.
			*
			* @param moodleform $form
		*/
		public function define_form_specific($form) {
			$form->addElement('textarea', 'param1', get_string('profilecheckedoptions', 'admin'), array('rows' => 6, 'cols' => 40));
			
			$form->setType('param1', PARAM_TEXT);
			// Select whether or not this should be checked by default.
			
			$form->addElement('selectyesno', 'defaultdata', get_string('profiledefaultchecked', 'admin'));
			$form->setDefault('defaultdata', 0); // Defaults to 'no'.
			$form->setType('defaultdata', PARAM_BOOL);
		}
		
		  public function define_validate_specific($data, $files)
    {
        $err = array();

        $data->param1 = str_replace("\r", '', $data->param1);

        /// Check that we have at least 2 options
        if (($options = explode("\n", $data->param1)) === false) {
            $err['param1'] = get_string('profilemenunooptions', 'admin');
        } elseif (count($options) < 2) {
            $err['param1'] = get_string('profilemenutoofewoptions', 'admin');

        /// Check the default data exists in the options
        } elseif (!empty($data->defaultdata) and !in_array($data->defaultdata, $options)) {
            $err['defaultdata'] = get_string('profilemenudefaultnotinoptions', 'admin');
        }

        return $err;
    }
		
		 public function define_save_preprocess($data)
    {
        $data->param1 = str_replace("\r", '', $data->param1);

        return $data;
    }
	
	}
	
	
