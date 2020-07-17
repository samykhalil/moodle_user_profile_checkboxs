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
		* Strings for component 'profilefield_checkboxs', language 'en', branch 'MOODLE_20_STABLE'
		*
		* @package   profilefield_checkboxs
		* @copyright  2020 onwards SamyKhalil {@link http://samykhalil.me}
		* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
	*/
	
	/**
		* Class profile_field_checkbox
		*
		* @copyright  2020 onwards SamyKhalil {@link http://samykhalil.me}
		* @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
	*/
	class profile_field_checkboxs extends profile_field_base {
		
		public $options;
		public $datakey;
		
		
		/**
			* Add elements for editing the profile field value.
			* @param moodleform $mform
		*/
		public function edit_field_add($mform) {
		
			$options = explode("\n", str_replace("\r", "", $this->field->param1));
			$userdata=explode("\n", str_replace("\r", "", $this->data));
			
			foreach ($options as $key => $value) {
				$cbox = &$mform->createElement('advcheckbox',$key, '', $value, array('name' => $key,'group'=>1), $value);
				foreach ($userdata as $checked){
					if ($checked == $value ){
						$cbox->setChecked(true);
						break;
					}
				}
				$typeitem[] = $cbox;
				
				
			}
			$mform->addGroup($typeitem, $this->inputname,$this->field->name);
			
			if ($this->is_required() and !has_capability('moodle/user:update', context_system::instance())) {
				$mform->addRule($this->inputname, get_string('required'), 'required', null, 'client');
			}
		}
		
		public function edit_save_data_preprocess($data, $datarecord)
		{
			
			$string = '';
			if (is_array($data)) {
				foreach ($data as $key => $value) {
					
					$string .= $value."\r\n";
					
				}
				
				return substr($string, 0, -2);
			}
			
			return $string ;
		}
		
		/**
			* Display the data for this field
			*
			* @return string HTML.
		*/
		public function display_data() {
			$userdata=explode("\n", str_replace("\r", "", $this->data));
			$string ='';
			$string .='<ul>';
			foreach($userdata as $line){
				$string .='<li>'.$line.'</li>';
			}
			$string .='</ul>';
			
			return $string;
		}
		
		/**
			* Return the field type and null properties.
			* This will be used for validating the data submitted by a user.
			*
			* @return array the param type and null property
			* @since Moodle 3.2
		*/
		public function get_field_properties() {
			return array(PARAM_BOOL, NULL_NOT_ALLOWED);
		}
		
		
	}
	
	
