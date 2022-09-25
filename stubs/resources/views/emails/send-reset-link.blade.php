@component('mail::layout')
@slot('header')
@component('mail::header', ['url' => config('custom.frontend_url')])
    <span style="color: #EB8023">{{ config('app.name') }}</span>
@endcomponent
@endslot

{{-- intro --}}
# Hi {{ $user_name }},
<footer class="subcopy" style="margin:0;padding:0;border-top:0">
<p>
    A request to reset your NP Marketing Tool’s password has been made. If you did not make this request, simply ignore this email. If you did make this request, please hit the Reset button:
</p>
</footer>
{{-- end intro --}}

{{-- button --}}
<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="center">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
<a href="{{ $url }}" class="button" style="background-color: #EB8023;
border-bottom: 8px solid #EB8023;
border-left: 18px solid #EB8023;
border-right: 18px solid #EB8023;
border-top: 8px solid #EB8023;" target="_blank" rel="noopener">Reset Password</a>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
{{--end button --}}

@component('mail::subcopy')
<p style="margin-bottom: 0;">Can’t see the button? click below link</p>
<a style="font-size: 14px" href="{{ $url }}">{{ $url }}</a>
@endcomponent

@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot

@endcomponent
