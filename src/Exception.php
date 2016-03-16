<?php

namespace App\Libs\Okta;

/**
 * Okta\Exception class to pass through Okta responses
 *
 * @author Chris Kankiewicz <ckankiewicz@io.com>
 */
class Exception extends \Exception
{

    private $responseObject;

    /**
     * OKta\Exception constructor method
     *
     * @param string     $message  The internal exception message
     * @param \Exception $previous The previous exception
     * @param int        $code     The internal exception code
     */
    public function __construct($message = null, Exception $previous = null, $code = 0, $responseObject = null) {

        parent::__construct($message, $code, $previous);

        if ($responseObject != null) {
            $this->responseObject = $responseObject;
        }

    }

    /**
     * Return response object
     *
     * @return object Response objects
     */
    public function getErrorResponse() {
        return $this->responseObject;
    }

    /**
     * Return response error code
     *
     * @return string Error code
     */
    public function getErrorCode() {
        return $this->responseObject->errorCode;
    }

    /**
     * Return response error summary
     *
     * @return string Error summary
     */
    public function getErrorSummary() {
        return $this->responseObject->errorSummary;
    }

    /**
     * Return response error link
     *
     * @return string Error link
     */
    public function getErrorLink() {
        return $this->responseObject->errorLink;
    }

    /**
     * Return response error ID
     *
     * @return string Error ID
     */
    public function getErrorId() {
        return $this->responseObject->errorId;
    }

    /**
     * Return response error causes
     *
     * @return array Array of error causes
     */
    public function getErrorCauses($key = null) {

        if ($key >= 0) {
            return $this->responseObject->errorCauses[$key]->errorSummary;
        }

        return $this->responseObject->errorCauses;

    }

}
