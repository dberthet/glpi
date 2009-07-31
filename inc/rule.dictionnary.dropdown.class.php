<?php
/*
 * @version $Id$
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2009 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 --------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file: Walid Nouh
// Purpose of file:
// ----------------------------------------------------------------------

class RuleDictionnaryDropdown extends RuleCached{

	/**
	 * Constructor
	 * @param $type dropdown type
	**/
	function __construct($type){
		parent::__construct($type);
		$this->can_sort=true;
		$this->right="rule_dictionnary_dropdown";
	}

	function maxActionsCount(){
		return 1;
	}

	function getTitle() {
		global $LANG;
		switch ($this->sub_type){
			case RULE_DICTIONNARY_MANUFACTURER :
				return $LANG['rulesengine'][36];
			break;
			case RULE_DICTIONNARY_MODEL_COMPUTER :
				return $LANG['rulesengine'][50];
			break;
			case RULE_DICTIONNARY_TYPE_COMPUTER :
				return $LANG['rulesengine'][60];
			break;
			case RULE_DICTIONNARY_MODEL_MONITOR :
				return $LANG['rulesengine'][51];
			break;
			case RULE_DICTIONNARY_TYPE_MONITOR :
				return $LANG['rulesengine'][61];
			break;
			case RULE_DICTIONNARY_MODEL_PRINTER :
				return $LANG['rulesengine'][54];
			break;
			case RULE_DICTIONNARY_TYPE_PRINTER :
				return $LANG['rulesengine'][64];
			break;
			case RULE_DICTIONNARY_MODEL_PHONE :
				return $LANG['rulesengine'][52];
			break;
			case RULE_DICTIONNARY_TYPE_PHONE :
				return $LANG['rulesengine'][62];
			break;
			case RULE_DICTIONNARY_MODEL_PERIPHERAL :
				return $LANG['rulesengine'][53];
			break;
			case RULE_DICTIONNARY_TYPE_PERIPHERAL :
				return $LANG['rulesengine'][63];
			break;
			case RULE_DICTIONNARY_MODEL_NETWORKING :
				return $LANG['rulesengine'][55];
			break;
			case RULE_DICTIONNARY_TYPE_NETWORKING :
				return $LANG['rulesengine'][65];
			break;
			case RULE_DICTIONNARY_OS :
				return $LANG['rulesengine'][67];
			break;
			case RULE_DICTIONNARY_OS_SP :
				return $LANG['rulesengine'][68];
			break;
			case RULE_DICTIONNARY_OS_VERSION :
				return $LANG['rulesengine'][69];
			break;
		}
	}

	function showCacheRuleHeader(){
		if (in_array($this->sub_type,array(RULE_DICTIONNARY_MODEL_COMPUTER,
						RULE_DICTIONNARY_MODEL_MONITOR,
						RULE_DICTIONNARY_MODEL_PRINTER,
						RULE_DICTIONNARY_MODEL_PHONE,
						RULE_DICTIONNARY_MODEL_PERIPHERAL,
						RULE_DICTIONNARY_MODEL_NETWORKING,
							))){
			global $LANG;
			echo "<th colspan='3'>".$LANG['rulesengine'][100]." : ".$this->fields["name"]."</th></tr>";
			echo "<tr>";
			echo "<td class='tab_bg_1'>".$LANG['rulesengine'][104]."</td>";
			echo "<td class='tab_bg_1'>".$LANG['common'][5]."</td>";
			echo "<td class='tab_bg_1'>".$LANG['rulesengine'][105]."</td>";
			echo "</tr>";
		} else {
			parent::showCacheRuleHeader();
		}
	}

	function showCacheRuleDetail($fields){
		if (in_array($this->sub_type,array(RULE_DICTIONNARY_MODEL_COMPUTER,
						RULE_DICTIONNARY_MODEL_MONITOR,
						RULE_DICTIONNARY_MODEL_PRINTER,
						RULE_DICTIONNARY_MODEL_PHONE,
						RULE_DICTIONNARY_MODEL_PERIPHERAL,
						RULE_DICTIONNARY_MODEL_NETWORKING,
		))){
			global $LANG;
			echo "<td class='tab_bg_2'>".$fields["old_value"]."</td>";
			echo "<td class='tab_bg_2'>".($fields["manufacturer"]!=''?$fields["manufacturer"]:'')."</td>";		
			echo "<td class='tab_bg_2'>".($fields["new_value"]!=''?$fields["new_value"]:$LANG['rulesengine'][106])."</td>";
		} else {
			parent::showCacheRuleDetail($fields);
		}
	}


}



