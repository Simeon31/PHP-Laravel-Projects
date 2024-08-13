<x-mail::message>
# Hello {{$data['name']}}, thank you for contacting us!

# <h2>We will reach you out as soon as possible.</h2>

<h3>Check out our latest properties:</h3>

<x-mail::button :url="route('properties')">
View
</x-mail::button>

Thanks,<br>
{{ config('app.name') }} Team
</x-mail::message>
