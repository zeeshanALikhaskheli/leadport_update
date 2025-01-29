<!-- resources/views/emails/modal.blade.php -->
<div>
    <h6>Subject: <span>{{ $email['subject'] }}</span></h6>
    <p><strong>From:</strong> <span>{{ $email['from'] }}</span></p>
    <p><strong>Date:</strong> <span>{{ $email['date'] }}</span></p>
    <hr>
    <h5>Email Body:</h5>
    <p>{{ $email['body'] }}</p>
    <hr>
    <h5>Logistics Data:</h5>
    <pre>{{ json_encode($email['logisticsData'], JSON_PRETTY_PRINT) }}</pre>
</div>