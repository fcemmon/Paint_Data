<?php
class ApiModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->status = 'status';
    }
    
    public function postConnect($request)
    {
        //userName,password,databaseName,hostName
        isBlank($request['databaseName'], NOT_EXISTS, 133);
        
        /*// Create connection
        $mysqli = new mysqli($request['hostname'], $request['username'], $request['password'], $request['databaseName']);
        
        // Check connection
        if ($mysqli -> connect_errno) {
            $mysqli->close();
            generateServerResponse(F, FAIL);
        }
        else
        {
            $mysqli->close();
            generateServerResponse(S, SUCCESS);
        }*/

        $serverName = "172.0.3.210\\sqlexpress, 1433"; //serverName\instanceName, portNumber (default is 1433)
		$connectionInfo = array( "Database"=>$request['databaseName'], "UID"=>$request['username'], "PWD"=>$request['password']);
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		
		if( $conn ) {
		     echo "Connection established.<br />";
		}else{
		     echo "Connection could not be established.<br />";
		     die( print_r( sqlsrv_errors(), true));
		}

        sqlsrv_close($conn);

    }
    
    //Search Data on the basis of RACID,JOB,PRINT NUMBER
    public function postSearchData($request)
    {
        //userName,password,databaseName,hostName
        isBlank($request['databaseName'], NOT_EXISTS, 133);
        
        // Create connection
        // $mysqli = new mysqli($request['hostname'], $request['username'], $request['password'], $request['databaseName']);

        $serverName = "172.0.3.210\\sqlexpress, 1433"; //serverName\instanceName, portNumber (default is 1433)
        $connectionInfo = array( "Database"=>$request['databaseName'], "UID"=>$request['username'], "PWD"=>$request['password']);
        $conn = sqlsrv_connect( $serverName, $connectionInfo);

        $sql = "SELECT * from PaintFirmJobs where RackStyle = '".$request['rackId']."' and JobNum = '".$request['job']."' and PaintMethod = '".$request['paintNumber']."'";

        $stmt = sqlsrv_query($conn, $sql);

        // Check connection
        if ($stmt) {
            echo "Connect Database";
        } else {
            die( print_r( sqlsrv_errors(), true));
            echo "Query is failed";
        }
        // // Check connection
        // if ($mysqli -> connect_errno) {
        //     $mysqli->close();
        //     generateServerResponse(F, FAIL);
        // }
        // else
        // {
        //     $sql = "SELECT * from PaintFirmJobs_TEST where RackStyle = '".$request['rackId']."' and JobNum = '".$request['job']."' and PaintMethod = '".$request['paintNumber']."'";
            
        //     //fetch data as per above query
        //     $rows  = $mysqli->query($sql);
            
        //     // it return number of rows in the table. 
        //     $row = mysqli_num_rows($rows);
            
        //     if($row>0)
        //     {
        //         $i =0;
        //         foreach ($rows as $row)
        //         {
        //             $documents['Company']  = $row['Company'];
        //             $documents['JobNum']  = $row['JobNum'];
        //             $documents['ProdQty']  = $row['ProdQty'];
        //             $documents['PaintMethod']  = $row['PaintMethod'];
        //             $documents['RackStyle']  = $row['RackStyle'];
        //             $documents['VehicleFamily']  = $row['VehicleFamily'];
        //             $documents['PartNum']  = $row['PartNum'];
        //             $documents['PartDescription']  = $row['PartDescription'];
        //             $documents['DueDate']  = $row['DueDate'];
        //             $documents['JobClosed']  = $row['JobClosed'];
        //             $documents['JobComplete']  = $row['JobComplete'];
        //             $documents['DateCreated']  = $row['DateCreated'];
        //             $documents['DateModified']  = $row['DateModified'];
                    
        //             $result['data'][$i] = $documents;
                
        //             $i++;
        //         }
            
        //         $mysqli->close();
        //         generateServerResponse(S, SUCCESS,$result);
        //     }
        //     else
        //     {
        //         generateServerResponse(F, FAIL);
        //     }
            
        //}
    }
}
?>