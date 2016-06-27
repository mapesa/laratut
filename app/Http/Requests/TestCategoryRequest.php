<?php namespace App\Http\Requests;
use App\Http\Requests\Request;
use App\Models\TestCategory;
class TestCategoryRequest extends Request {
	/**
	* Determine if the user is authorized to make this request.
	*
	* @return bool
	*/
	public function authorize() {
		return true;
	}
	/**
	* Get the validation rules that apply to the request.
	*
	* @return array
	*/
	public function rules() {
		$id = $this->ingnoreId();
		return [ 'name' => 'required|unique:test_categories,name,'.$id, ];
	}
	/**
	* @return \Illuminate\Routing\Route|null|string
	*/
	public function ingnoreId(){
		$id = $this->route('testcategory');
		$name = $this->input('name');
		return TestCategory::where(compact('id', 'name'))->exists() ? $id : '';
	}
}
