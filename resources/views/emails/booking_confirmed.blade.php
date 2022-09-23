@component('mail::message')
# Dear {{ $fname }},

You have successfully completed the booking of a table space in our restaurant, see booking details below:

@component('mail::panel')
<strong>Name :</strong> {{ $bookingInfo->name }}

<strong>Phone :</strong> {{ $bookingInfo->phone }} 

<strong>Email :</strong> {{ $bookingInfo->email }} 

<strong>Reserved Space :</strong> {{ $event_space }} 

<?php $convDate = date('l jS \of F Y', strtotime($bookingInfo->event_date)); ?>
<strong>Reservation Date :</strong> {{ $convDate }}

<strong>Reservation Time :</strong> {{ $bookingInfo->scheduled_time }} 

<strong>Reference :</strong> {{ $reference }} 
@endcomponent

<p>&nbsp;</p>

Best regards,<br>
Management Team,<br>
{{ config('app.name') }}
@endcomponent
