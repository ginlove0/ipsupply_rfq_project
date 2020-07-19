@component('mail::message')
    # Create new account request

    Hi {{$name}},  {{-- break line --}}

    We received your create new account request, we will consider to activate your account.
    If your account active, we will let you know via email.

    Please do not reply this email. Any further request, please contact us via frank@ipsupply.net

    Thanks,
    Ipsupply Sale Team Manager
    Frank Kieu

@endcomponent
