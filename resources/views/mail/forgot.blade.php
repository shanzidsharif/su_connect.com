@component('mail::message')

    Hello{{ $user->name }}
    <p>Here Your Password Reset Link</p>
    @component('mail::button',['url'=> url('/reset',$user->remember_token)])
        Reset Your Password
    @endcomponent
<p>If there have any more problem, Contact with your department</p>
    <br>
    {{ config('app.name') }} //project Name
    <br>
@endcomponent

{{--<p>{{ $content['body'] }}</p>--}}
{{--<p>Success</p>--}}