class DictionnaryDropdownCollection extends RuleCachedCollection{
	/// dropdown table
	var $item_table="";
	

	/**
	 * Constructor
	 * @param $type dropdown type
	**/
	function __construct($type){
		$this->sub_type = $type;
		$this->rule_class_name = 'RuleDictionnaryDropdown';
		$this->right="rule_dictionnary_dropdown";

		switch ($this->sub_type){
			case RULE_DICTIONNARY_MANUFACTURER :
				$this->item_table="glpi_manufacturers";
				//Init cache system values
				$this->initCache("glpi_rulescachemanufacturers");
			break;
			case RULE_DICTIONNARY_MODEL_COMPUTER :
				$this->item_table="glpi_computersmodels";
				//Init cache system values
				$this->initCache("glpi_rulescachecomputersmodels",array("name"=>"old_value","manufacturer"=>"manufacturer"));
			break;
			case RULE_DICTIONNARY_TYPE_COMPUTER :
				$this->item_table="glpi_computerstypes";
				//Init cache system values
				$this->initCache("glpi_rulescachecomputerstypes");
			break;
			case RULE_DICTIONNARY_MODEL_MONITOR :
				$this->item_table="glpi_monitorsmodels";
				//Init cache system values
				$this->initCache("glpi_rulescachemonitorsmodels",array("name"=>"old_value","manufacturer"=>"manufacturer"));
			break;
			case RULE_DICTIONNARY_TYPE_MONITOR :
				$this->item_table="glpi_monitorstypes";
				//Init cache system values
				$this->initCache("glpi_rulescachemonitorstypes");
			break;
			case RULE_DICTIONNARY_MODEL_PRINTER :
				$this->item_table="glpi_printersmodels";
				//Init cache system values
				$this->initCache("glpi_rulescacheprintersmodels",array("name"=>"old_value","manufacturer"=>"manufacturer"));
			break;
			case RULE_DICTIONNARY_TYPE_PRINTER :
				$this->item_table="glpi_printerstypes";
				$this->initCache("glpi_rulescacheprinterstypes");
			break;
			case RULE_DICTIONNARY_MODEL_PHONE :
				$this->item_table="glpi_phonesmodels";
				$this->initCache("glpi_rulescachephonesmodels",array("name"=>"old_value","manufacturer"=>"manufacturer"));
			break;
			case RULE_DICTIONNARY_TYPE_PHONE :
				$this->item_table="glpi_phonestypes";
				$this->initCache("glpi_rulescachephonestypes");
			break;
			case RULE_DICTIONNARY_MODEL_PERIPHERAL :
				$this->item_table="glpi_peripheralsmodels";
				$this->initCache("glpi_rulescacheperipheralsmodels",array("name"=>"old_value","manufacturer"=>"manufacturer"));
			break;
			case RULE_DICTIONNARY_TYPE_PERIPHERAL :
				$this->item_table="glpi_peripheralstypes";
				$this->initCache("glpi_rulescacheperipheralstypes");
			break;
			case RULE_DICTIONNARY_MODEL_NETWORKING :
				$this->item_table="glpi_networkequipmentsmodels";
				$this->initCache("glpi_rulescachenetworkequipmentsmodels",array("name"=>"old_value","manufacturer"=>"manufacturer"));
			break;
			case RULE_DICTIONNARY_TYPE_NETWORKING :
				$this->item_table="glpi_networkequipmentstypess";
				$this->initCache("glpi_rulescachenetworkequipmentstypes");
			break;
			case RULE_DICTIONNARY_OS :
				$this->item_table="glpi_operatingsystems";
				$this->initCache("glpi_rulescacheoperatingsystems");
			break;
			case RULE_DICTIONNARY_OS_SP :
				$this->item_table="glpi_operatingsystemsservicepacks";
				$this->initCache("glpi_rulescacheoperatingsystemsservicepacks");
			break;
			case RULE_DICTIONNARY_OS_VERSION :
				$this->item_table="glpi_operatingsystemsversions";
				$this->initCache("glpi_rulescacheoperatingsystemsversions");
			break;
		}
		

	}

