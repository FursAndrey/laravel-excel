<?php
if (!function_exists('onFailuresMap')) {
    function onFailuresMap($failures, $fileAttributesRu, $task): array
    {
        $tmp = [];
        foreach($failures as $failure) {
            if ($failure->row() === 1) {
                continue;
            }

            foreach ($failure->errors() as $error) {
                $tmp[] = [
                    'key' => $fileAttributesRu()[$failure->attribute()],
                    'row' => $failure->row(),
                    'message' => str_ireplace($failure->attribute().' ', '', $error),
                    'task_id' => $task->id,
                ];
            }
        }

        return $tmp;
    }
}