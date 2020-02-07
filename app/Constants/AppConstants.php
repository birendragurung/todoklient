<?php


namespace App\Constants;


class AppConstants
{

    /**
     * The general constant value for most of the success response
     * @type string
     */
    const SUCCESS_OK = 'ok';

    const ERR_CODE_ZERO = 0;

    const START_TIME = '00:00:00';
    const END_TIME = '23:59:59';

    /** Note that this constant group is made as per \Illuminate\Contracts\Auth\PasswordBroker constant. We've only replaced dot with an underscore */
    const SUCCESS_PASSWORD_RESET_SUCCESS = "passwords_reset";

    const SUCCESS_PASSWORD_RESET_LINK_SENT = "passwords_sent";

    const ERR_PASSWORD_INVALID_USER = "passwords_user";

    const ERR_PASSWORD_INVALID_PASSWORD = "passwords_password";

    const ERR_PASSWORDS_TOKEN = "passwords_token";


    /**
     * Used typically whenever user try to submitForm with invalid username/password combination
     * @type string
     */
    const ERR_INVALID_CREDENTIAL = 'invalid_credentials';
    /**
     * Used typically whenever required value in the request is empty
     * @type string
     */
    const ERR_REQUIRED_FIELDS_EMPTY = 'required_fields_empty';

    const ERR_EMAIL_DOESNT_EXIST_IN_DATABASE = 'email_doesnt_exist_in_system';

    const ERR_MAIL_SERVER_AUTH_OR_CONF = "mail_server_auth_or_conf_error";

    const ERR_FORM_VALIDATION = "form_validation_error";

    const ERR_OLD_PASSWORD_MISMATCH = "old_password_mismatch";

    const ERR_INTERNAL_SERVER_ERROR = "internal_server_error";

    const ERR_UNAUTHORIZED = "unauthorized";

    const ERR_FORBIDDEN = "forbidden";

    const ERR_NOT_FOUND = "not_found";

    const ERR_BAD_REQUEST = "bad_request";

    const ERR_PRECONDITION_FAILED = "precondition_failed";

    const ERR_CONFLICT = "conflict";

    const ERR_EXPECTATION_FAILED = "expectation_failed";

    const ERR_USER_NOT_LOGGED_IN_OR_TOKEN_ABSENT = "user_not_logged_in_or_token_absent";

    const ERR_INVALID_OAUTH_CLIENT = 'invalid_client';

    const ERR_METHOD_NOT_ALLOWED = "method_not_allowed";

    const ERR_AUTH_TOKEN_ABSENT = 'auth_token_absent';

    const ERR_INVALID_AUTH_TOKEN = 'invalid_auth_token';

    const INVALID_STATUS_VALUE_PASSED = 'invalid_status_value_passed';

    const ERR_TOKEN_EXPIRED = 'auth_token_expired';

    const TASK_STATE_NEW = "new";

    const TASK_STATE_COMPLETED = "completed";

    const TASK_STATE_IN_PROGRESS = "in_progress";

    const TASK_STATES = [
        self::TASK_STATE_COMPLETED ,
        self::TASK_STATE_NEW ,
        self::TASK_STATE_IN_PROGRESS ,
    ];
}