	function getTitle() {
		global $LANG;
		switch ($this->sub_type){
			case RULE_DICTIONNARY_MANUFACTURER :
				return $LANG['rulesengine'][36];
			break;
			case RULE_DICTIONNARY_MODEL_COMPUTER :
				return $LANG['rulesengine'][50];
			break;
			case RULE_DICTIONNARY_TYPE_COMPUTER :
				return $LANG['rulesengine'][60];
			break;
			case RULE_DICTIONNARY_MODEL_MONITOR :
				return $LANG['rulesengine'][51];
			break;
			case RULE_DICTIONNARY_TYPE_MONITOR :
				return $LANG['rulesengine'][61];
			break;
			case RULE_DICTIONNARY_MODEL_PRINTER :
				return $LANG['rulesengine'][54];
			break;
			case RULE_DICTIONNARY_TYPE_PRINTER :
				return $LANG['rulesengine'][64];
			break;
			case RULE_DICTIONNARY_MODEL_PHONE :
				return $LANG['rulesengine'][52];
			break;
			case RULE_DICTIONNARY_TYPE_PHONE :
				return $LANG['rulesengine'][62];
			break;
			case RULE_DICTIONNARY_MODEL_PERIPHERAL :
				return $LANG['rulesengine'][53];
			break;
			case RULE_DICTIONNARY_TYPE_PERIPHERAL :
				return $LANG['rulesengine'][63];
			break;
			case RULE_DICTIONNARY_MODEL_NETWORKING :
				return $LANG['rulesengine'][55];
			break;
			case RULE_DICTIONNARY_TYPE_NETWORKING :
				return $LANG['rulesengine'][65];
			break;
			case RULE_DICTIONNARY_OS :
				return $LANG['rulesengine'][67];
			break;
			case RULE_DICTIONNARY_OS_SP :
				return $LANG['rulesengine'][68];
			break;
			case RULE_DICTIONNARY_OS_VERSION :
				return $LANG['rulesengine'][69];
			break;
		}
	}

	function getRuleClass(){
		return new $this->rule_class_name($this->sub_type);
	}


	/**
	 * Replay collection rules on an existing DB
	 * @param $offset offset used to begin
	 * @param $maxtime maximum time of process (reload at the end)
	 * @return -1 on completion else current offset
	**/
	function replayRulesOnExistingDB($offset=0,$maxtime=0, $items=array(),$params=array()){
		global $DB,$LANG;



		// Model check : need to check using manufacturer extra data so specific function
		if (in_array($this->sub_type,array(RULE_DICTIONNARY_MODEL_COMPUTER,
						RULE_DICTIONNARY_MODEL_MONITOR,
						RULE_DICTIONNARY_MODEL_PRINTER,
						RULE_DICTIONNARY_MODEL_PHONE,
						RULE_DICTIONNARY_MODEL_PERIPHERAL,
						RULE_DICTIONNARY_MODEL_NETWORKING,
		))){
			return $this->replayRulesOnExistingDBForModel($offset,$maxtime);
		}


		if (isCommandLine())
			echo "replayRulesOnExistingDB started : " . date("r") . "\n";

		// Get All items
		$Sql="SELECT * FROM `".$this->item_table."`";
		if ($offset) {
			$Sql .= " LIMIT ".intval($offset).",999999999";
		} 
		
		$result = $DB->query($Sql);

		$nb = $DB->numrows($result)+$offset;
		$i  = $offset;
		if ($result && $nb>$offset) {
			// Step to refresh progressbar
			$step=($nb>20 ? floor($nb/20) : 1);
			$send = array ();
			$send["tablename"] = $this->item_table;
			while ($data = $DB->fetch_array($result)){
				if (!($i % $step)) {
					if (isCommandLine()) {
						echo "replayRulesOnExistingDB : $i/$nb\r";
					} else {
						changeProgressBarPosition($i,$nb,"$i / $nb");
					}
				}

				//Replay Type dictionnary
				$ID=externalImportDropdown($this->item_table,addslashes($data["name"]),-1,array(),addslashes($data["comment"]));
				
				if ($data['ID'] != $ID) {
					$tomove[$data['ID']]=$ID;
					$send["oldID"] = $data['ID'];
					$send["newID"] = $ID;
					replaceDropDropDown($send);
				}		

				$i++;
				if ($maxtime) {
					$crt=explode(" ",microtime());
					if ($crt[0]+$crt[1] > $maxtime) {
						break;
					}
				}
			} // end while 
		}
		
		if (isCommandLine()) {
			echo "replayRulesOnExistingDB ended : " . date("r") . "\n";			
		} else {
			changeProgressBarPosition($i,$nb,"$i / $nb");
		}
		
		return ($i==$nb ? -1 : $i);
	} // function


