<?php
/*
 **************************** Creation Log *******************************
 File Name                   -  UserInfoModel.php
 Project Name                -  Careerbook
 Description                 -  Model Class file for users information
 Version                     -  1.0
 Created by                  -  Prateek Saini
 Created on                  -  March 31, 2013
 ***************************** Update Log ********************************
 Sr.NO.		Version		Updated by           Updated on          Description
 -------------------------------------------------------------------------
 *************************************************************************
 */
require_once 'DbConnectionModelAbstract.php';

class UserInfoModel extends model {
    /************************************************** Start Professional Information Manipulation ************************************/
    public function insertIntoUserProfessional($userInfo) {
        $objProfessionalInfo = $userInfo->getUserProfessionalInfo();
        $user_id = $userInfo->getUserIdInfo();
        $objProfessionalInfo['user_id'] = $user_id['id'];
        $this->db->Fields($objProfessionalInfo);
        $this->db->From("user_professional_info");
        $this->db->Insert();
    }
    public function updateUserProfessional($userInfo) {
        $objProfessionalInfo = $userInfo->getUserProfessionalInfo();
        $user_id = $userInfo->getUserIdInfo();
        $this->db->Fields($objProfessionalInfo);
        $this->db->From("user_professional_info");
        $this->db->Where(array("user_id"=>$user_id['id']));
        $this->db->Update();
    }
    public function fetchUserProfessionalInfo($userInfo){
        $user_id = $userInfo->getUserIdInfo();
        $this->db->From("user_professional_info");
        $this->db->Where(array("user_id"=>$user_id['id']));
        $this->db->Select();
        return $this->db->resultArray();
    }
    /* Start *********************************************** User Previous Job Information Manipulation ************************************/
    public function insertIntoUserPreviousJobInfo($userInfo) {
        $objPreviousJobInfo = $userInfo->getUserPreviousJobInfo();
        $user_id = $userInfo->getUserIdInfo();
        $objPreviousJobInfo['user_id'] = $user_id['id'];
        $this->db->Fields($objPreviousJobInfo);
        $this->db->From("user_previous_job_info");
        $this->db->Insert();
    }
    public function updateUserPreviousJobInfo($userInfo) {
        $objPreviousJobInfo = $userInfo->getUserPreviousJobInfo();
        $user_id = $userInfo->getUserIdInfo();
        $this->db->Fields($objPreviousJobInfo);
        $this->db->From("user_previous_job_info");
        $this->db->Where(array("user_id"=>$user_id['id']));
        $this->db->Update();
    }
    public function fetchUserPreviousJobInfo($userInfo){
        $user_id = $userInfo->getUserIdInfo();
        $this->db->From("user_previous_job_info");
        $this->db->Where(array("user_id"=>$user_id['id']));
        $this->db->Select();
        return $this->db->resultArray();
    }
/* Start *********** user Activity Information Manipulation ********/
    public function insertIntoUserActivityInfo($userInfo) {
        $user_id = $userInfo->getUserIdInfo();
        $objUserActivityInfo['user_id'] = $user_id['id'];
        $this->db->Fields($objUserActivityInfo);
        $this->db->From("user_activity_info");
        $this->db->Insert();
    }
    public function updateUserActivityInfo($userInfo,$date) {
        $objUserActivityInfo = $userInfo->getUserActivityInfo();        
        $user_id = $userInfo->getUserIdInfo();
        $this->db->Fields($objUserActivityInfo);
        $this->db->From("user_activity_info");
        $this->db->Where(array("user_id = $user_id[id] AND login_datetime like '$date%'"),true);
        $this->db->Update();
    }    
    public function fetchUserActivityInfo($userInfo,$date = '',$limit = 1){
        $user_id = $userInfo->getUserIdInfo();
        $this->db->From("user_activity_info");
        if($date == ''){
            $this->db->Where(array("user_id = $user_id[id]"),true);
        }
        else{
            $this->db->Where(array("user_id = $user_id[id] AND login_datetime like '$date%'"),true);
        }
        $this->db->OrderBy("login_datetime desc");
        $this->db->Limit(0,$limit);
        $this->db->Select();
        return $this->db->resultArray();        
    }    
/* Start *********** User Certificate Information Manipulation ********/
    public function insertIntoUserCertificateInfo($userInfo,$certificateCountDB,$certificateCountForm) {
        $objUserCertificateInfo = $userInfo->getUserCertificateInfo();
        $user_id = $userInfo->getUserIdInfo();
        for($i = $certificateCountDB ; $i < $certificateCountForm ; $i++){
        $objUserCertificateInfo[$i]['user_id'] = $user_id['id'];
        $this->db->Fields($objUserCertificateInfo[$i]);
        $this->db->From("user_certification_info");
        $this->db->Insert();
        }
    }
    public function updateUserCertificateInfo($userInfo,$certificateCountDB) {
        $objUserCertificateInfo = $userInfo->getUserCertificateInfo();
        $user_id = $userInfo->getUserIdInfo();
        //	  	print_r($objProfessionalInfo);  // For Testing Display Array Data
        for($i = 0 ; $i < $certificateCountDB ; $i++){            
            $objUserCertificateInfo[$i]['user_id'] = $user_id['id'];
            $this->db->Fields($objUserCertificateInfo[$i]);
            $this->db->From("user_certification_info");
            $this->db->Where(array("user_id"=>$user_id['id'],"id"=>$objUserCertificateInfo[$i]['id']));
            $this->db->Update();
        }
    }
    public function fetchUserCertificateInfo($userInfo){
        $user_id = $userInfo->getUserIdInfo();
        $this->db->From("user_certification_info");
        $this->db->Where(array("user_id = $user_id[id] AND status = 'A'"),true);
        $this->db->Select();
        return $this->db->resultArray();
    }
    public function deleteUserCertificate($userInfo,$certificateID){
        $user_id = $userInfo->getUserIdInfo();
        $user_id = $user_id['id'];
        $this->db->Fields(array("status"=>"D"));
        $this->db->From("user_certification_info");
        $this->db->Where(array("id = " . $certificateID. " AND user_id = ".$user_id),true);
        $this->db->Update();
        return $this->db->lastQuery();
    }
    /* Start *********************************************** Project Information Manipulation ************************************/
    public function fetchUserProjectInfo($userInfo){
        $user_id = $userInfo->getUserIdInfo();
        $this->db->From("user_project_info");
        $this->db->Where(array("user_id = $user_id[id] AND status = 'A'"),true);
        $this->db->Select();
        return $this->db->resultArray();
    }
    public function updateUserProject($userInfo,$projectCountDB){
        $objProjectInfo = $userInfo->getUserProjectInfo();
        $user_id = $userInfo->getUserIdInfo();
        for($i = 0 ; $i < $projectCountDB ; $i++){
            $objProjectInfo[$i]['user_id'] = $user_id['id'];
            $this->db->Fields($objProjectInfo[$i]);
            $this->db->From("user_project_info");
            $this->db->Where(array("user_id"=>$user_id['id'],"id"=>$objProjectInfo[$i]['id']));
            $this->db->Update();
        }
    }
    public function insertIntoUserProject($userInfo,$projectCountDB,$projectCountForm) {
        $objProjectInfo = $userInfo->getUserProjectInfo();
        $user_id = $userInfo->getUserIdInfo();
        for($i = $projectCountDB ; $i < $projectCountForm ; $i++){
            $objProjectInfo[$i]['user_id'] = $user_id['id'];
            $this->db->Fields($objProjectInfo[$i]);
            $this->db->From("user_project_info");
            $this->db->Insert();
        }
    }
    public function deleteUserProject($userInfo,$projectID){
        $user_id = $userInfo->getUserIdInfo();
        $user_id = $user_id['id'];
        $this->db->Fields(array("status"=>"D"));
        $this->db->From("user_project_info");
        $this->db->Where(array("id = " . $projectID. " AND user_id = ".$user_id),true);
        $this->db->Update();
        return $this->db->lastQuery();
    }
    /* Start *********************************************** Extra Curricular Info Information Manipulation ************************************/
    public function fetchUserExtraCurricularInfo($userInfo){
        $user_id = $userInfo->getUserIdInfo();
        $this->db->From("user_extracurricular_info");
        $this->db->Where(array("user_id = $user_id[id] AND status = 'A'"),true);
        $this->db->Select();
        return $this->db->resultArray();
    }
    public function updateUserExtraCurricularInfo($userInfo,$extraCurricularCountDB){
        $objExtraCurricularInfo = $userInfo->getUserExtraCurricularInfo();
        $user_id = $userInfo->getUserIdInfo();
        for($i = 0 ; $i < $extraCurricularCountDB ; $i++){             
            $objExtraCurricularInfo[$i]['user_id'] = $user_id['id'];
            $this->db->Fields($objExtraCurricularInfo[$i]);
            $this->db->From("user_extracurricular_info");
            $this->db->Where(array("user_id"=>$user_id['id'],"id"=>$objExtraCurricularInfo[$i]['id']));
            $this->db->Update();
        }
    }
    public function insertIntoUserExtraCurricularInfo($userInfo,$extraCurricularCountDB,$extraCurricularCountForm) {
        $objExtraCurricularInfo = $userInfo->getUserExtraCurricularInfo();
        $user_id = $userInfo->getUserIdInfo();
        for($i = $extraCurricularCountDB ; $i < $extraCurricularCountForm ; $i++){
            $objExtraCurricularInfo[$i]['user_id'] = $user_id['id'];
            $this->db->Fields($objExtraCurricularInfo[$i]);
            $this->db->From("user_extracurricular_info");
            $this->db->Insert();
        }
    }
    public function deleteUserExtraCurricular($userInfo,$extraCurricularID){
        $user_id = $userInfo->getUserIdInfo();
        $user_id = $user_id['id'];
        $this->db->Fields(array("status"=>"D"));
        $this->db->From("user_extracurricular_info");
        $this->db->Where(array("id = " . $extraCurricularID. " AND user_id = ".$user_id),true);
        $this->db->Update();
        return $this->db->lastQuery();
    }    
    /* Start *********************************************** Address Information Manipulation ************************************/
    public function fetchUserAddressInfo($userInfo){
        $this->db->From("user_personal_info");
        $user_id = $userInfo->getUserIdInfo();
        $this->db->Where(array("user_id"=>$user_id['id']));
        $this->db->Select();
        return $this->db->resultArray();
    }
    public function fetchFullUserAddressInfo($userInfo){
        $this->db->From("user_personal_info upersnli");
        $user_id = $userInfo->getUserIdInfo();
        $this->db->Fields(array('address','cty.name city_name','stt.name state_name','cntry.name country_name','language','nationality'));
        $this->db->Where(array("user_id"=>$user_id['id']));
        $this->db->Join("city cty", "cty.id = upersnli.city_id ", $type="INNER");
        $this->db->Join("state stt", "stt.id = cty.state_id ", $type="INNER");
        $this->db->Join("country cntry", "cntry.id = stt.country_id ", $type="INNER");
        $this->db->Select();
        return $this->db->resultArray();
    }
    public function insertIntoUserAddress($userInfo){
        $objAddressInfo = $userInfo->getUserAddressInfo();
        $user_id = $userInfo->getUserIdInfo();
        $finalInfo = array();
        $finalInfo["user_id"] = $user_id['id'];        
        if(isset($objAddressInfo['city_name'])){
            $city_id = $this->getCityIdInfo($objAddressInfo['city_name']);
            if(!empty($city_id)){
             $finalInfo["city_id"] = $city_id[0]['id'];
            }
        }
        if(isset($objAddressInfo['address'])){
            $finalInfo["address"] = $objAddressInfo['address'];
        }
        if(isset($objAddressInfo['language'])){
            $finalInfo["language"] = $objAddressInfo['language'];
        }
        if(isset($objAddressInfo['nationality'])){
            $finalInfo["nationality"] = $objAddressInfo['nationality'];
        }
        if(isset($finalInfo)){
            $this->db->Fields($finalInfo);
            $this->db->From("user_personal_info");
            $this->db->Insert();
        }
    }
    public function updateUserAddress($userInfo) {
        $objAddressInfo = $userInfo->getUserAddressInfo();
        $city_id = $this->getCityIdInfo($objAddressInfo['city_name']);

        $user_id = $userInfo->getUserIdInfo();
        $finalInfo = array();
        $finalInfo["user_id"] = $user_id['id'];
        
        if(isset($objAddressInfo['city_name'])){
            $city_id = $this->getCityIdInfo($objAddressInfo['city_name']);
            if(!empty($city_id)){
             $finalInfo["city_id"] = $city_id[0]['id'];
            }
        }
        if(isset($objAddressInfo['address'])){
            $finalInfo["address"] = $objAddressInfo['address'];
        }
        if(isset($objAddressInfo['language'])){
            $finalInfo["language"] = $objAddressInfo['language'];
        }
        if(isset($objAddressInfo['nationality'])){
            $finalInfo["nationality"] = $objAddressInfo['nationality'];
        }
        $this->db->Fields($finalInfo);
        $this->db->From("user_personal_info");
        $this->db->Where(array("user_id"=>$user_id['id']));
        $this->db->Update();
    }
    private function getCityIdInfo($cityName){
        $this->db->From("city");
        $this->db->Where(array("name"=>$cityName));
        $this->db->Select();
        return $this->db->resultArray();
    }
    private function getStateIdInfo($stateName){
        $this->db->From("state");
        $this->db->Where(array("name"=>$stateName));
        $this->db->Select();
        return $this->db->resultArray();
    }
    /* Start *********************************************** Academic Information Manipulation ************************************/
    public function fetchUserAcademicInfo($userInfo){
        $this->db->From("user_academic_info");
        $user_id = $userInfo->getUserIdInfo();
        $this->db->Where(array("user_id"=>$user_id['id']));
        $this->db->Select();
        return $this->db->resultArray();
    }
    public function insertIntoUserAcademic($userInfo){
        $objAcademicInfo = $userInfo->getUserAcademicInfo();
        $user_id = $userInfo->getUserIdInfo();
        $objAcademicInfo['user_id'] = $user_id['id'];
        $this->db->Fields($objAcademicInfo);
        $this->db->From("user_academic_info");
        $this->db->Insert();
    }
    public function updateUserAcademic($userInfo) {
        $objAcademicInfo = $userInfo->getUserAcademicInfo();
        $user_id = $userInfo->getUserIdInfo();
        $this->db->Fields($objAcademicInfo);
        $this->db->From("user_academic_info");
        $this->db->Where(array("user_id"=>$user_id['id']));
        $this->db->Update();
    }
    /* Start *********************************************** Personal Information Manipulation ************************************/
    public function fetchUserPersonalInfo($userInfo){
        $this->db->From("users");
        $user_id = $userInfo->getUserIdInfo();
        $this->db->Where(array("id"=>$user_id['id']));
        $this->db->Select();
        return $this->db->resultArray();
    }
    public function updateUserPersonal($userInfo) {
        $objPersonalInfo = $userInfo->getUserPersonalInfo();
        $user_id = $userInfo->getUserIdInfo();

        /******************************************************************/
        //Temporary Soltion : The Query is not executing due to image data.
        unset($objPersonalInfo['profile_image']);
        /******************************************************************/
        //print_r($objPersonalInfo);  // For Testing Display Array Data
        //die;
        $this->db->Fields($objPersonalInfo);
        $this->db->From("users");
        $this->db->Where(array("id"=>$user_id['id']));
        $this->db->Update();
    }
    /* Start *********************************************** User Image Information Manipulation ************************************/
    public function insertIntoUserImage($userInfo){
        $objImageInfo = $userInfo->getImageInfo();
        $user_id = $userInfo->getUserIdInfo();
        $objImageInfo['user_id'] = $user_id['id'];
        $this->db->Fields($objImageInfo);
        $this->db->From("user_personal_info");
        $this->db->Insert() or die(mysql_error());
    }
    public function updateIntoUserImage($userInfo){
        $objImageInfo = $userInfo->getImageInfo();
        $user_id = $userInfo->getUserIdInfo();
        $objImageInfo['profile_image'] = addslashes($objImageInfo['profile_image']);
        $this->db->Fields($objImageInfo);
        $this->db->From("users");
        $this->db->Where(array("id"=>$user_id['id']));
        $this->db->Update();
    }
    /* End *******************************************************************************************/
}