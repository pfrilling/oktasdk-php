<?php

namespace Okta\Resource;

/**
 * Implementation of the Okta Users resource, access via $okta->user
 *
 * http://developer.okta.com/docs/api/resources/users.html
 */
class User extends Base
{
    /**
     * Creates a new user in your Okta organization with or without credentials.
     *
     * @param  array   $profile     Array of user profile properties
     * @param  array   $credentials Array of user credentials
     * @param  array   $provider    Array of authentication provider properties
     * @param  boolean $activate    Weather or not to execute activation
     *                              lifecycle operation when creating the user
     * @param  array   $groupIds    Array of group ID's to assign the user on creation.
     *
     * @return object               User model object
     */
    public function create(array $profile, array $credentials = null, array $provider = null, $activate = null, array $groupIds = null)
    {
        $request = $this->request->post('users');

        $request->data(['profile' => $profile]);

        if (isset($groupIds)) $request->data(['groupIds' => $groupIds]);

        if (isset($credentials)) $request->data(['credentials' => $credentials]);

        if (isset($provider)) {

            $request->data([
                'credentials' => [
                    'provider' => $provider
                ]
            ]);

            $request->query(['provider' => true]);

        }

        if (isset($activate)) $request->query(['activate' => $activate]);

        return $request->send();
    }

    /**
     * Fetches a user from your Okta organization.
     *
     * @param  string $uid User ID
     *
     * @return object      User model object
     */
    public function get($uid)
    {
        $request = $this->request->get('users/' . $uid);

        return $request->send();
    }

    /**
     * Enumerates users in your organization with pagination. A subset of users
     * can be returned that match a supported filter expression or query.
     *
     * @param  array $query Array of query parameters/values
     *
     * @return array        Array of user objects
     */
    public function listUsers(array $query = null)
    {
        $request = $this->request->get('users');

        if (isset($query)) $request->query($query);

        return $request->send();
    }

    /**
     * Update a user's profile and/or credentials with partial update semantics.
     *
     * @param  string $uid         ID of user to update
     * @param  array  $profile     Array of user profile properties
     * @param  array  $credentials Array of credential properties
     *
     * @return object              Updated user object
     */
    public function update($uid, array $profile = null, array $credentials = null)
    {
        $request = $this->request->post('users/' . $uid);

        if (isset($profile))     $request->data(['profile' => $profile]);
        if (isset($credentials)) $request->data(['credentials' => $credentials]);

        return $request->send();
    }

    /**
     * Fetches appLinks for all direct or indirect (via group membership)
     * assigned applications.
     *
     * @param  string $uid ID of user
     *
     * @return array       Array of App Links
     */
    public function apps($uid)
    {
        $request = $this->request->get('users/' . $uid . '/appLinks');

        return $request->send();
    }

    /**
     * Fetches the groups of which the user is a member.
     *
     * @param  string $uid ID of user
     *
     * @return array       Array of group objects
     */
    public function groups($uid)
    {
        $request = $this->request->get('users/' . $uid . '/groups');

        return $request->send();
    }

    /**
     * Activates a user. This operation can only be performed on users with a
     * STAGED status. Activation of a user is an asynchronous operation. The
     * user will have the transitioningToStatus property with a value of ACTIVE
     * during activation to indicate that the user hasn't completed the
     * asynchronous operation. The user will have a status of ACTIVE when the
     * activation process is complete.
     *
     * @param  string $uid       ID of user
     * @param  bool   $sendEmail Sends an activation email to the user if true
     *
     * @return object            Returns empty object by default. When sendEmail
     *                           is false, returns an activation link for the
     *                           user to set up their account.
     */
    public function activate($uid, $sendEmail = null)
    {
        $request = $this->request->post('users/' . $uid . '/lifecycle/activate');

        if (isset($sendEmail)) $request->query(['sendEmail' => $sendEmail]);

        return $request->send();
    }

    /**
     * Deactivates a user. This operation can only be performed on users that do
     * not have a DEPROVISIONED status. Deactivation of a user is an
     * asynchronous operation. The user will have the transitioningToStatus
     * property with a value of DEPROVISIONED during deactivation to indicate
     * that the user hasn't completed the asynchronous operation. The user will
     * have a status of DEPROVISIONED when the deactivation process is complete.
     *
     * @param  string $uid ID of user
     *
     * @return empty       Returns an empty object
     */
    public function deactivate($uid)
    {
        $request = $this->request->post('users/' . $uid . '/lifecycle/deactivate');

        return $request->send();
    }

    /**
     * Suspends a user. This operation can only be performed on users with ans
     * ACTIVE status. The user will have a status of SUSPENDED when the process
     * is complete.
     *
     * Passing an invalid id returns a 404 Not Found status code with error code
     * E0000007. Passing an id that is not in the ACTIVE state returns a 400 Bad
     * Request status code with error code E0000001.
     *
     * @param  string $uid ID of user
     *
     * @return object      Returns an empty object
     */
    public function suspend($uid)
    {
        $request = $this->request->post('users/' . $uid . '/lifecycle/suspend');

        return $request->send();
    }

    /**
     * Unsuspends users and returns then to the ACTIVE state. This operation can
     * only be performed on users that have a SUSPENDED status.
     *
     * Passing an invalid id returns a 404 Not Found status code with error code
     * E0000007. Passing an id that is not in the SUSPENDED state returns a 400
     * Bad Request status code with error code E0000001.
     *
     * @param  string $uid ID of user
     *
     * @return object      Returns an empty object
     */
    public function unsuspend($uid)
    {
        $request = $this->request->post('users/' . $uid . '/lifecycle/unsuspend');

        return $request->send();
    }

