<?php

class Instrument extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'instruments';

	/**
	 * TestType relationship
	 */
	public function testTypes()
	{
	  return $this->belongsToMany('TestType', 'instrument_testtypes');
	}

	/**
	 * Set compatible specimen types
	 *
	 * @return void
	 */
	public function setTestTypes($testTypes){

		$testTypesAdded = array();
		$instrumentID = (int)$this->id;	

		if(is_array($testTypes)){
			foreach ($testTypes as $key => $value) {
				$testTypesAdded[] = array(
					'instrument_id' => $instrumentID,
					'test_type_id' => (int)$value
					);
			}
		}

		// Delete existing instrument test_type mappings
		DB::table('instrument_testtypes')->where('instrument_id', '=', $instrumentID)->delete();

		// Add the new mapping
		DB::table('instrument_testtypes')->insert($testTypesAdded);
	}

}