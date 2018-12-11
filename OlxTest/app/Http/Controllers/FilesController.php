<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Storage;

class FilesController extends Controller
{
    //show upload view
    public function showUploadView()
    {
        return view('files.upload');
    }

    //check single number routine
    public function checkSingleNumber(Request $request)
    {
        //get the number from Request object
        $number=$request["number"];
        //create associative array and get filtered numbers
        $assoc_array = $this->createAssocArray($number);
        $my_numbers=array("valid"=>array(),"fixed"=>array(),"details"=>array());
        $my_numbers=array_merge_recursive($my_numbers,$assoc_array["filtered"]);
        //save numbers that match regular expression to create $rejected_numbers array
        //as array_diff() result
        $numbers_to_delete=array();
        $numbers_to_delete=array_merge($numbers_to_delete,$assoc_array["numbers_to_delete"]);
        $all_numbers[]=$number;
        $rejected_numbers=array_diff($all_numbers,$numbers_to_delete);
        //get the rejected details
        $rejected_details=$this->getRejectedDetails($rejected_numbers);
        //show report
        $this->showCheckAndFixResults($my_numbers,$rejected_details);

    }
    public function getRejectedDetails($rejected_numbers)
    {
      $rejected_details=array("number"=>array(),"details"=>array());

      foreach ($rejected_numbers as $key => $value)
      {

        $details ="";
          //check country code
          $country_code='/^(?!(?:27))\d{2}(\d{2,4})\d{7}|(_DELETED_)(?!(?:27))\d{2,}/m';
          if(preg_match_all($country_code,$value, $matches, PREG_SET_ORDER, 0))
          {
            $details .="|Country Code Error";
          }
          //check area code
          $area_code= '/\b(27|)(62|60[3-9]|61[0-9]|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])\d{7}\b/m';
          $area_code= '/\b(27|)(62|60[3-9]|61[0-9]|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])\d{7}\b|\b(27|)(62|60[3-9]|61[0-9]|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])\d{7}(_DELETED_)|\b(_DELETED_)(27|)(62|60[3-9]|61[0-9]|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])\d{7}/m';
          if(!preg_match_all($area_code,$value, $matches, PREG_SET_ORDER, 0))
          {
            $details .="|Area Code Error";
          }
          //check if mobile number is too long
          $number_lenght='/\b(27|)(62|60[3-9]|61[0-9]|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])\d{8,}$\b|\b(27|)(62|60[3-9]|61[0-3]|615|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])\d{8,}(_DELETED_)(\d{1,})\b|(_DELETED_)(27|)(62|60[3-9]|61[0-3]|615|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])\d{8,}/m';

          if(preg_match_all($number_lenght,$value, $matches, PREG_SET_ORDER, 0))
          {
            $details .="|Mobile number too long";
          }
          //check if mobile number is too short
          $number_lenght='/\b(27|)(62|60[3-9]|61[0-9]|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])\d{1,6}$\b|\b(27|)(62|60[3-9]|61[0-3]|615|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])\d{1,6}(_DELETED_)(\d{1,})\b|(_DELETED_)(27|)(62|60[3-9]|61[0-3]|615|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])\d{1,6}/m';

          if(preg_match_all($number_lenght,$value, $matches, PREG_SET_ORDER, 0))
          {
            $details .="|Mobile number too short";
          }
          //check duplicated numbers
          $expression = '/\b(27|\+27|)(62|60[3-9]|61[0-9]|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])(\d{7})\b|(27|\+27|)(62|60[3-9]|61[0-3]|615|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])(\d{7})(_DELETED_)\d{1,}|\b(_DELETED_)(27|\+27|)(62|60[3-9]|61[0-3]|615|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])(\d{7})\b/m';

          //find matches
          if(preg_match($expression, $value, $matches))
          {
            $details .="|Mobile number already exists";
          }

          $rejected_details=array_merge_recursive($rejected_details,array("number"=>$value,"details"=>$details));
      }
      return $rejected_details;
    }
    public function checkCsvFile($file)
    {
      //check and fix South Africa numbers with country code 27
      $assoc_array = $this->createAssocArray(file_get_contents($file));

      //create an associative array that have 3 keys 'valid' for valid numbers , 'fixed' for fixed numbers
      //and 'details' for fixing details
      $my_numbers=$assoc_array["filtered"];

      //add valid and fixed number to $numbers_to_delete
      $numbers_to_delete=$assoc_array["numbers_to_delete"];

      //get all numbers
      $all_numbers=$this->getAllNumbers($file);

      //create the rejected numbers array
      $rejected_numbers=array_diff($all_numbers,$numbers_to_delete);
      //get reject details
      $rejected_details=$this->getRejectedDetails($rejected_numbers);
      //show report
      $this->showCheckAndFixResults($my_numbers,$rejected_details);
    }

