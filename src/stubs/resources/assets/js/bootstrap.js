/**
 * Determine whether to bootstrap the native or Vue based UI.
 */
import './bootstrap-native'
// import './bootstrap-vue'

/**
 * Instruct jQuery to automatically add the CSRF token to all request headers.
 * This provides simple, convenient CSRF protection for your AJAX based applications.
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})
