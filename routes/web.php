<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('auth.login');
//    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix' => 'auth', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {

    //  Privillege Route

    Route::get('privillege/index',['as'=>'privillege/index','uses' => 'PrivillegeController@index']);
    Route::post('privillege/grant',['as'=>'privillege/grant','uses' => 'PrivillegeController@grant']);

    route::get('password/reset',['as'=>'password/reset','uses' => 'ResetPasswordController@showResetForm']);




});



Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    //  Department Route

    Route::get('department/index',['as'=>'department/index','uses' => 'DepartmentController@index']);
    Route::post('department/index',['as'=>'department/postindex','uses' => 'DepartmentController@create']);


    // Doctor Administration Route


    Route::get('doctor/index',['as'=>'doctor/index','uses' => 'DoctorController@index']);
    Route::post('doctor/index',['as'=>'doctor/postindex','uses' => 'DoctorController@create']);

});




Route::group(['prefix' => '', 'namespace' => 'Prescription', 'middleware' => ['auth']], function () {

    //  Appointment Route

    Route::get('appointment/index',['as'=>'appointment/index','uses' => 'AppointmentController@index']);
    Route::post('appointment/index',['as'=>'appointment/postindex','uses' => 'AppointmentController@create']);

    Route::get('appointment/tabledata',['as'=>'appointment/tabledata','uses' => 'AppointmentController@tabledata']);

//    Route::get('appointment/registration/index',['as'=>'appointment/registration/index','uses' => 'AppointmentController@appFromRegistration']);
    Route::get('appointment/getregdata/{id}',['as'=>'appointment/getregdata','uses' => 'AppointmentController@getRegData']);



    // appointment from registration no
    Route::post('appointment/registration/save',['as'=>'appointment/reg/save','uses' => 'AppointmentController@appFromRegistration']);



    // Update Appointment Patients Name


    Route::post('appointment/patient/update',['as'=>'appointment/patient/update','uses' => 'AppointmentController@updatePatient']);



    //Prescription Route

    Route::get('appointment/create/{id}',['as'=>'appointment/create/{id}','uses' => 'PrescriptionController@index']);


    Route::post('prescription/general',['as'=>'prescription/general','uses' => 'PrescriptionController@generalInfo']);
    Route::post('medicine',['as'=>'medicine','uses' => 'PrescriptionController@medicineInfo']);
    Route::post('appointment/create/medicine',['as'=>'medicine','uses' => 'PrescriptionController@medicineInfo']);

    Route::post('diagnosis',['as'=>'diagnosis','uses' => 'PrescriptionController@diagnosisInfo']);
    Route::post('appointment/create/diagnosis',['as'=>'diagnosis','uses' => 'PrescriptionController@diagnosisInfo']);

    //Same Route for below two due to different redirection of datatables

    Route::get('appointment/create/medicineddvicetable/{id}',['as'=>'medicineddvicetable','uses' => 'PrescriptionController@medicineAdviceTable']);
    Route::get('medicineddvicetable/{id}',['as'=>'medicineddvicetable','uses' => 'PrescriptionController@medicineAdviceTable']);

    Route::get('appointment/create/diagnosisadvicetable/{id}',['as'=>'diagnosisadvicetable','uses' => 'PrescriptionController@diagnosisAdviceTable']);
    Route::get('diagnosisadvicetable/{id}',['as'=>'diagnosisadvicetable','uses' => 'PrescriptionController@diagnosisAdviceTable']);

    Route::post('appointment/create/advices/savedata',['as'=>'advices/savedata','uses' => 'PrescriptionController@saveAdviceData']);
    Route::post('advices/savedata',['as'=>'advices/savedata','uses' => 'PrescriptionController@saveAdviceData']);


    Route::post('appointment/create/investigation/savedata',['as'=>'investigation/savedata','uses' => 'PrescriptionController@saveInvestigationData']);
    Route::post('investigation/savedata',['as'=>'investigation/savedata','uses' => 'PrescriptionController@saveInvestigationData']);



    //pHOTO  UPDATE ROUTE

    Route::post('photo/update',['as'=>'photo/update','uses' => 'PrescriptionController@photoupdate']);



//    Route for extra dose

    Route::post('appointment/create/medicine/extradose',['as'=>'medicine/extradose','uses' => 'PrescriptionController@saveextradose']);
    Route::post('medicine/extradose',['as'=>'medicine/extradose','uses' => 'PrescriptionController@saveextradose']);




    Route::delete('appointment/create/delete/{id}',['as'=>'medicine/delete','uses' => 'PrescriptionController@medicineDelete']);
    Route::delete('delete/{id}',['as'=>'medicine/delete','uses' => 'PrescriptionController@medicineDelete']);

    Route::delete('appointment/create/deleteDiagnosis/{id}',['as'=>'diagnosis/deleteDiagnosis','uses' => 'PrescriptionController@diagnosisDelete']);
    Route::delete('deleteDiagnosis/{id}',['as'=>'diagnosis/deleteDiagnosis','uses' => 'PrescriptionController@diagnosisDelete']);


    Route::get('prescription/print/{id}',['as'=>'prescription/print','uses' => 'PrescriptionController@printPrescription']);
    Route::get('prescription/preview/{id}',['as'=>'prescription/preview','uses' => 'PrescriptionController@presPreview']);

// Patient History Route

    Route::post('appointment/create/history/createdata',['as'=>'history/createdata','uses' => 'PrescriptionController@createHistory']);
    Route::post('history/createdata',['as'=>'history/createdata','uses' => 'PrescriptionController@createHistory']);

    Route::get('appointment/create/history/viewdata/{id}',['as'=>'history/viewdata','uses' => 'PrescriptionController@viewHistory']);
    Route::get('history/viewdata/{id}',['as'=>'history/viewdata','uses' => 'PrescriptionController@viewHistory']);



//    Get existing General Advice  to show

    Route::get('appointment/create/generaladvice/getdata/{id}',['as'=>'generaladvice/getdata','uses' => 'PrescriptionController@getGeneralAdviceData']);
    Route::get('generaladvice/getdata/{id}',['as'=>'generaladvice/getdata','uses' => 'PrescriptionController@getGeneralAdviceData']);


//    Template Routing


    Route::get('template/index',['as'=>'template/index','uses' => 'PersonalisationController@index']);
    Route::post('template/save',['as'=>'appointment/save','uses' => 'PersonalisationController@create']);

    Route::get('template/tabledata',['as'=>'template/tabledata','uses' => 'PersonalisationController@getTableData']);


    Route::post('medicine/new/save',['as'=>'medicine/new/save','uses' => 'PrescriptionController@createNewMedicine']);
    Route::post('appointment/create/medicine/new/save',['as'=>'medicine/new/save','uses' => 'PrescriptionController@createNewMedicine']);

    Route::post('generic/new/save',['as'=>'generic/new/save','uses' => 'PrescriptionController@createNewGeneric']);
    Route::post('appointment/create/generic/new/save',['as'=>'generic/new/save','uses' => 'PrescriptionController@createNewGeneric']);


    Route::delete('template/delete/{id}',['as'=>'template/delete','uses' => 'PersonalisationController@destroy']);




    // Route for new General Advice

    Route::get('appointment/create/generaladvicestable/{id}',['as'=>'generaladvicestable','uses' => 'PrescriptionController@generalAdvicesTable']);
    Route::get('generaladvicestable/{id}',['as'=>'generaladvicestable','uses' => 'PrescriptionController@generalAdvicesTable']);

    Route::delete('appointment/create/deleteGAdvices/{id}',['as'=>'advices/deleteGAdvices','uses' => 'PrescriptionController@advicesDelete']);
    Route::delete('deleteGAdvices/{id}',['as'=>'advices/deleteGAdvices','uses' => 'PrescriptionController@advicesDelete']);

    Route::post('ngadvices',['as'=>'advices/ngadvices','uses' => 'PrescriptionController@singleAdvicesSave']);
    Route::post('appointment/create/ngadvices',['as'=>'advices/ngadvices','uses' => 'PrescriptionController@singleAdvicesSave']);



    //ROUTE FOR COPY PREVIOUS PRESCRIPTION ADVICES

    Route::post('copy/previous/save',['as'=>'copy/previous/save','uses' => 'PrescriptionController@copyPrevious']);
    Route::post('appointment/create/copy/previous/save',['as'=>'appointment/create/copy/previous/save','uses' => 'PrescriptionController@copyPrevious']);







});





