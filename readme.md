# The South Africa Mobile Number Validator
The South Africa Mobile Number Validator checks the correctness a list of mobile numbers or of a single mobile number and it attempt to correct numbers when it is possibile. At the end of the process user can read a report containing:

 - a list of accettable numbers
 - a list of corrected numbers and what was modified
 - a list of incorrect numbers


# Mobile Number Format
South Africa mobile number has the following format:

    (country code)(area code)(mobile number)

 - country code is +27  
 - area code could have from 2 to 5 digits 
 - mobile number is always composed by 7 digits
 
# Area Code 
**06**: Cellular [[6]](https://en.wikipedia.org/wiki/Telephone_numbers_in_South_Africa#cite_note-:0-6)

_0603 - 0605: Cellular: Used by [MTN](https://en.wikipedia.org/wiki/MTN_(South_Africa) "MTN (South Africa)")_

_0606 - 0609_: Cellular: Used by [Vodacom](https://en.wikipedia.org/wiki/Vodacom "Vodacom")

_0610 - 0613_: Cellular: Used by [Cell C](https://en.wikipedia.org/wiki/Cell_C "Cell C")

_0614_: Cellular: Used by [TelkomSA](https://en.wikipedia.org/wiki/Telkom_(South_Africa) "Telkom (South Africa)") (8.ta)

_0615 - 0619_: Cellular: Used by [Cell C](https://en.wikipedia.org/wiki/Cell_C "Cell C")

062 - Cellular: Used by [Cell C](https://en.wikipedia.org/wiki/Cell_C "Cell C")

0630 - 0635: Cellular: Used by [MTN](https://en.wikipedia.org/wiki/MTN_(South_Africa) "MTN (South Africa)")

0636 - 0637: Cellular: Used by [Vodacom](https://en.wikipedia.org/wiki/Vodacom "Vodacom")

_0640_: Cellular: Used by [MTN](https://en.wikipedia.org/wiki/MTN_(South_Africa) "MTN (South Africa)")

_0641 - 0645_: Cellular: Used by [Cell C](https://en.wikipedia.org/wiki/Cell_C "Cell C")

0646 - 0649: Cellular: Used by [Vodacom](https://en.wikipedia.org/wiki/Vodacom "Vodacom")

_0654:_ Cellular: Used by [Lycamobile SA](http://www.lycamobile.co.za/en/) (Cell C entered into an MVNO deal with Lycamobile in August 2017)[[7]](https://en.wikipedia.org/wiki/Telephone_numbers_in_South_Africa#cite_note-7)

_0658 - 0659_: Cellular: Used by [TelkomSA](https://en.wikipedia.org/wiki/Telkom_(South_Africa) "Telkom (South Africa)") (8.ta)

0660 - 0665: Cellular: Used by [Vodacom](https://en.wikipedia.org/wiki/Vodacom "Vodacom")

0670 - 0672: Cellular: Used by [TelkomSA](https://en.wikipedia.org/wiki/Telkom_(South_Africa) "Telkom (South Africa)") [[8]](https://en.wikipedia.org/wiki/Telephone_numbers_in_South_Africa#cite_note-8)

**07**: Cellular

_0710_: Cellular: Used by [MTN](https://en.wikipedia.org/wiki/MTN_(South_Africa) "MTN (South Africa)")

_0711 - 0716_: Cellular: Used by [Vodacom](https://en.wikipedia.org/wiki/Vodacom "Vodacom")

_0717 - 0719_: Cellular: Used by [MTN](https://en.wikipedia.org/wiki/MTN_(South_Africa) "MTN (South Africa)")

_072_: Cellular: Used by [Vodacom](https://en.wikipedia.org/wiki/Vodacom "Vodacom")

_073_: Cellular: Used by [MTN](https://en.wikipedia.org/wiki/MTN_(South_Africa) "MTN (South Africa)")

_074_: Cellular: Used by [Cell C](https://en.wikipedia.org/wiki/Cell_C "Cell C") (Cell C has allocated 0741 to [Virgin Mobile](https://en.wikipedia.org/wiki/Virgin_Mobile_South_Africa "Virgin Mobile South Africa"))

_0741_: Cellular: Used by: [Virgin Mobile](https://en.wikipedia.org/wiki/Virgin_Mobile_South_Africa "Virgin Mobile South Africa") as of June 2006 [[9]](https://en.wikipedia.org/wiki/Telephone_numbers_in_South_Africa#cite_note-9)

_076_: Cellular: Used by [Vodacom](https://en.wikipedia.org/wiki/Vodacom "Vodacom")

_078_: Cellular: Used by [MTN](https://en.wikipedia.org/wiki/MTN_(South_Africa) "MTN (South Africa)")

_079_: Cellular: Used by [Vodacom](https://en.wikipedia.org/wiki/Vodacom "Vodacom")

**08:** Cellular

_0810_: Cellular: Used by [MTN](https://en.wikipedia.org/wiki/MTN_(South_Africa) "MTN (South Africa)")

_0811 - 0815_: Used by [TelkomSA](https://en.wikipedia.org/wiki/Telkom_(South_Africa) "Telkom (South Africa)") (8.ta)

_0816_: WBS Mobile (Vodacom and MTN both have terminated SMS interconnect with WBS so SMS messages to/from this number range are /dev/null'ed)

_0817_: Used by [TelkomSA](https://en.wikipedia.org/wiki/Telkom_(South_Africa) "Telkom (South Africa)") (8.ta)

_0818_: Cellular: Used by [Vodacom](https://en.wikipedia.org/wiki/Vodacom "Vodacom")

_082_: Cellular: Used by [Vodacom](https://en.wikipedia.org/wiki/Vodacom "Vodacom")

_083_: Cellular: Used by [MTN](https://en.wikipedia.org/wiki/MTN_(South_Africa) "MTN (South Africa)")

_083-9_ Cellular rates to Telkom lines, reroutes call to a telkom line and pays number owner for received calls

_084_: Cellular: Used by [Cell C](https://en.wikipedia.org/wiki/Cell_C "Cell C")

**08**: Special services

_080_: _FreeCall_, Toll-free, called party pays

_083-9_ Cellular rates to Telkom lines, reroutes call to a telkom line and pays number owner for received calls

_085_: Cellular: USAL license holders - Vodacom and MTN have some prefixes out of this range for their USAL offerings

## Regular Expression

/\b(27|\+27|)(62|60[3-9]|61[0-9]|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])(\d{7})\b|(27|\+27|)(62|60[3-9]|61[0-3]|615|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])(\d{7})(_DELETED_)\d{1,}|\b(_DELETED_)(27|\+27|)(62|60[3-9]|61[0-3]|615|63[0-7]|64[0-1]|64[6-9]|654|65[8-9]|66[0-5]|67[0-2]|7[2-6]|7[8-9]|71[0-9]|741|80|8[2-9]|81[0-8]|86[0-9]|86[5-6]|8673|8774|8676|8622|86294|867[1-4])(\d{7})\b/m

## Usage
To validate a single mobile number you have just to call 

    FilesController::checkSingleNumber(Request $request)

and pass the variable *number* to the Request ojbect 

To validate all the mobile numbers in a csv file you have just to call 

    FilesController::checkCsvFile($file)

passing the file from the Request object.

## CSV Format
id,phone_number
103343262,6478342944
103426540,84528784843
103278808,263716791426
103426733,27736529279

## Rules for Rejected Numbers

 - Area Code
 - Number Lenght
 - Country Code
 - Duplicated Numbers


## This isn't a completed software, it is just a raw tool 
