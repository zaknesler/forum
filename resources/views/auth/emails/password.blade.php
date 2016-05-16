<a href="{{ $link = route('auth.password.reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">Click here to reset your password.</a>
<br /><br />
<em><strong>Warning:</strong> This password reset is only valid for the next ten minutes.</em>