    /**
     * Unlocks a user with a LOCKED_OUT status and returns them to ACTIVE
     * status. Users will be able to login with their current password.
     *
     * @param  string $uid ID of user
     *
     * @return object      Returns an empty object
     */
    public function unlock($uid)
    {
        $request = $this->request->post('users/' . $uid . '/lifecycle/unlock');

        return $request->send();
    }

    /**
     * Generates a one-time token (OTT) that can be used to reset a user's
     * password. The OTT link can be automatically emailed to the user or
     * returned to the API caller and distributed using a custom flow.
     *
     * This operation will transition the user to the status of RECOVERY and the
     * user will not be able to login or initiate a forgot password flow until
     * they complete the reset flow.
     *
     * @param  string $uid       ID of user
     * @param  bool   $sendEmail Sends reset password email to the user if true
     *
     * @return object            Returns an empty object by default. When
     *                           sendEmail is false, returns a link for the user
     *                           to reset their password.
     */
    public function resetPassword($uid, $sendEmail = null)
    {
        $request = $this->request->post('users/' . $uid . '/lifecycle/reset_password');

        if (isset($sendEmail)) $request->query(['sendEmail' => $sendEmail]);

        return $request->send();
    }

    /**
     * This operation will transition the user to the status of PASSWORD_EXPIRED
     * and the user will be required to change their password at their next
     * login. If tempPassword is passed, the user's password is reset to a
     * temporary password that is returned, and then the temporary password is
     * expired.
     *
     * @param  string $uid           User ID
     * @param  boolean $tempPassword Sets the user's password to a temporary
     *                               password, if true
     *
     * @return object                User object
     */
    public function expirePassword($uid, $tempPassword = null)
    {
        $request = $this->request->post('users/' . $uid . '/lifecycle/expire_password');

        if (isset($tempPassword)) $request->query(['tempPassword' => $tempPassword]);

        return $request->send();
    }

    /**
     * This operation resets all factors for the specified user. All MFA factor
     * enrollments returned to the unenrolled state. The user's status remains
     * ACTIVE. This link is present only if the user is currently enrolled in
     * one or more MFA factors.
     *
     * @param  string $uid ID of user
     *
     * @return object      Returns an empty object by default
     */
    public function resetFactors($uid)
    {
        $request = $this->request->post('users/' . $uid . '/lifecycle/reset_factors');

        return $request->send();
    }

    /**
     * Generates a one-time token (OTT) that can be used to reset a user's
     * password. This operation can only be performed on users with a valid
     * recovery question credential and have an ACTIVE status.
     *
     * @param  string $uid       User ID
     * @param  bool   $sendEmail Sends a forgot password email to the user if true
     *
     * @return object            Returns an empty object by default. When
     *                           sendEmail is false, returns a link for the user
     *                           to reset their password.
     */
    public function forgotPassword($uid, $sendEmail = null)
    {
        $request = $this->request->post('users/' . $uid . '/credentials/forgot_password');

        if (isset($sendEmail)) $request->query(['sendEmail' => $sendEmail]);

        return $request->send();
    }

    /**
     * Sets a new password for a user by validating the user's answer to their
     * current recovery question. This operation can only be performed on users
     * with a valid recovery question credential and have an ACTIVE status.
     *
     * @param  string $uid            User ID
     * @param  string $password       New password for user
     * @param  string $recoveryAnswer Answer to user's current recovery question
     *
     * @return object                 User Credentials object
     */
    public function forgotPasswordReset($uid, $password, $recoveryAnswer)
    {
        $request = $this->request->post('users/' . $uid . '/credentials/forgot_password');

        $request->data([
            'password'          => $password,
            'recovery_question' => [
                'answer' => $recoveryAnswer
            ]
        ]);

        return $request->send();
    }

    /**
     * Changes a user's password by validating the user's current password. This
     * operation can only be performed on users in STAGED, ACTIVE,
     * PASSWORD_EXPIRED, or RECOVERY status that have a valid password
     * credential
     *
     * @param  string $uid     User ID
     * @param  string $oldPass Current password for user
     * @param  string $newPass New passwor for user
     *
     * @return object          User credentials object
     */
    public function changePassword($uid, $oldPass, $newPass)
    {
        $request = $this->request->post('users/' . $uid . '/credentials/change_password');

        $request->data([
            'oldPassword' => $oldPass,
            'newPassword' => $newPass
        ]);

        return $request->send();
    }

    /**
     * Modify a users's security question
     *
     * @param  string $uid      User ID
     * @param  string $password User's password
     * @param  string $question New securrity question
     * @param  string $answer   Answer to security question
     *
     * @return object           Security question object
     */
    public function changeRecoveryQuestion($uid, $password, $question, $answer)
    {
        $request = $this->request->post('users/' . $uid . '/credentials/change_recovery_question');

        $request->data([
            'password' => [
                'value' => $password
            ],
            'recovery_question' => [
                'question' => $question,
                'answer'   => $answer
            ]
        ]);

        return $request->send();
    }

    /**
     * Permanently delete a user.
     *
     * The user must have a status of 'DEPROVISIONED', for this to succeed.
     *
     * @param string $uid
     *   An Okta user ID.
     *
     * @return object
     *   Decoded API response object.
     */
    public function delete($uid)
    {
        $request = $this->request->delete('users/' . $uid);

        return $request->send();
    }
}
