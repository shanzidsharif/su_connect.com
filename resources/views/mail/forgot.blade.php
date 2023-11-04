@component('mail::message')

    Hello{{ $user->name }}
    @component('mail::button',['url'=> url('/reset',$user->remember_token)])
        Reset Your Password
    @endcomponent
<p>If any Problem Contact with your department</p>
{{--    {{ config('mail.php') }}--}}
@endcomponent

{{--<p>{{ $content['body'] }}</p>--}}
{{--<p>Success</p>--}}