    public function handleUpload(Request $request)
    {

        if($request->hasFile('file'))
        {
          $file=$request->file('file');
          $filename=$file->getClientOriginalName();
          $destinationPath= config('app.fileDestinationPath').'/'.$filename;
          //store file in upload folder
          $uploaded= Storage::put($destinationPath,file_get_contents($file->getRealPath()));

          if($uploaded)
          {
            $this->checkCsvFile($file);
          }
          else
          {
              $this->showUploadView();
          }
        }
    }
    public function createAssocArray($content)
    {
      $filter_result_array=$this->getFilteredNumbers($content);
      $matches=$filter_result_array["matches"];
      $my_numbers=array("valid"=>array(),"fixed"=>array(),"details"=>array());
      $numbers_to_delete=array();
      //iterate in $matches to create valid and fix array and store fix_details
      foreach ($matches as $key => $value)
      {
          $result_array=$this->fixNumber($value);
          if(!in_array($result_array["numbers"],$my_numbers['valid']) && !in_array($result_array["numbers"],$my_numbers["fixed"]))
          {
            if($result_array["fix_details"]=="valid")
            {

              $my_numbers['valid'][]=$result_array["numbers"];
              $numbers_to_delete[]=$value[0];
            }
            else
            {
              $my_numbers['fixed'][]=$result_array["numbers"];
              $my_numbers['details'][]=$result_array["fix_details"];
              $numbers_to_delete[]=$value[0];
            }
          }
      }

      return array("filtered"=>$my_numbers,"numbers_to_delete"=>$numbers_to_delete);
    }
    //method to get all numbers to use it into array_diff() and get the rejected numbers array
    public function getAllNumbers($file)
    {
        $csv_array=file($file->getRealPath());
        $all_numbers=array();

        //store all numbers into array to get the rejected numbers as return of array_diff()
        foreach ($csv_array as $key => $value)
        {
            $tmp=explode(",",$value);
            if($key>0)
            {
              $all_numbers[]=trim($tmp[1]);
            }
        }
        return $all_numbers;
    }

    public function getFilteredNumbers($csv)
    {
          //South Africa Number Format (Country Code)(Area Code) xxx-xxxx
          //country code is +27
          //area code have differents digits depending on location
          //number is always 7 digits
          //Below regular expression for South Africa with country code +27 and its area code

          $expression = '/\b(27|\+27|)(62|60[3-9]|61[0-9]|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])(\d{7})\b|(27|\+27|)(62|60[3-9]|61[0-3]|615|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])(\d{7})(_DELETED_)\d{1,}|\b(_DELETED_)(27|\+27|)(62|60[3-9]|61[0-3]|615|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])(\d{7})\b/m';

          //find matches
          preg_match_all($expression, $csv, $matches, PREG_SET_ORDER, 0);

          return array("matches"=>$matches);

    }
    public function fixNumber($value)
    {
          //inizialize vars
          $country_code="27";
          $fix_details ="";

          //search and fix country code and _DELETED_ key
          if(in_array($country_code,$value))
          {
            if(in_array("_DELETED_",$value))
            {
              //search the valid number in $value[0] and delete all other chars
              $expression= '/\b(27|\+27|)(62|60[3-9]|61[0-9]|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])(\d{7})\b|(27|\+27|)(62|60[3-9]|61[0-3]|615|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])(\d{7})|\b(27|\+27|)(62|60[3-9]|61[0-3]|615|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])(\d{7})\b/m';
              preg_match($expression,$value[0],$matches);
              $fix_details = "Before:$value[0] => After:$matches[0]";
              $numbers=$matches[0];
            }
            else
            {
                $numbers=$value[0];
                $fix_details ="valid";
            }
          }
          else
          {
            if(in_array("_DELETED_",$value))
            {
              //search the valid number in $value[0], adding country code and delete all other chars
              $expression= '/\b(27|\+27|)(62|60[3-9]|61[0-9]|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])(\d{7})\b|(27|\+27|)(62|60[3-9]|61[0-3]|615|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])(\d{7})|\b(27|\+27|)(62|60[3-9]|61[0-3]|615|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])(\d{7})\b/m';
              preg_match($expression,$value[0],$matches);
              $numbers=$country_code.$matches[0];
              $fix_details = "Before:$value[0] => After:$numbers";

            }
            else
            {
              $numbers=$country_code.$value[0];
              $fix_details = "Before:$value[0] => After:$numbers";
            }

          }
          return array("numbers"=>$numbers,"fix_details"=>$fix_details);
    }
    
    public function showCheckAndFixResults($my_numbers,$rejected_numbers)
    {
          //show Acceptable Numbers
          echo "<table border='1'>";
          echo "<tr><th colspan='2'>Acceptable Numbers</th></tr>";
          echo "<th>Num</th><th>Mobile Number</th>";

          foreach ($my_numbers["valid"] as $key => $value)
          {
              echo "<tr>
              <td>$key</td><td>$value</td>
              </tr>";
          }
          echo "</table>";
          echo "<br/><br/><hr><br/><br/>";

          //Show Fixed Numbers and Fixing Details
          echo "<table border='1'>";
          echo "<tr><th colspan='3'>Corrected Numbers</th></tr>";
          echo "<th>Num</th><th>Mobile Corrected Number</th><th>Details</th>";
          foreach($my_numbers["fixed"] as $key =>$value)
          {
              echo "<tr>
              <td>$key</td><td>".$my_numbers["fixed"][$key]."</td><td>".$my_numbers["details"][$key]."</td>
              </tr>";
          }
          echo "</table>";
          echo "<br/><br/><hr><br/><br/>";

          //Show Rejected Numbers and details
          echo "<table border='1'>";
          echo "<tr><th colspan='3'>Rejected Numbers</th></tr>";
          echo "<th>Num</th><th>Mobile Number</th><th>Errors</th>";
          foreach($rejected_numbers["number"] as $key =>$value)
          {
              echo "<tr>
              <td>$key</td><td>".$rejected_numbers["number"][$key]."</td><td>".$rejected_numbers["details"][$key]."</td>
              </tr>";
          }
          echo "</table>";


    }
}
