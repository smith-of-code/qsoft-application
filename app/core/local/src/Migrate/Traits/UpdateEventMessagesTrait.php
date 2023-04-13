<?php

namespace QSoft\Migrate\Traits;

use CEventMessage;
use Exception;

trait UpdateEventMessagesTrait
{
    /**
     * @return void
     * @throws Exception
     */
    public function up()
    {
        $this->validateClass();

        $cEventMessage = new CEventMessage;

        foreach ($this->eventMessages as $eventMessage) {
            $events = $cEventMessage::GetList('id', 'desc', ['EVENT_NAME' => $eventMessage['event_name']]);
            while ($event = $events->Fetch()) {
                $cEventMessage->Update($event['ID'], $eventMessage['to']);
            }
        }
    }

    /**
     * @return void
     * @throws Exception
     */
    public function down()
    {
        $this->validateClass();

        $cEventMessage = new CEventMessage;

        foreach ($this->eventMessages as $eventMessage) {
            $events = $cEventMessage::GetList('id', 'desc', ['EVENT_NAME' => $eventMessage['event_name']]);
            while ($event = $events->Fetch()) {
                $cEventMessage->Update($event['ID'], $eventMessage['from']);
            }
        }
    }

    /**
     * @throws Exception
     */
    private function validateClass(): void
    {
        if (!property_exists($this, 'eventMessages')) {
            throw new Exception('Can not find $eventMessages class property');
        }
    }
}