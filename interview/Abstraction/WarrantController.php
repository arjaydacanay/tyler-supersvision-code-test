<?php

namespace Interview\Abstraction;

class WarrantController
{

    /**
     * Returns a response object with a successful result
     *
     * Create a new class (PSR-4 auto loading is already configured in composer) that implements the
     * Response interface, and return an instance of that class. It should produce a 200 response
     * code, and provides a JSON encoded message that should have the following structure:
     *
     * ```json
     * {"success": true, "message": "Warrant created for <individual name>", "issuedBy": "<judge name>"}
     * ```
     *
     * Both the individual and judge names should be in the format "<last name>, <first name>".
     * This method receives a request object containing a json payload with the following structure:
     *
     * ```json
     * {
     *  "Event": {
     *     "EventType": "Warrant",
     *     "Individual": {
     *       "IndividualId": <number>,
     *       "FirstName": <name>,
     *       "LastName": <name>
     *     },
     *     "Judge": {
     *       "JudgeId": <number>,
     *       "FirstName": <name>,
     *       "LastName": <name>
     *     },
     *     "Court": {
     *       "Address": <address>
     *     },
     *     "Offenses": [
     *        {"Code": <code>},
     *        ...
     *     ]
     *   }
     * }
     * ```
     *
     * This should also validate that we have an IndividualId, JudgeId, and at least one offense. If it
     * is missing any of these, we should instead get a 422 response code. Also, if the method of the
     * request is not a POST, we want to send a 405 response code.
     *
     * @param Request $request
     * @return Response
     */
    public function createWarrant(Request $request)
    {
         $result=$this->conditionResponse($request);
         $warrantResponse = new WarrantResponse($result["method"], $result["body"]);
         return $warrantResponse;
    }

    /**
     *
     * conditionResponse method check the Request body and Request method
     * 
     *  @param Request $request
     * @return Array
     */
    public function conditionResponse(Request $request){

        $data = json_decode($request->getPayload(), true);
        $message = "Warrant created for " . $data["Event"]["Individual"]["LastName"] . ", " . $data["Event"]["Individual"]["FirstName"];
        $issuedBy = $data["Event"]["Judge"]["LastName"] . ", " . $data["Event"]["Judge"]["FirstName"];
        $responseBody=["success"=> true,"message"=> $message, "issuedBy"=>$issuedBy];
       
        if($request->getMethod()!='POST'){
            $responseBody["success"]=false;$responseBody["message"]=null;$responseBody["issuedBy"]=null;
            return ["method"=>405, "body"=>json_encode($responseBody)];
        }

        if(!$this->checkArrays("IndividualId",$data)|| 
            !$this->checkArrays("JudgeId",$data) || 
            !$this->checkArrays("Offenses",$data)){
             $responseBody["success"]=false;$responseBody["message"]=null;$responseBody["issuedBy"]=null;
            return ["method"=>422, "body"=>json_encode($responseBody)];
        }

        return ["method"=>200, "body"=>json_encode($responseBody)];
    }


    /** 
     * 
     * checkArrays method check if the array key exist has a null value
     * 
     * @param string $key
     * @param Array $array
     * @return boolean
     **/ 
    function checkArrays($key, array $array): bool
    {
        if (array_key_exists($key, $array) &&  ($array[$key]!=null) ) {
            return true;
        } else {
            foreach ($array as $nested) {
                if (is_array($nested) && $this->checkArrays($key, $nested))
                    return true;
            }
        }
        return false;
    }

    
}