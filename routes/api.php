<?php

use Illuminate\Http\Request;

use Spatie\Analytics\Period;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('store_file','Api\AllController@fileStore');
Route::group(['namespace'=>'Api','middleware' => 'api'],function(){
	Route::post('login','AuthController@login');
	Route::post('upload-image','AllController@uploadImage');
	Route::post('upload-image-multi','AllController@uploadImageMulti');
	
});
Route::group(['namespace'=>'Api','middleware'=>'auth:api'],function(){

	Route::get('/rolee', function () {
		$user = request()->user();
		dd($user->can('view-users'));
		return view('welcome');
	})->middleware('auth');

	Route::post('logout','AuthController@logout'); 
	Route::get('getNotification','NotificationController@get');
	Route::get('profile','AuthController@authentication');
	Route::group(['prefix'=>'menu'],function(){
		Route::get('listMenu','MenuController@listMenu');
		Route::get('getAllMenu','MenuController@getAllMenu');
		Route::post('saveChangeMenu','MenuController@saveChangemenu');
		Route::post('addNewMenu','MenuController@addNewMenu');
		Route::get('getEditMenu/{id}','MenuController@getEditMenu');
		Route::post('saveEditMenuById/{id}','MenuController@saveEditMenuById');
		Route::get('deleteMenuById/{id}','MenuController@deleteMenuById');
	});
	Route::group(['prefix' => 'language'], function () {
		Route::post('detailLanguage', 'LanguageController@detailLanguage')->name('language.detail');
		Route::post('saveLanguage', 'LanguageController@saveLanguage')->name('language.save');
		Route::post('searchLanguage', 'LanguageController@searchLanguage')->name('language.search');
		Route::post('activeLanguage', 'LanguageController@getActiveLanguage')->name('language.active');
		Route::post('saveLanguageStatic', 'LanguageController@saveLanguageStatic')->name('language.saveLanguageStatic');
		Route::post('searchLanguageStatic', 'LanguageController@searchLanguageStatic')->name('language.searchLanguageStatic');
		Route::post('saveLanguageStaticByLang', 'LanguageController@saveLanguageStaticByLang')->name('language.saveLanguageStaticByLang');
		Route::get('deleteLanguage/{code}', 'LanguageController@deleteLanguage')->name('language.delete');
	}); 
	Route::group(['prefix'=>'bill','namespace'=>'Bill'], function(){
		Route::get('list','BillController@list');
		Route::post('add','BillController@add');
		Route::post('draft','BillController@draft');
		Route::get('detail/{code}','BillController@detail');
		Route::post('change-status','BillController@changeStatus');
		Route::get('delete/{code}','BillController@deleteBill');
	});
	Route::group(['prefix'=>'pagecontent'], function(){
		Route::post('add','PageContentController@add');
	});
	Route::group(['prefix'=>'messcontact'], function(){
		Route::post('list','AllController@listMesscontact');
		Route::get('delete/{id}','AllController@deleteMesscontact');
	});
	Route::post('addLibrary','AllController@addLibrary');
	Route::group(['prefix'=>'product', 'namespace'=>'Product'], function(){
		Route::post('create','ProductController@create');
		Route::post('list','ProductController@list');
		Route::get('edit/{id}','ProductController@edit');
		Route::get('delete/{id}','ProductController@delete');
		Route::get('change-combo/{id}','ProductController@changeCombo');
		Route::group(['prefix'=>'category'], function(){
			Route::post('add','CategoryController@add');
			Route::post('list','CategoryController@list');
			Route::get('delete/{id}','CategoryController@delete');
			Route::get('edit/{id}','CategoryController@edit');
		});
		Route::group(['prefix'=>'product_type'], function(){
			Route::post('add','TypeProductController@add');
			Route::post('list','TypeProductController@list');
			Route::get('delete/{id}','TypeProductController@delete');
			Route::get('edit/{id}','TypeProductController@edit');
			Route::get('findCateType/{cate_id}','TypeProductController@findType');
		});
		Route::group(['prefix'=>'type_two'], function(){
			Route::post('add','TypeTwoProductController@add');
			Route::post('list','TypeTwoProductController@list');
			Route::get('delete/{id}','TypeTwoProductController@delete');
			Route::get('edit/{id}','TypeTwoProductController@edit');
			Route::get('findCateType/{cate_id}','TypeTwoProductController@findType');
		});
		Route::group(['prefix'=>'product_brand'], function(){
			Route::post('add','ProductBrandController@add');
			Route::post('list','ProductBrandController@list');
			Route::get('delete/{id}','ProductBrandController@delete');
			Route::get('edit/{id}','ProductBrandController@edit');
		});
		Route::group(['prefix'=>'product_combo'], function(){
			Route::post('add','ProductComboController@add');
			Route::post('list','ProductComboController@list');
			Route::get('delete/{id}','ProductComboController@delete');
			Route::get('edit/{id}','ProductComboController@edit');
		});
	});
	Route::group(['prefix'=>'construction','namspace'=>"Construction"], function(){
		Route::post('list','Construction\ConstructionController@list');
		Route::post('create','Construction\ConstructionController@create');
		Route::get('edit/{id}','Construction\ConstructionController@edit');
		Route::get('listPro','Construction\ConstructionController@listProduct');
	});
	Route::group(['prefix'=>'promotion','namspace'=>"Promotion"], function(){
		Route::post('list','PromotionController@list');
		Route::post('create','PromotionController@create');
		Route::get('edit/{id}','PromotionController@edit');
		Route::get('delete/{id}','PromotionController@delete');
	});
	Route::group(['prefix'=>'service','namspace'=>"service"], function(){
		Route::post('list','ServiceController@list');
		Route::post('create','ServiceController@create');
		Route::get('edit/{id}','ServiceController@edit');
		Route::get('delete/{id}','ServiceController@delete');
	});

		Route::post('listAdsbanner','BannerAdsController@list');
		Route::post('createAdsbanner','BannerAdsController@create');
		Route::get('editAdsbanner/{id}','BannerAdsController@edit');
		Route::get('deleteAdsbanner/{id}','BannerAdsController@delete');

	Route::group(['prefix'=>'reviewCus','namspace'=>"reviewCus"], function(){
		Route::post('list','ReviewCusController@list');
		Route::post('create','ReviewCusController@create');
		Route::get('edit/{id}','ReviewCusController@edit');
		Route::get('delete/{id}','ReviewCusController@delete');
	});
	Route::group(['prefix'=>'blog', 'namespace'=>'Blog'], function(){
		Route::post('create','BlogController@create');
		Route::post('list','BlogController@list');
		Route::get('edit/{id}','BlogController@edit');
		Route::get('delete/{id}','BlogController@delete');
		Route::group(['prefix'=>'category'], function(){
			Route::post('add','BlogCategoryController@add');
			Route::post('list','BlogCategoryController@list');
			Route::get('edit/{id}','BlogCategoryController@edit');
			Route::get('delete/{id}','BlogCategoryController@deleteCateBlog');
		});
		Route::group(['prefix'=>'type'], function(){
			Route::post('add','BlogTypegoryController@add');
			Route::post('list','BlogTypegoryController@list');
			Route::get('edit/{id}','BlogTypegoryController@edit');
			Route::get('delete/{id}','BlogTypegoryController@deleteTypeBlog');
			Route::get('findtype/{id}','BlogTypegoryController@findTypeBlog');
		});
	});
	Route::group(['prefix'=>'page_content'], function(){
		Route::post('create','PageContentController@create');
		Route::post('list','PageContentController@list');
		Route::get('edit/{quiz_id}/{language}','PageContentController@edit');
		Route::get('delete/{quiz_id}','PageContentController@deletePageContent');
	});
	Route::group(['prefix'=>'website','namespace'=>'Website'], function(){
		Route::post('banner','BannerController@createOrUpdate');
		Route::get('list-banner','BannerController@list');
		Route::post('partner','PartnerController@createOrUpdate');
		Route::post('prize','PartnerController@createOrUpdatePrize');
		Route::get('list-partner','PartnerController@listPartner');
		Route::get('list-prize','PartnerController@listPrize');
		Route::get('setting','SettingController@setting');
		Route::post('save-setting','SettingController@postsetting');
		Route::post('founder','FounderController@createOrUpdate');
		Route::get('list-founder','FounderController@list');
		Route::post('video','VideoController@createOrUpdateVideo');
		Route::get('list-video','VideoController@listVideo');
	});
	Route::group(['prefix'=>'customer','namespace'=>'Customer'], function(){
		Route::post('list','CustomerController@list');
		Route::post('add','CustomerController@create');
		Route::get('edit/{id}','CustomerController@getEdit');
		Route::post('active','CustomerController@activeCustomer');
		Route::post('changeStatus','CustomerController@changeStatus');
		Route::post('edit-profile','CustomerController@postEdit');
	});
	
	Route::group(['prefix'=>'home'], function(){
		Route::post('chart','HomeController@chart');
		Route::get('analytics',function(){
			$analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));
			$data = [];
			if(count($analyticsData) > 0 ){
				foreach($analyticsData as $item){
					$obj = new \stdClass;
					$obj->label = $item['date']->date;
					$obj->value = $item['pageViews'];
					$data[] = $obj;
				}
			}
			return response()->json([
				'data'=> $data,
				'message' => 'success'
			]);
		});
		Route::post('search_navbar','HomeController@searchNavbar');
	});
});
