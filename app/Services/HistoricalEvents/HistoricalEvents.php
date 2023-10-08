<?php

namespace App\Services\HistoricalEvents;
use App\Models\HistoricalEvent as HEM;

abstract class HistoricalEvents
{
    const ACTIONS = [
      'CREATE' => 'create',
      'VIEW' => 'view',
      'UPDATE' => 'update',
      'DELETE' => 'delete'
    ];

    public static function logEvent(string $name, string $affectModel, int $affectId, string $action, string $byModel, int $byId, string $log, array $extraInfo)
    {

        $activity = [
            'name' => $name,
            'affect_model' => $affectModel,
            'affect_id' => $affectId,
            'action' => $action,
            'by_model' => $byModel,
            'by_id' => $byId,
            'log' => $log,
            'extra_info' => $extraInfo
        ];

        HEM::create($activity);
    }
}
