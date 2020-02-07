<?php

/**
 * Determines if the coming request is an api call or not
 *
 * @param \Illuminate\Http\Request $request
 *
 * @return bool
 */
function is_api_request(\Illuminate\Http\Request $request)
{
    return $request->segment(1) == 'api';
}
