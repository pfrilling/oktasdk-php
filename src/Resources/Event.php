<?php

namespace Okta\Resources;

class Event extends Base
{

    /**
     * Fetch a list of events from your Okta organization system log
     *
     * @param  array $query Array of query parameters/values
     * @return array        Array of Events
     */
    public function listEvents($query = null) {

        $request = $this->request->get('events');

        if (isset($query)) {
            $request->query($query);
        }

        return $request->send();

    }

}
