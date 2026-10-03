<x-mail::message>
# New Quote Request Received

You have received a new quotation inquiry from the **Alabama Building Materials** website.

<x-mail::panel>
**Customer Details:**
- **Name:** {{ $quote->name }}
- **Email:** [{{ $quote->email }}](mailto:{{ $quote->email }})
- **Phone / WhatsApp:** [{{ $quote->phone }}](tel:{{ $quote->phone }})
- **Submission Date:** {{ $quote->created_at->format('d M Y, h:i A') }}
</x-mail::panel>

### Requirement / Message:
{{ $quote->requirement ?: 'No detailed message provided.' }}

@if($quote->boq_url)
<x-mail::button :url="$quote->boq_url">
Download Attached BOQ / Document
</x-mail::button>
@endif

<x-mail::button :url="route('quotes.index')">
View in Admin Panel
</x-mail::button>

Thanks,<br>
**{{ config('app.name', 'Alabama Building Materials Trading L.L.C.') }}**
</x-mail::message>