Route::group(['prefix' => 'settings', 'namespace' => 'Basics', 'middleware' => ['auth']], function () {

    //  Generic Route

    Route::get('generic/index',['as'=>'generic/index','uses' => 'GenericsController@index']);
    Route::post('generic/postindex',['as'=>'generic/postindex','uses' => 'GenericsController@create']);

    Route::post('generic/update',['as'=>'generic/update','uses' => 'GenericsController@update']);

    Route::get('generic/genericsTabledata',['as'=>'generic/genericsTabledata','uses' => 'GenericsController@genericTableData']);



    Route::get('approve',['as'=>'generic/approve','uses' => 'GenericsController@index']);



    // Manufacturere Route

    Route::get('manufacturer/index',['as'=>'manufacturer/index','uses' => 'ManufacturerController@index']);
    Route::post('manufacturer/postindex',['as'=>'manufacturer/postindex','uses' => 'ManufacturerController@create']);
    Route::get('manufacturer/manufacturerTabledata',['as'=>'manufacturer/manufacturerTabledata','uses' => 'ManufacturerController@manufacturerTabledata']);
    Route::post('manufacturer/update',['as'=>'manufacturer/update','uses' => 'ManufacturerController@update']);
//    Medicine Type Route

    Route::get('medicineType/index',['as'=>'medicineType/index','uses' => 'MedicineTypeController@index']);
    Route::post('medicineType/index',['as'=>'medicineType/postindex','uses' => 'MedicineTypeController@create']);

    Route::get('medicineType/mtypeTabledata',['as'=>'medicineType/mtypeTabledata','uses' => 'MedicineTypeController@mtypesTableData']);



    //    Strength Route

    Route::get('strength/index',['as'=>'strength/index','uses' => 'StrengthController@index']);
    Route::post('strength/index',['as'=>'strength/postindex','uses' => 'StrengthController@create']);


//    Medicine Route

    Route::get('medicine/index',['as'=>'medicine/index','uses' => 'MedicineController@index']);
    Route::post('medicine/index',['as'=>'medicine/postindex','uses' => 'MedicineController@create']);

    //    Diagnosis Route

    Route::get('investigation/index',['as'=>'investigation/index','uses' => 'DiagnosisController@index']);
    Route::post('investigation/create',['as'=>'investigation/create','uses' => 'DiagnosisController@create']);
    Route::post('investigation/update',['as'=>'investigation/update','uses' => 'DiagnosisController@update']);

    Route::get('investigation/investigationsTabledata','DiagnosisController@tableData');

});




