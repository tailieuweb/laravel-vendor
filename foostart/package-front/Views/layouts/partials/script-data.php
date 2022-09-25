<script type="text/javascript">

    // Token for protecting website
    var TOKEN = "<?php echo csrf_token() ?>";
    // Token for authorise user
    var TOKEN_API = "<?php $token_api = !empty($token_api ) ? $token_api  : NULL; echo $token_api; ?>";
    // Context name
    var CONTEXT_NAME = "<?php $context_name = !empty($context_name) ? $context_name : 'Unknow'; echo $context_name; ?>";
    // Context id
    var CONTEXT_ID = "<?php $context_id = !empty($context_id) ? $context_id : 'Unknow'; echo $context_id; ?>";
    // Url login
    var URL_LOGIN = "<?php echo url('/login') ?>";
    // User id
    var USER_ID = "<?php $user_id = !empty($user_id) ? $user_id : 'Unknow'; echo $user_id; ?>";
    // User full name
     var USER_FULL_NAME = "<?php $user_full_name = !empty($user_full_name) ? $user_full_name : 'Unknow'; echo $user_full_name; ?>";
     // User email
     var USER_EMAIL = "<?php $user_email = !empty($user_email) ? $user_email : 'Unknow'; echo $user_email; ?>";

</script>