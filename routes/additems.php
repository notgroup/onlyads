<?php
use App\Models\Content;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
$router->post('/addContent/{contentTypeId}', 'ContentController@addContent');
$router->post('/setChangeStatus/{contentTypeId}', 'ContentController@setChangeStatus');


$router->post('/addlogHistory', function (Request $request) use ($router) {
    $request->merge([
        "subject_id" => $request->user()->id,
        "content"    => json_encode($request->input('content')),
        "created_at" => date('Y-m-d H:i:s'),
    ]);
    DB::table('log_history')->updateOrInsert([
        "subject_id"  => $request->get('subject_id'),
        "object_id"   => $request->get('object_id'),
        "action_type" => $request->get('action_type'),
    ], $request->all());

    return response()->json([]);

});

$router->get('/anlikIslem', function (Request $request) use ($router) {
    Content::where('entity_type_id', 33)->update(['meta->agentStatus' => 'processless', 'meta->agentNote' => null]);

    return response()->json([]);

});
$router->get('/getLogHistory/{objectId}', function (Request $request, $objectId) use ($router) {
    $logHistories = DB::table('log_history')->where('object_id', $objectId)->get()->toArray();
    array_map(function ($item) {
        $item->content            = json_decode($item->content, 1);
        $item->content['manager'] = DB::table('users')->find($item->subject_id)->username;
        return $item;
    }, $logHistories);
    return response()->json($logHistories);

});

