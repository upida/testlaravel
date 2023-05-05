<?php

$json = '{"custom":[{"type":"parent","id":1},{"type":"children","id":2,"data":"Hallo I\'m Apple","parent_id":1},{"type":"parent","id":3},{"type":"children","id":4,"data":"Hallo \'m Orange","parent_id":3},{"type":"children","id":5,"data":"Hallo I\'m Banana","parent_id":3},{"type":"children","id":6,"data":"Hallo I\'m Human","parent_id":null}]}';
$array = json_decode($json, true);

$array = array_reduce($array['custom'], function ($newdata, $data) {
    if ($data['type'] == 'parent') {
        $newdata['custom'][] = $data;
        return $newdata;
    } else {
        $id = array_search($data['parent_id'], array_column($newdata['custom'], 'id'));
        if (is_int($id)) $newdata['custom'][$id]['data'][] = $data;
        else $newdata['custom'][] = $data;
        return $newdata;
    }
}, ["custom" => []]);

echo json_encode($array);