<?php

namespace QSoft\Migrate\Traits;

use CEventMessage;
use CEventType;
use Exception;

trait CreateEventTrait
{
    /**
     * @return void
     * @throws Exception
     */
    public function up()
    {
        $this->validateClass();
        $cEventMessage = new CEventMessage;
        foreach ($this->events as $event) {
            $eventId = CEventType::Add($event['event_type']);
            if ($eventId) {
                $cEventMessage->Add(array_merge($event['event_template'], ['EVENT_NAME' => $event['event_type']['EVENT_NAME']]));
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
        foreach ($this->events as $event) {
            CEventType::Delete($event['event_type']['EVENT_NAME']);
        }
    }

    /**
     * @throws Exception
     */
    private function validateClass(): void
    {
        if (!property_exists($this, 'events')) {
            throw new Exception('Can not find $events class property');
        }
    }
}