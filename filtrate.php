<?php
/**
 * Created by PhpStorm.
 * User: 23670
 * Date: 2018/6/23
 * Time: 10:40
 */
session_start();

if (isset($_POST['valueType'])){
    $_SESSION['valueType'] = $_POST['valueType'];
    switch ($_POST['valueType']){
        case "goodPrice":
            $_SESSION['goodPrice'] = $_POST['value'];
            break;
        case "goodBrand":
            $_SESSION['goodBrand'] = $_POST['value'];
            break;
        case "goodKind":
            $_SESSION['goodKind'] = $_POST['value'];
            break;
        case "goodClearAll":
            $_SESSION['goodPrice'] = "";
            $_SESSION['goodBrand'] = "";
            $_SESSION['goodKind'] = "";
            break;
        case "storeAddress":
            $_SESSION['storeAddress'] = $_POST['value'];
            break;
        case "storeClearAll":
            $_SESSION['storeAddress'] = "";
            break;
        case "employerSalary":
            $_SESSION['employerSalary'] = $_POST['value'];
            break;
        case "employerSex":
            $_SESSION['employerSex'] = $_POST['value'];
            break;
        case "employerStore":
            $_SESSION['employerStore'] = $_POST['value'];
            break;
        case "employerClearAll":
            $_SESSION['employerSalary'] = "";
            $_SESSION['employerSex'] = "";
            $_SESSION['employerStore'] = "";
            break;
        case "sRecordPrice":
            $_SESSION['sRecordPrice'] = $_POST['value'];
            break;
        case "sRecordName":
            $_SESSION['sRecordName'] = $_POST['value'];
            break;
        case "sRecordDate":
            $_SESSION['sRecordDate1'] = $_POST['value1'];
            $_SESSION['sRecordDate2'] = $_POST['value2'];
            break;
        case "sRecordClearAll":
            $_SESSION['sRecordPrice'] = "";
            $_SESSION['sRecordName'] = "";
            $_SESSION['sRecordDate'] = "";
            break;
        case "pRecordPrice":
            $_SESSION['pRecordPrice'] = $_POST['value'];
            break;
        case "pRecordStore":
            $_SESSION['pRecordStore'] = $_POST['value'];
            break;
        case "pRecordAmount":
            $_SESSION['pRecordAmount'] = $_POST['value'];
            break;
        case "pRecordSupplier":
            $_SESSION['pRecordSupplier'] = $_POST['value'];
            break;
        case "pRecordName":
            $_SESSION['pRecordName'] = $_POST['value'];
            break;
        case "pRecordClearAll":
            $_SESSION['sRecordPrice'] = "";
            $_SESSION['sRecordStore'] = "";
            $_SESSION['sRecordAmount'] = "";
            $_SESSION['sRecordSupplier'] = "";
            $_SESSION['sRecordName'] = "";
            break;
    }
}