Route::group(['prefix' => 'autocomplete', 'namespace' => 'Common', 'middleware' => ['auth']], function () {

    //  Medicine for Prescription Route

    Route::get('medicine',['as'=>'autocomplete/medicine','uses' => 'Autocompletes@autocompleteMedicine']);
    Route::get('diagnosis',['as'=>'autocomplete/diagnosis','uses' => 'Autocompletes@autocompleteDiagnosis']);
    Route::get('generics',['as'=>'autocomplete/generics','uses' => 'Autocompletes@autocompleteGenerics']);
    Route::get('doctors',['as'=>'autocomplete/doctors','uses' => 'Autocompletes@doctors']);



});

Route::get('template/autocomplete/item/{id}',['as'=>'autocomplete/item/{id}','uses' => 'Common\Autocompletes@templateItems']);


// Previous Prescription Routes

Route::group(['prefix' => 'previous', 'namespace' => 'Prescription', 'middleware' => ['auth']], function () {

    //  Medicine for Prescription Route

    Route::get('index',['as'=>'previous/index','uses' => 'PreviousController@index']);
    Route::get('previousdata',['as'=>'previous/previousdata','uses' => 'PreviousController@previousTable']);

    Route::post('previousdetails/{id}',['as'=>'previous/previousdetails','uses' => 'PreviousController@previousDetailsData']);

    Route::get('previousprint/{id}',['as'=>'previous/previousprint','uses' => 'PreviousController@previousPrint']);



});


Route::group(['prefix' => 'investigation', 'namespace' => 'Investigation', 'middleware' => ['auth']], function () {

    //  Medicine for Prescription Route

    Route::get('viewIndex',['as'=>'investigation/viewIndex','uses' => 'ViewInvestigationController@index']);
    Route::get('viewResult/{id}',['as'=>'investigation/viewResult','uses' => 'ViewInvestigationController@viewResult']);
    Route::get('viewResultByIP',['as'=>'investigation/viewResultByIP','uses' => 'ViewInvestigationController@viewResultByIP']);


    Route::get('SummaryReport',['as'=>'investigation/SummaryReport','uses' => 'ViewInvestigationController@summary']);

//    Route::post('previousdetails/{id}',['as'=>'previous/previousdetails','uses' => 'PreviousController@previousDetailsData']);

//    Route::get('previousprint/{id}',['as'=>'previous/previousprint','uses' => 'PreviousController@previousPrint']);



});

Route::get('report/makeIndex',['as'=>'report/makeIndex','uses' => 'Common\MisReportController@index']);