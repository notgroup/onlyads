<?php
use App\Models\Content;
use App\Models\LogHistory;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
$router->post('/addContent/{contentTypeId}', 'ContentController@addContent');
$router->post('/setChangeStatus/{contentTypeId}', 'ContentController@setChangeStatus');
$router->post('/addActionLog', 'ContentController@addActionLog');








$router->get('/setAgentStatus', function (Request $request) use ($router) {
    Content::where('entity_type_id', 33)->update(['meta->agentStatus' => 'processless', 'meta->agentNote' => '']);
    return response()->json([]);
});
$router->get('/setShipmentType', function (Request $request) use ($router) {
    Content::where('entity_type_id', 33)->update(['meta->shipment_id' => '10317']);
    return response()->json([]);

});
$router->get('/setCargoDetails', function (Request $request) use ($router) {
    Content::where('entity_type_id', 33)->update(['meta->shipment_id' => '10317']);
    return response()->json([]);

});
$router->get('/getLogHistory/{objectId}', function (Request $request, $objectId) use ($router) {
    $logHistories = LogHistory::where('object_id', $objectId)->groupBy(['subject_id','object_id','log_type','action_type'])->get()->toArray();

    return response()->json($logHistories);

});