	/**
	 * Replay collection rules on an existing DB for model dropdowns
	 * @param $offset offset used to begin
	 * @param $maxtime maximum time of process (reload at the end)
	 * @return -1 on completion else current offset
	**/
	function replayRulesOnExistingDBForModel($offset=0,$maxtime=0){
		global $DB,$LANG;


		if (isCommandLine())
			echo "replayRulesOnExistingDB started : " . date("r") . "\n";

		// Model check : need to check using manufacturer extra data

		if (strpos($this->item_table,'models')===false) {
			echo "Error replaying rules";
			return false;
		}
      $model_table=str_replace('models','',$this->item_table);
      $model_field=getForeignKeyFieldForTable($this->item_table);

		// Need to give manufacturer from item table
		$Sql="SELECT DISTINCT glpi_manufacturers.ID AS idmanu, glpi_manufacturers.name AS manufacturer, 
			".$this->item_table.".ID AS ID, `".$this->item_table."`.name AS name, `".$this->item_table."`.comment
			FROM `".$this->item_table."`, $model_table 
			LEFT JOIN glpi_manufacturers ON ($model_table.manufacturers_id=glpi_manufacturers.ID) 
			WHERE $model_table.$model_field=`".$this->item_table."`.ID ";
		if ($offset) {
			$Sql .= " LIMIT ".intval($offset).",999999999";
		} 
		$result = $DB->query($Sql);

		$nb = $DB->numrows($result)+$offset;
		$i  = $offset;
		
		if ($result && $nb>$offset) {
			// Step to refresh progressbar
			$step=($nb>20 ? floor($nb/20) : 1);
			$tocheck=array();
			while ($data = $DB->fetch_array($result)){

				if (!($i % $step)) {
					if (isCommandLine()) {
						echo "replayRulesOnExistingDB : $i/$nb\r";
					} else {
						changeProgressBarPosition($i,$nb,"$i / $nb");
					}
				}
				// Model case
				if (isset($data["manufacturer"])){
					$data["manufacturer"] = processManufacturerName($data["manufacturer"]);
				}

				//Replay Type dictionnary
				$ID=externalImportDropdown($this->item_table,addslashes($data["name"]),-1,$data,addslashes($data["comment"]));

				if ($data['ID'] != $ID) {
					$tocheck[$data["ID"]][]=$ID;
					$sql = "UPDATE $model_table SET model=".$ID." WHERE $model_field=".$data['ID'];
					if (empty($data['idmanu'])){
						$sql .= " AND (manufacturers_id IS NULL OR manufacturers_id = 0)";
					} else {
						$sql .= " AND manufacturers_id='".$data['idmanu']."'";
					}
					
					$DB->query($sql);
				}		

				$i++;
				if ($maxtime) {
					$crt=explode(" ",microtime());
					if ($crt[0]+$crt[1] > $maxtime) {
						break;
					}
				}
			} 

			foreach ($tocheck AS $ID => $tab) 	{
				$sql="SELECT COUNT(*) FROM $model_table WHERE $model_field='$ID'";
				$result = $DB->query($sql);
				$deletecartmodel=false;
				// No item left : delete old item
				if ($result && $DB->result($result,0,0)==0) {
					$Sql = "DELETE FROM `".$this->item_table."` WHERE ID='$ID'";
					$resdel = $DB->query($Sql);
					$deletecartmodel=true;
				} 
				// Manage cartridge assoc Update items
				if ($this->sub_type==RULE_DICTIONNARY_MODEL_PRINTER){
					$sql="SELECT * FROM glpi_cartridges_printersmodels WHERE printersmodels_id = '$ID'";
					if ($result=$DB->query($sql)){
						if ($DB->numrows($result)){	
							// Get compatible cartridge type
							$carttype=array();
							while ($data=$DB->fetch_array($result)){
								$carttype[]=$data['cartridgesitems_id'];
							}
							// Delete cartrodges_assoc
							if ($deletecartmodel){
								$sql="DELETE FROM glpi_cartridges_printersmodels 
									WHERE printersmodels_id = 'ID'";
								$DB->query($sql);
							}
							// Add new assoc
							if (!class_exists('CartridgeType')){
								include_once (GLPI_ROOT . "/inc/cartridge.function.php");
							}
							$ct=new CartridgeType();
							foreach ($carttype as $cartID){
								foreach ($tab as $model){
									$ct->addCompatibleType($cartID,$model);
								}
							}
						}
					}						
				}
	
			} // each tocheck
		}
		if (isCommandLine()) {
			echo "replayRulesOnExistingDB ended : " . date("r") . "\n";			
		} else {
			changeProgressBarPosition($i,$nb,"$i / $nb");
		}
		return ($i==$nb ? -1 : $i);
	}

}	
?>
